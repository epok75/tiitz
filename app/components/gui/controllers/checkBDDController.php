<?php
class checkBDDController
{
	public function checkBDDAction()
	{
		if ((isset($_POST["user"]) && !empty($_POST["user"])) && (isset($_POST["pwd"])) && (isset($_POST["name"])  && !empty($_POST["name"])) && (isset($_POST["adress"]) && !empty($_POST["adress"])))
		{
			$link = @mysqli_connect($_POST["adress"], $_POST["user"], $_POST["pwd"]);
			if ($link === false)
			{
				echo "Les parametres de connexion fournis ne sont pas valides";
				exit;
			}
			else {
				$hl	= @mysqli_select_db($link, $_POST["name"]);
				if ($hl === false)
				{
					echo "Le nom de BDD saisi est invalide ou la BDD n'existe pas";
					exit;
				}
				mysqli_close ($link);
			}
		}
	}
}
?>