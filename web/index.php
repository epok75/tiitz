<?php
$start = microtime(true);
require_once "../vendors/ClassLoader/UniversalClassLoader.php";

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->useIncludePath(true);

$loader->registerNamespaces(array(
 
	"App" => __DIR__."/../",
	"Src" => __DIR__."/../",

	));

var_dump($loader);
$loader->register();
App\TzKernel::execute();

// toolbar for development environment
if(Tzkernel::$tzConf['environnement'] == 'dev') {
	// Calcul time loading page
	DebugTool::$toolbar->setTimeLoadingPage(number_format((microtime(true) - $start),4));
	// process of managing error
	DebugTool::$errorExtend->initExtendError(DebugTool::$error->getError());
	// load Toolbar and display it
	require_once DebugTool::$toolbar->getPathToToolbar();
}