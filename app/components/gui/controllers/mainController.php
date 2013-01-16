<?php
/**
* 
*/
require_once 'validatorController.class.php';

class MainController extends TzController {
	private $routingExtension;

	public function checkAction() {
		
		if (isset($_POST["firstConfig"]))
		{
			// relauch test
			Validator::checkTpl($_POST['tpl']);
			Validator::checkRoute($_POST['routesLang']);
			Validator::checkDb(array('user' => $_POST['user'], 'pwd' => $_POST['pwd'],'adress' => $_POST['adress'], 'name' => $_POST['name']));
			$_POST["pages"] = Validator::CleanPage($_POST["pages"]);
			// check if there error array is empty or no	
			$error = Validator::getError();
			
			if(empty($error)) {
				$this -> routingExtension = $_POST['routesLang'];
				$this -> configGenerator();
				$this -> pagesGenerator(); 
				// redirect /web/index.php which will redirect to /src/config/routing.yml
				header('location:'.WEB_PATH.'index.php');
			} else {
				require_once("../app/components/gui/views/_index.php");
			}
		} else {
			require_once("../app/components/gui/views/_index.php");
		}

	}

	private function configGenerator()
	{
		// File manager class
		$fm = new tzFileManager(ROOT);

		// location of the file config.yml
		$fm->set_currentItem(ROOT."/app/config/config.yml");

		// write route language
		$fm->replace_fileContent("# Routing\nroutingType:\t".$_POST["routesLang"]);
		// write template engine
		$fm->add_fileContent("\n\n# Template Engine\ntemplate:    ".$_POST["tpl"]);
		// write db parameters
		$fm->add_fileContent("\n\n# database configuration\ndatabase:\n    user:\t\t".$_POST["user"]."\n    password:\t\t".$_POST["pwd"]."\n    dbname:\t\t".$_POST["name"]."\n    host:\t\t".$_POST["adress"]."\n    engine:\t\tmysql");
		// add others parameters
		$fm->add_fileContent("\n\n# language (tool development)\nlanguage:    fr\n\n# environnement (dev | prod)\nenvironnement:    dev\n\n# Permit to check if a project is already started\nexistingproject:    true");
	
	}	

	private function pagesGenerator()
	{
		// File manager class
		$fm = new tzFileManager(ROOT);
		// create files
		$fm->set_currentItem(ROOT."/src/controllers");
		$fm->xtouch("mainController.php");
		$fm->set_currentItem(ROOT."/src/config/");
		$fm->xtouch("routing.".$this -> routingExtension);
		
		// layout template
		if ($_POST["tpl"] == 'twig') {
			$fm->moveDir(ROOT."/app/components/template/views/layout.html.twig", ROOT."/src/views/layout.html.twig");
			$fm->moveDir(ROOT."/app/components/template/views/templates/main.html.twig", ROOT."/src/views/templates/main.html.twig");
			$fm->moveDir(ROOT."/app/components/template/views/templates/footer.php", ROOT."/src/views/templates/footer.html.twig");
			$fm->moveDir(ROOT."/app/components/template/views/templates/header.php", ROOT."/src/views/templates/header.html.twig");
		} elseif ($_POST["tpl"] == 'smarty') {
			$fm->moveDir(ROOT."/app/components/template/views/templates/main.php", ROOT."/src/views/templates/main.tpl");
			$fm->moveDir(ROOT."/app/components/template/views/layout.php", ROOT."/src/views/layout.tpl");
			$fm->moveDir(ROOT."/app/components/template/views/templates/footer.php", ROOT."/src/views/templates/footer.tpl");
			$fm->moveDir(ROOT."/app/components/template/views/templates/header.php", ROOT."/src/views/templates/header.tpl");
		} else {
			$fm->moveDir(ROOT."/app/components/template/views/templates/main.php", ROOT."/src/views/templates/main.php");
			$fm->moveDir(ROOT."/app/components/template/views/layout.php", ROOT."/src/views/layout.php");
			$fm->moveDir(ROOT."/app/components/template/views/templates/footer.php", ROOT."/src/views/templates/footer.".$_POST["tpl"]);
			$fm->moveDir(ROOT."/app/components/template/views/templates/header.php", ROOT."/src/views/templates/header.".$_POST["tpl"]);
		}
		
		// create default controller and landing page
		$fm->set_currentItem(ROOT."/src/controllers/mainController.php");
		$fm->add_fileContent("<?php \n\nclass mainController extends TzController {\n\t public function showAction () {\n\t\t echo 'Hello World';\n\t}\n}\n ?>");
		$fm->set_currentItem(ROOT."/src/config/routing.".$this -> routingExtension);
		if ($this -> routingExtension === "yml")
			$fm->add_fileContent("\nmain_show:\n\tpattern:\t / \n\tdefaults:\t{ _controller: main:show }");
		if ($this -> routingExtension === "php")
			$fm->replace_fileContent('<?php'."\n\t".'$tzRoute = array('."\n\n\t\t".'"main_show" => array('."\n\t\t\t".'"pattern" => "/",'."\n\t\t\t".'"controller" => "main:show" ),'."\n");
		// add pages if user has tried to create one or more
		if (isset($_POST["pages"]) && !empty($_POST["pages"])) {
			
			$pages = $_POST['pages'];
			foreach ($pages as $page) {
				$page = str_replace( "\r", "", $page);
				$page = strtolower($page);
				// create routing.yml
				$fm->set_currentItem(ROOT."/src/config/routing.".$this -> routingExtension);
				if ($this -> routingExtension === "yml")
					$fm->add_fileContent("\n".$page."_show:\n\tpattern:\t/".$page."\n\tdefaults:\t{ _controller: ".$page.":show }");
				if ($this -> routingExtension === "php")
					$fm->add_fileContent("\n\t\t".'"'.$page.'_show" => array('."\n\t\t\t".'"pattern" => "/",'."\n\t\t\t".'"controller" => "'.$page.':show" ),'."\n");
				$fm->set_currentItem(ROOT."/src/views/templates");
				$fm->xtouch($page.'.'.$_POST['tpl']);
				$fm->set_currentItem(ROOT."/src/controllers");
				// create additional controllers
				$fm->xtouch($page."Controller.php");
				$fm->set_currentItem(ROOT."/src/controllers/".$page."Controller.php");
				$fm->add_fileContent("<?php \n\nclass ".$page."Controller extends TzController {\n\t public function showAction () {\n\t\t echo 'Vous êtes sur la page : ".$page."';\n\t}\n}\n ?>");
			}
			if ($this -> routingExtension === "php")
			{
				$fm->set_currentItem(ROOT."/src/config/routing.".$this -> routingExtension);
				$fm->add_fileContent(");");
			}
		} 
	}	

}
