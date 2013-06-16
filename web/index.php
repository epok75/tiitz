<?php
$start = microtime(true);
require_once "../vendors/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php";
require '../vendors/autoload.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->useIncludePath(true);

$loader->registerNamespaces(array(
 
 	"App" => __DIR__."/..",

	));

$loader->register();

App\Components\Kernel\TzKernel::execute();

// toolbar for development environment
if(App\Components\Kernel\Tzkernel::$tzConf['environnement'] == 'dev') {
	// Calcul time loading page
	App\Components\DebugTools\DebugTool::$toolbar->setTimeLoadingPage(number_format((microtime(true) - $start),4));
	// process of managing error
	App\Components\DebugTools\DebugTool::$errorExtend->initExtendError(App\Components\DebugTools\DebugTool::$error->getError());
	// load Toolbar and display it
	require_once App\Components\DebugTools\DebugTool::$toolbar->getPathToToolbar();
}