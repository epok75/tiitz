<?php
define("ROOT", realpath(__DIR__."/../")); // base of the web site

// Include YAML parsing tool
require_once(ROOT.'/app/components/spyc/Spyc.php');
$comp = Spyc::YAMLLoad(ROOT.'/app/config/components.yml');
$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml');


// Include the components contains in components.yml
foreach ($comp as $k => $v) {
	require_once(ROOT.$v);
}

$pageURL = 'http';

if ( isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
	$pageURL .= "s";
}

$pageURL .= "://";

if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
}

$pageURL = str_replace('index.php', '', $pageURL);

define('WEB_PATH', $pageURL);


// Manage Error
$error = new tzErrorExtend(0);

if (!empty($conf["template"]))
	$tzRender = tzRender::getInstance($conf["template"]);
else
	$tzRender = tzRender::getInstance("");



if (!empty($conf["existingproject"]) && $conf["existingproject"] === true) 
	$route = tzRoute::getRoute();
else
	$route = tzRoute::getRoute("gui");

	

if (is_file(ROOT.$route["path"])) {
	require_once ROOT.$route["path"];
	if(!empty($conf['database']['user']) && !empty($conf["existingproject"]) && $conf["existingproject"] === true) {
		tzSQL::getInstance($conf['database']['host'],$conf['database']['user'],$conf['database']['password'],$conf['database']['dbname']);
		$controller = new $route["className"]($tzRender);
	}
	else {
		$controller = new $route["className"]($tzRender);
	}
	$controller->$route["action"]();
}
else
	echo "Page 404";

// toolbar for development environment
if($conf['environnement'] == 'dev') {
	// Config php.ini
	$ini = ini_get_all(null, false);
	$errorArray = $error->exportArray();
	
	$toolbar = new DevToolbar($ini, $errorArray, $route);
	$toolbarAdress = $toolbar ->toolbar();
	require_once $toolbarAdress; 
}