<?php

if (isset($_POST["firstConfig"]))
	{
		if ((isset($_POST["user"]) && !empty($_POST["user"])) && (isset($_POST["pwd"])) && (isset($_POST["name"])  && !empty($_POST["name"])) && (isset($_POST["adress"]) && !empty($_POST["adress"])))
		{
			$link = mysqli_connect($_POST["adress"], $_POST["user"], $_POST["pwd"]) or die(header("Location:../gui.php?err=conn"));
			$hl	= mysqli_select_db($link, $_POST["name"]) or die(header("Location:../gui.php?err=name"));
			mysqli_close ($link);
			echo $_POST["user"]."<br />".$_POST["pwd"]."<br />".$_POST["name"]."<br />".$_POST["adress"]."<br />";		//../../config/config.yml
		}	
		if (isset($_POST["routesLang"]) && ($_POST["routesLang"] == "YAML" || $_POST["routesLang"] == "PHP" ))
			echo $_POST["routesLang"]."<br />";	//../../config/config.yml
		if (isset($_POST["tpl"]) && ($_POST["tpl"] == "Twig" || $_POST["tpl"] == "Smarty" || $_POST["tpl"] == "Aucun" ))
			echo $_POST["tpl"]."<br />";		//../../config/config.yml
		if (isset($_POST["bundle"]) && !empty($_POST["bundle"]))
			echo $_POST["bundle"]."<br />";		//Génération des fichiers dans
	}
