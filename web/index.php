<?php
$start = microtime(true);
require_once("../app/kernel.php");

// toolbar for development environment
if($conf['environnement'] == 'dev') {
	// process of managing error
	DebugTool::$errorExtend->initExtendError(DebugTool::$error->getError());
    // Calcul time loading page
    DebugTool::$toolbar->setTimeLoadingPage(number_format((microtime(true) - $start),4));
    // load Toolbar and display it
	require_once DebugTool::$toolbar->getPathToToolbar();
}