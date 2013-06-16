<?php
$start = microtime(true);
require_once "../vendors/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php";
require '../vendors/autoload.php';
require_once '../vendors/twig/twig/lib/Twig/Autoloader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;


Twig_Autoloader::register();
$loader = new UniversalClassLoader();
$loader->useIncludePath(true);

$loader->registerNamespaces(array(
 
	"App" => __DIR__."/../",
	"App\Components\Auth\\" => __DIR__."/../App/Components/Auth",
	"App\Components\Tiitz\\" => __DIR__."/../App/Components/Tiitz",
	"App\Components\Controller\\" => __DIR__."/../App/Components/Controller",
	"App\Components\DebugTools\\" => __DIR__."/../App/Components/DebugTools",
	"App\Components\FileManager\\" => __DIR__."/../App/Components/FileManager",
	"App\Components\RenderTplEngine\\" => __DIR__."/../App/Components/RenderTplEngine",

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