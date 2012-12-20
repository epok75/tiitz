<?php
define("ROOT", realpath(__DIR__."/../")); // base of the web site
define("GUI", realpath(__DIR__."/gui/")); // base of the GUI

// Include YAML parsing tool
require_once(ROOT.'/app/components/spyc/Spyc.php');
$comp = Spyc::YAMLLoad(ROOT.'/app/config/components.yml'); // components list
$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml'); // Configuration 

// Include the compnents contains in components.yml
foreach ($comp as $k => $v) {
	require_once(ROOT.$v);
}

if (!empty($conf["project"]) && $conf["project"] === true)
{
	if (!empty($conf["template"]))
		$tz_render = Render::getInstance($conf["template"]);
	else
		$tz_render = Render::getInstance("");
}
else
	require_once GUI."\\index.php";

//var_dump($conf)