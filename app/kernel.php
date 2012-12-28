<?php
define("ROOT", realpath(__DIR__."/../")); // base of the web site
define("SRC", realpath(ROOT."/src"));
define("GUI", realpath(ROOT."/app/gui/")); // base of the GUI

// Test error
require_once(ROOT.'/app/components/error/ErrorCore.class.php');
require_once(ROOT.'/app/components/error/ErrorExtend.class.php');
$error = new ErrorExtend(3);

print '<pre>';
//var_dump($error -> exportArray());
//var_dump($error -> exportJson());
print '</pre>';
//include ('test.php');



// Include YAML parsing tool
require_once(ROOT.'/app/components/spyc/Spyc.php');
$comp = Spyc::YAMLLoad(ROOT.'/app/config/components.yml');
$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml');


// Include the components contains in components.yml
foreach ($comp as $k => $v) {
	require_once(ROOT.$v);
}

if (!empty($conf["existingproject"]) && $conf["existingproject"] === true)
{
	if (!empty($conf["template"]))
		$tz_render = Render::getInstance($conf["template"]);
	else
		$tz_render = Render::getInstance("");

	$route = route::getRoute();
	var_dump($route);
	if (is_file(ROOT.$route["path"])) {
		require_once ROOT.$route["path"];
	}
	else
		echo "Page 404";
}
else
	require_once GUI."\\index.php";


/*$routeArray = route::getRoute();

var_dump($routeArray);*/

//var_dump($conf);

require_once("../app/components/views.class.php");
require_once("../app/components/validator.class.php");
require_once(ROOT.'/app/components/spyc/Spyc.php'); // YAML parser
$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml'); // Configuration 