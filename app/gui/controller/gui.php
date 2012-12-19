<?php

require_once("../classes/FileManager.class.php");

if (isset($_POST["firstConfig"]))
	{
		$fm = new FileManager("../../");
		$fm->set_currentItem("../../config/config.yml");
		if ((isset($_POST["user"]) && !empty($_POST["user"])) && (isset($_POST["pwd"])) && (isset($_POST["name"])  && !empty($_POST["name"])) && (isset($_POST["adress"]) && !empty($_POST["adress"])))
		{
			$link = mysqli_connect($_POST["adress"], $_POST["user"], $_POST["pwd"]) or die(header("Location:../gui.php?err=conn"));
			$hl	= mysqli_select_db($link, $_POST["name"]) or die(header("Location:../gui.php?err=name"));
			mysqli_close ($link);
			$fm->add_fileContent("\n# BDD:\n    user:\t\t".$_POST["user"]."\n    password:\t\t".$_POST["pwd"]."\n    name:\t\t".$_POST["name"]."\n    adress:\t\t".$_POST["adress"]);
		}	
		
		if (isset($_POST["routesLang"]) && ($_POST["routesLang"] == "YAML" || $_POST["routesLang"] == "PHP" ))
			$fm->add_fileContent("\n# Routes:\n    LangageRoutes:\t\t".$_POST["routesLang"]);
		if (isset($_POST["tpl"]) && ($_POST["tpl"] == "Twig" || $_POST["tpl"] == "Smarty" || $_POST["tpl"] == "Aucun" ))
			$fm->add_fileContent("\n# Moteur de Templates:\n    TplEngine:\t\t".$_POST["tpl"]);
		if (isset($_POST["bundle"]) && !empty($_POST["bundle"]))
		{
			$fm->set_currentItem("../../../src");
			$fm->bundleGenerator($_POST["bundle"]);
		}
		echo "Préparation du projet en cours ...<br />";	//Génération des fichiers
		echo "Installation terminée !";
	}
