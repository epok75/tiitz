<?php
/**
* 
*/
class Validator
{
	private static $error = array();

	function __construct()
	{
		# code...
	}

	public static function checkInput (array $value) {
		var_dump($value);
	}

	public static function checkTpl ($post) {
		// Accepted value
		$conform = array('php', 'twig', 'smarty');

		if(!in_array($post, $conform)) {
			self::$error['tpl'] = 'Erreur dans le choix du moteur de template';
			return false;
		}
		return true;
	}

	public static function checkRoute ($post) {
		// Accepted value
		$conform = array('yml', 'php');

		if(!in_array($post, $conform)) {
			self::$error['route'] = 'Erreur dans le choix du langage pour les routes';
			return false;
		}
		return true;
	}

	public static function checkDb (array $post) {
		var_dump($post);
		// check if a least one input isn't empty
		if(!empty($post['user']) || !empty($post['pwd']) || !empty($post['adress']) || !empty($post['name'])) {
			// check that all input are fill up
			if(!empty($post['user']) && !empty($post['pwd']) && !empty($post['adress']) && !empty($post['name']))
			{
				// check database connection
				tzPDO::getInstance($post['adress'],$post['user'], $post['pwd'], $post['name']);
				$pdo = tzPDO::getPDO();

				if(is_null($pdo)) {
					self::$error['connectDb'] = 'La connexion a échoué, vérifier vos identifiant';
					return false;
				}
				return true;

			} else {
				// check and store which input are not fill up in error array
				foreach ($post as $key => $value) {
					if(empty($value)) {
						self::$error[$key] = 'Vous devez remplir une valeur';
					}
				}
				return false;
			}
		} else {
			// noting is fill up
			return true;
		}
	}

	public static function getError(){
		return self::$error;
	}

	
}
?>