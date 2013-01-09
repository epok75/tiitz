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

//$fullStr = 'http://'.$_SERVER['SERVER_NAME'].'/'.substr($_SERVER['SCRIPT_NAME'], 0,stripos($_SERVER['SCRIPT_NAME'],'index.php'));

// Manage Error
$error = new ErrorExtend(3);

if (!empty($conf["existingproject"]) && $conf["existingproject"] === true)
{
	if (!empty($conf["template"]))
		$tz_render = Render::getInstance($conf["template"]);
	else
		$tz_render = Render::getInstance("");

	$route = route::getRoute();
	if (is_file(ROOT.$route["path"])) {
		require_once ROOT.$route["path"];
		$controller = new $route["className"];
		$controller->$route["action"]();
	}
	else
		echo "Page 404";
}
else
{
	if (is_file(ROOT."\\app\\gui\\controller\\guiController.php")) {
		require_once ROOT."\\app\\gui\\controller\\guiController.php";
		$controller = new guiController;
		$controller->checkAction();
	}
	else
		echo "Page 404";
}
var_dump($route);
// toolbar for development environment
if($conf['environnement'] == 'dev') {
	devToolbar::toolbar($conf['environnement'], $route);
}

