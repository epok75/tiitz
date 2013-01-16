<?php
/**
* 
*/
require_once 'validatorController.class.php';

class MainController extends TzController {
	private $extension;

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
				$this -> templateEngine();
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

	private function templateEngine() {
		if ($_POST['tpl'] == 'smarty') {
			$this->extension = 'tpl';
		} elseif ($_POST['tpl'] == 'twig') {
			$this->extension = 'html.twig';
		} else {
			$this->extension = $_POST['tpl'];
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
		$fm->xtouch("routing.yml");
		$fm->set_currentItem(ROOT."/src/views");
		
		// layout template
		$fm->moveDir(ROOT."/app/components/template/views/layout.".$this->extension, ROOT."/src/views/layout.".$this->extension);
				
		// create default controller and his content
		$fm->set_currentItem(ROOT."/src/controllers/mainController.php");
		
		$code = "<?php \n\nclass mainController extends TzController {\n\t public function showAction () {\n\t\t ";
		$code .= '$this->tzRender->run(\'layout\');';
		$code .= "\n\t}\n}\n ?>";

		$fm->add_fileContent($code);

		// create content of routing file with default path
		$fm->set_currentItem(ROOT."/src/config/routing.yml");
		$fm->add_fileContent("\nmain_show:\n\tpattern:\t / \n\tdefaults:\t{ _controller: main:show }"); 
		
		// add pages if user has tried to create one or more
		if (isset($_POST["pages"]) && !empty($_POST["pages"])) {
			
			$pages = $_POST['pages'];
			foreach ($pages as $page) {
				$page = str_replace( "\r", "", $page);
				$page = strtolower($page);
				// create touting.yml
				$fm->set_currentItem(ROOT."/src/config/routing.yml");
				$fm->add_fileContent("\n".$page."_show:\n\tpattern:\t/".$page."\n\tdefaults:\t{ _controller: ".$page.":show }");
				$fm->set_currentItem(ROOT."/src/views/templates");
				$fm->xtouch($page.'.'.$_POST['tpl']);
				$fm->set_currentItem(ROOT."/src/controllers");
				// create additional controllers
				$fm->xtouch($page."Controller.php");
				$fm->set_currentItem(ROOT."/src/controllers/".$page."Controller.php");
				$fm->add_fileContent("<?php \n\nclass ".$page."Controller extends TzController {\n\t public function showAction () {\n\t\t echo 'Vous êtes sur la page : ".$page."';\n\t}\n}\n ?>");

			}
		} 
	}	

}
