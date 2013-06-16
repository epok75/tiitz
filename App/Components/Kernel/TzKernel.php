<?php

/**
** 	tzKernel is the main class of tiitz, the kernel load all the components, routes 
**	and call the controller. All the kernel infos could be access with the following line.
**
**	tzKernel::tzRoute for example
**
*/

namespace App\Components\Kernel;
use App\Components\Tiitz\Tiitz;
use App\Components\Spyc\Spyc;
use App\Components\DebugTools\DebugTool;
use App\Components\RenderTplEngine\TzRender;
use App\Components\Router\TzRouter;

class TzKernel
{
	// The Tiitz object, use for global settings
	public static $tiitz;

	// The configuration set by the users of the framework
	public static $tzConf;

	// The configuration for dev mode
	public static $tzDevConf;

	// The render object containing all the informations to print the view
	public static $tzRender;

	// The current route informations
	public static $tzRoute;

	// URL parameters
	public static $tzParam;

	public static $existingProject = false;

	public static function execute() {

		self::bootstrap();
		self::getRender();
		self::getRoute();
		self::getDatabase();
		self::route();
	}

	private static function bootstrap() {

		// Start sessions
		session_start();

		// Defines of usefull constants used by the framework
		define("ROOT", realpath(__DIR__."/../../../"));

		// We load the tiitz class to set the global configuration used by the framework
		self::$tiitz = new Tiitz();

		self::getConfiguration();

		self::initTools();
	}

	private static function getConfiguration() {

		self::$tzConf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml');
		self::$tzDevConf = Spyc::YAMLLoad(ROOT.'/app/config/config_dev.yml');
	}

	private static function getRender() {

		if (!empty(self::$tzConf["template"]))
			self::$tzRender = TzRender::getInstance(self::$tzConf["template"]);
		else
			self::$tzRender = TzRender::getInstance("");
	}

	private static function getRoute() {

		if (self::$existingProject === true) 
			self::$tzRoute = TzRouter::getRoute(self::$tzConf);
		else
			self::$tzRoute = TzRouter::getRoute(self::$tzConf, "gui");
	}

	private static function initTools() {

		// Error manager
		DebugTool::initDebugTools('0.3', self::$tzDevConf);

		if (!empty(self::$tzConf["existingproject"]) && self::$tzConf["existingproject"] === true)
			self::$existingProject = true;
	}

	private static function getDatabase() {

		if(!empty(self::$tzConf['database']['user']) && self::$existingProject === true) {
			TzSQL::getInstance(self::$tzConf['database']['host'], 
								self::$tzConf['database']['user'], 
								self::$tzConf['database']['password'], 
								self::$tzConf['database']['dbname']);
		}
	}

	private static function route() {
		if (is_file(ROOT.self::$tzRoute["path"])) {
			require_once ROOT.self::$tzRoute["path"];

			if(!empty(self::$tzRoute['params'])){
				foreach (self::$tzRoute['params'] as $param) {
					self::$tzParam['params'][$param['name']] = $param['value'];
				}
			}
		}
		else {
			self::$tzRoute = TzRouter::getNotFoundRoute();

			if (is_file(ROOT.self::$tzRoute["path"])) {
				require_once ROOT.self::$tzRoute["path"];
			}
		}

		// We create the controller instance and call the requested actions
		if (class_exists(self::$tzRoute["className"])) {
	        $controller = new self::$tzRoute["className"]();
	        $route = self::$tzRoute;

	        if (method_exists($controller, self::$tzRoute["action"])) {
	        	if(!empty(self::$tzRoute['params'])){
	        		$controller->$route["action"](self::$tzParam['params']);
	        	} else {
	        		$controller->$route["action"]();
	        	}
	        }
	        else
	            DebugTool::$error->catchError(array("No action ".self::$tzRoute["action"]." Found", __FILE__,__LINE__));
	    }
	    else
	        DebugTool::$error->catchError(array("No Class ".self::$tzRoute["className"]." Found", __FILE__,__LINE__));
	}
}