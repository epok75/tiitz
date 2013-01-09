<?php
require_once(ROOT."/app/gui/classes/FileManager.class.php");
class guiController
{
	public function checkAction()
	{
		$fm = new FileManager(ROOT);
		$fm->set_currentItem(ROOT."/app/config/config.yml");
		$fm->replace_fileContent("# language (tool development)\nlanguage:    fr\n\n# environnement (dev | prod)\nenvironnement:    dev\n\n# Permit to check if a project is already started\nexistingproject:    true");
		if (isset($_POST["firstConfig"]))
		{
		
			$fm->set_currentItem(ROOT."/src/");
			$fm->xmkdir("views");
			$fm->xmkdir("controllers");
			$fm->set_currentItem(ROOT."/src/views");
			$fm->xmkdir("templates");
			$fm->xmkdir("structures");
			$fm->set_currentItem(ROOT."/app/config/config.yml");
			
			if (isset($_POST["routesLang"]) && ($_POST["routesLang"] == "yml" || $_POST["routesLang"] == "php" ))
				$fm->add_fileContent("\n\n# Routing\n routingType:\n\t".$_POST["routesLang"]);
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
			if ((isset($_POST["user"]) && !empty($_POST["user"])) && (isset($_POST["pwd"])) && (isset($_POST["name"])  && !empty($_POST["name"])) && (isset($_POST["adress"]) && !empty($_POST["adress"])))
			{
				$link = mysqli_connect($_POST["adress"], $_POST["user"], $_POST["pwd"]) or die(header("Location:../views/index.php?err=conn"));
				$hl	= mysqli_select_db($link, $_POST["name"]) or die(header("Location:../views/index.php?err=name"));
				mysqli_close ($link);
				$fm->add_fileContent("\n\n# database configuration\ndatabase:\n    user:\t\t".$_POST["user"]."\n    password:\t\t".$_POST["pwd"]."\n    dbname:\t\t".$_POST["name"]."\n    host:\t\t".$_POST["adress"]."\n    engine:\t\tmysql");
			}
			if (isset($_POST["pages"]) && !empty($_POST["pages"]))
			{
				$pages = explode("\n", $_POST["pages"]);
				foreach ($pages as $page)
				{
					$page = str_replace( "\r", "", $page);
					$fm->set_currentItem(ROOT."/src/config/routing.yml");
					$fm->add_fileContent("\n\n".$page."_show:\n\tpattern:\t/".$page."\n\tdefaults:\t{ _controller: ".$page.":show }");
					$fm->set_currentItem(ROOT."/src/views/templates");
					$fm->xtouch($page.$extention);
					$fm->set_currentItem(ROOT."/src/controllers");
					$fm->xtouch($page."Controller.php");
				}
			}
			
			/*if (isset($_POST["bundle"]) && !empty($_POST["bundle"]))
			{
				$fm->set_currentItem(ROOT."src");
				$fm->bundleGenerator($_POST["bundle"]);
			}
			else
				die(header("Location:../index.php?err=bundle"));*/
				echo "fini";
				exit;
			//header("Location:".ROOT."/web/index.php")
		}
		require_once("../app/gui/views/index.php");
	}
}