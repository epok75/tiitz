<?php
// Global configuration for the framework
require_once("../app/components/tiitz.class.php");
$tiitz = new TiiTz();
define("ROOT", realpath(__DIR__."/../")); // base of the web site

// Array containing Main data use in Tiitz Kernel and Tiitz Controllers
$tiitzData = array();

// Include YAML parsing tool
require_once(ROOT.'/app/components/spyc/Spyc.php');
$comp = Spyc::YAMLLoad(ROOT.'/app/config/components.yml');
$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml');


// Include the components contains in components.yml
foreach ($comp as $k => $v) {
	require_once(ROOT.$v);
} 

// Manage Error
$error = new tzErrorExtend(0);

if (!empty($conf["template"]))
	$tzRender = tzRender::getInstance($conf["template"]);
else
	$tzRender = tzRender::getInstance("");

if (!empty($conf["existingproject"]) && $conf["existingproject"] === true) 
	$route = tzRoute::getRoute($conf);
else
	$route = tzRoute::getRoute($conf, "gui");

if (is_file(ROOT.$route["path"])) {
	require_once ROOT.$route["path"];

	if(!empty($conf['database']['user']) && !empty($conf["existingproject"]) && $conf["existingproject"] === true) {
		tzSQL::getInstance($conf['database']['host'],$conf['database']['user'],$conf['database']['password'],$conf['database']['dbname']);
	}

	if(!empty($route['params'])){
		foreach ($route['params'] as $value) {
			$tiitzData['params'][$value['name']] = $value['value'];
		}
	}

	// We fill $tiitzData with tiitz infos
	$tiitzData['route'] = $route;
	$tiitzData['conf'] = $conf;
	$tiitzData['tzRender'] = $tzRender;

	// We create the controller instance and call the requested actions
	$controller = new $route["className"]($tiitzData);
	$controller->$route["action"]();
}
else {
	require_once $error->getPageNotFound();
}
