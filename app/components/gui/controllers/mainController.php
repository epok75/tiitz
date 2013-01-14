<?php
/**
* 
*/
require_once 'validatorController.class.php';

class MainController 
{
	private $extention;

	function __construct()
	{
		# code...
	}

	public function checkAction() {
		
		if (isset($_POST["firstConfig"]))
		{
			// relauch test
			Validator::checkTpl($_POST['tpl']);
			Validator::checkRoute($_POST['routesLang']);
			Validator::checkDb(array('user' => $_POST['user'], 'pwd' => $_POST['pwd'],'adress' => $_POST['adress'], 'name' => $_POST['name']));
			
			// check if there error array is empty or no	
			$error = Validator::getError();
			if(empty($error)) {

				$this -> configGenerator();
				$this -> pagesGenerator();
				die("pas d'erreur");
			} 
		}

		var_dump($error);
		require_once("../app/components/gui/views/_index.php");
			
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
		$fm->add_fileContent("\n\n# language (tool development)\nlanguage:    fr\n\n# environnement (dev | prod)\nenvironnement:    dev\n\n# Permit to check if a project is already started\nexistingproject:    false");
	
	}	

	private function pagesGenerator()
	{
		// File manager class
		$fm = new tzFileManager(ROOT);
		// Set the base dir
		$fm->set_currentItem(ROOT."/src/");
		// create dir
		$fm->xmkdir("views");
		$fm->xmkdir("controllers");
		$fm->set_currentItem(ROOT."/src/views");
		$fm->xmkdir("templates");
		$fm->xmkdir("structures");
		// add pages if user has tried to create one or more
		if (isset($_POST["pages"]) && !empty($_POST["pages"])) {
			
			$pages = $_POST['pages'];
			foreach ($pages as $page) {
				$page = str_replace( "\r", "", $page);
				$fm->set_currentItem(ROOT."/src/config/routing.yml");
				$fm->add_fileContent("\n\n".$page."_show:\n\tpattern:\t/".$page."\n\tdefaults:\t{ _controller: ".$page.":show }");
				$fm->set_currentItem(ROOT."/src/views/templates");
				$fm->xtouch($page.$this->extention);
				$fm->set_currentItem(ROOT."/src/controllers");
				$fm->xtouch($page."Controller.php");
			}
		}
	}	

}
?>