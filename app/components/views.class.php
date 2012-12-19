<?php


/*
Voici ce qu'il faut rajouter dans le kernel> C'est un simple exemple


 <?php
define('ROOT', realpath(__dir__.'/..'));
//var_dump(ROOT);

if (file_exists(ROOT.'/app/components/views.class.php')) {
	require_once ROOT.'/app/components/views.class.php';

	$tplEngine = Render::getInstance('smarty');
	// call method to insert your template
	$tplEngine->run('test', array('name'=>'arnaud',
										'prenom'=>'raulet',
										'renseignement' => array('adresse' => '44 rue de la federation','ville' => 'Montreuil'))); 
	
	// $tplEngine->run('test');
	print('<pre>');
		var_dump($tplEngine->getRender());
	print('</pre>');

} else {
	print ROOT.'/app/components/views.class.php';
}
 */




/**
 * Allow compatibility between differents template engines : one methode for all
 * This is time for more pleasure and more boobs! :-)
 */

class Render {
	
	private static $instance;
	// default path for the views in smarty and twig
	private static $path;
	// some defaults settings
	private $tpl 	= 'php';
	private $ext 	= 'php';
	private $cache 	= false;
	// array that store object of either smarty or twig
	private $renderedPage = array();
	
	private function __construct($tpl){
		
		switch ($tpl) {
			
			case 'twig':
				if (file_exists(ROOT.'/vendors/Twig-1.11.1/lib/Twig/Autoloader.php')) {
					require_once ROOT.'/vendors/Twig-1.11.1/lib/Twig/Autoloader.php';
					Twig_Autoloader::register();
					$loader = new Twig_Loader_Filesystem(self::$path);
					$this->renderedPage = new Twig_Environment($loader);
					$this->tpl = 'twig';
					$this->ext = 'html.twig';
				} else {
					die('Failed loaded Twig');
				}
				break;

			case 'smarty':
				if (file_exists(ROOT.'/vendors/Smarty-3.1.12.2/libs/Smarty.class.php')) {
					require_once ROOT.'/vendors/Smarty-3.1.12.2/libs/Smarty.class.php';
					$this->renderedPage = new Smarty();
					$this->renderedPage->setTemplateDir(self::$path);
					$this->tpl = 'smarty';
					$this->ext = 'tpl';
				} else {
					die('Failed loaded smarty');
				}
				break;				
		
			default:
				$this->ext = $this->tpl = 'php';
				break;
		}
	}

	// singleton
	public static function getInstance($tpl) {
		if (!is_null(self::$instance)) {
			return self::$instance;
		} else {
			// set the path for the view
			self::$path = ROOT.'/src/';
			self::$instance = new Render($tpl);
			return self::$instance;
		}
	}

	public function run($file , array $prop = null) {
		// check if the file exist
		$this->fileExists($file);

		//return the template depending of the engine chosen by the user
		if($this->tpl === 'twig') {
			// display twig template
			print $this->renderedPage->render($file.'.html.twig', $prop);
		} elseif ($this->tpl === 'smarty') {
			// check if there are arguments pass to the method to avoid bug
			if ($prop !== null) {
				$this->renderedPage ->assign($prop);	
			}
			// display smarty template
			$this->renderedPage ->display($file.'.tpl');
		} else {
			// if there is no template engine chosen, just make a require
			return require self::$path.$file.'.php';
		}
	}
	
	// check if the file pass through the method exist
	private function fileExists($file) {
		if (file_exists(self::$path.$file.'.'.$this->ext)) {
			return true;
		} else {
			die('failed to load the file, check the path');
		}
	}

	// setter ; set the cache if it's true on config.yml
	/*public static function setCache($bool){
		die('ewdwdewed');
		$this->$cache = $bool;
		$this->renderedPage->setCacheDir(ROOT.'/app/cache');
	}*/

	// getter
	public function getTpl() {
		return $this->tpl;
	}
	public function getRender(){
		return $this->renderedPage;
	}
	public function getPath() {
		return self::$path;
	}
} 
