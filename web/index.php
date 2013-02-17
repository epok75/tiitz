<?php
$start = microtime(true);
require_once("../app/kernel.php");

// toolbar for development environment
if($conf['environnement'] == 'dev') {
	// Calcul time loading page
	DebugTool::$toolbar->setTimeLoadingPage(number_format((microtime(true) - $start),4));
	// process of managing error
	DebugTool::$errorExtend->initExtendError(DebugTool::$error->getError());
	// load Toolbar and display it
	require_once DebugTool::$toolbar->getPathToToolbar();
}