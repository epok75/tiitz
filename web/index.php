<?php
require_once("../app/kernel.php");

// toolbar for development environment
if($conf['environnement'] == 'dev') {
	// process of managing error
	DebugTool::$errorExtend->initExtendError(DebugTool::$error->getError());
	// load Toolbar and display it
	require_once DebugTool::$toolbar->getPathToToolbar();
}