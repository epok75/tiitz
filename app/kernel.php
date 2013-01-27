<?php
// include and instanciate global configuration for the framework
require_once("../app/components/tiitz.class.php");
$tiitz = new TiiTz();

define("ROOT", realpath(__DIR__."/../")); // base of the web site

// Include YAML parsing tool
require_once(ROOT.'/app/components/spyc/Spyc.php');
// Parse components and config files
$comp = Spyc::YAMLLoad(ROOT.'/app/config/components.yml');
$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml');

// Include the components contains in components.yml
foreach ($comp as $k => $v) {
	require_once(ROOT.$v);
} 


// Manage Error
$error = new tzErrorExtend(0);
require 'test.php';
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
		$controller = new $route["className"]($tzRender);
	}
	else {
		$controller = new $route["className"]($tzRender);
	}
	if(!empty($route['params'])){
		$params = array();
		foreach ($route['params'] as $value) {
			$params[$value['name']] = $value['value'];
		}
		$controller->$route["action"]($params);
	} else {
		$controller->$route["action"]();
	}
}
else
	echo "Page 404";
