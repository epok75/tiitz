<?php
/**
 * Allow compatibility between differents template engine : one methode for all
 */

class Render {
	
	private $tpl;
	private $render;

	public function __construct($tpl){
		
		switch ($tpl) {
				
			case 'twig':
				require_once ROOT.'/vendors/Twig-1.11.1/lib/Twig/Autoloader.php';
				Twig_Autoloader::register();
				$loader = new Twig_Loader_String();
				$this->render = new Twig_Environment($loader);
				$this->tpl = 'twig';
				break;

			case 'smarty':
				require ROOT.'/vendors/Smarty-3.1.12/Smarty.class.php';
				$this->render = new Smarty();
				$this->tpl = 'smarty';
				break;
		
			default:
				$this->tpl = $tpl;
				break;
		}
	}

	public function run($file , array $prop) {
		if($this->tpl === 'twig') {
			return $this->render->render($file, $prop);
		} elseif ($this->tpl === 'smarty') {
			$this->tpl ->assign($prop);
			return $this->tpl ->display($file);
		} else {
			return require $file;
		}
	}
}