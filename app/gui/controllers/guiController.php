<?php
require_once(ROOT."/app/components/fileManager.class.php");
class guiController
{
	public function checkAction()
	{
		if (isset($_POST["firstConfig"]))
		{
			$this->configGenerator();
			$this->pagesGenerator();
			echo "fini le retour";
			exit;
			//header("Location:".ROOT."/web/index.php");
		}
		require_once("../app/gui/views/index.php");
	}

	private function pagesGenerator()
	{
		$fm = new FileManager(ROOT);
		$fm->set_currentItem(ROOT."/src/");
		$fm->xmkdir("views");
		$fm->xmkdir("controllers");
		$fm->set_currentItem(ROOT."/src/views");
		$fm->xmkdir("templates");
		$fm->xmkdir("structures");
		if (isset($_POST["pages"]) && !empty($_POST["pages"])) {
			$pages = explode("\n", $_POST["pages"]);
			foreach ($pages as $page) {
				$page = str_replace( "\r", "", $page);
				$fm->set_currentItem(ROOT."/src/config/routing.yml");
				$fm->add_fileContent("\n\n".$page."_show:\n\tpattern:\t/".$page."\n\tdefaults:\t{ _controller: ".$page.":show }");
				$fm->set_currentItem(ROOT."/src/views/templates");
				$fm->xtouch($page.$extention);
				$fm->set_currentItem(ROOT."/src/controllers");
				$fm->xtouch($page."Controller.php");
			}
		}
	}
	
	private function configGenerator()
	{
		$fm = new FileManager(ROOT);
		$fm->set_currentItem(ROOT."/app/config/config.yml");
		if (isset($_POST["routesLang"]) && ($_POST["routesLang"] == "yml" || $_POST["routesLang"] == "php" )) {
				$fm->replace_fileContent("# Routing\n routingType:\t\t".$_POST["routesLang"]);
		}
		if (isset($_POST["tpl"]) && ($_POST["tpl"] == "twig" || $_POST["tpl"] == "smarty" || $_POST["tpl"] == "php" ))
		{
			if ($_POST["tpl"] == "twig")
				$extention = ".twig";
			else if ($_POST["tpl"] == "smarty")
				$extention = ".tpl";
			else
				$extention = ".php";
			$fm->add_fileContent("\n\n# Template Engine\n    template:    ".$_POST["tpl"]);
		}
		if ((isset($_POST["user"]) && !empty($_POST["user"])) && (isset($_POST["pwd"])) && (isset($_POST["name"])  && !empty($_POST["name"])) && (isset($_POST["adress"]) && !empty($_POST["adress"]))) {
			$link = mysqli_connect($_POST["adress"], $_POST["user"], $_POST["pwd"]) or die(header("Location:../views/index.php?err=conn"));
			$hl	= mysqli_select_db($link, $_POST["name"]) or die(header("Location:../views/index.php?err=name"));
			mysqli_close ($link);
			$fm->add_fileContent("\n\n# database configuration\ndatabase:\n    user:\t\t".$_POST["user"]."\n    password:\t\t".$_POST["pwd"]."\n    dbname:\t\t".$_POST["name"]."\n    host:\t\t".$_POST["adress"]."\n    engine:\t\tmysql");
		}
		else {
			$fm->add_fileContent("\n\n# database configuration\ndatabase:\n    user:\n    password:\n    dbname:\n    host:\n    engine:\t\tmysql");
		}
		$fm->add_fileContent("\n\n# language (tool development)\nlanguage:    fr\n\n# environnement (dev | prod)\nenvironnement:    dev\n\n# Permit to check if a project is already started\nexistingproject:    true");
	}
}