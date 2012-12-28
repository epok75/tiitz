<?php
require_once(ROOT."/app/gui/classes/FileManager.class.php");
class guiController
{
	public function checkAction()
	{
		if (isset($_POST["firstConfig"]))
		{
			$fm = new FileManager(ROOT);
			$fm->set_currentItem(ROOT."/app/config/config.yml");
			
			if (isset($_POST["routesLang"]) && ($_POST["routesLang"] == "yml" || $_POST["routesLang"] == "php" ))
				$fm->replace_fileContent("\n# routing:\n    type:\t\t".$_POST["routesLang"]);
			if (isset($_POST["tpl"]) && ($_POST["tpl"] == "twig" || $_POST["tpl"] == "smarty" || $_POST["tpl"] == "php" ))
				$fm->add_fileContent("\n\n# template:\n    ".$_POST["tpl"]);
			if ((isset($_POST["user"]) && !empty($_POST["user"])) && (isset($_POST["pwd"])) && (isset($_POST["name"])  && !empty($_POST["name"])) && (isset($_POST["adress"]) && !empty($_POST["adress"])))
			{
				$link = mysqli_connect($_POST["adress"], $_POST["user"], $_POST["pwd"]) or die(header("Location:../views/index.php?err=conn"));
				$hl	= mysqli_select_db($link, $_POST["name"]) or die(header("Location:../views/index.php?err=name"));
				mysqli_close ($link);
				$fm->add_fileContent("\n# database configuration\ndatabase:\n    user:\t\t".$_POST["user"]."\n    password:\t\t".$_POST["pwd"]."\n    dbname:\t\t".$_POST["name"]."\n    host:\t\t".$_POST["adress"]."\n    engine:\t\tmysql\n");
			}
			$fm->add_fileContent("\n\n# language (tool development)\nlanguage:    fr\n\n# environnement (dev | prod)\nenvironnement:    dev\n\n# Permit to check if a project is already started\nexistingprojet:    false");
			/*if (isset($_POST["bundle"]) && !empty($_POST["bundle"]))
			{
				$fm->set_currentItem(ROOT."src");
				$fm->bundleGenerator($_POST["bundle"]);
			}
			else
				die(header("Location:../index.php?err=bundle"));*/
			header("Location:".ROOT."/src/index.php");
		}
	}
}