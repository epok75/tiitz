<?php
require_once 'DebugTool.php';
use DebugTool\DebugTool as Debug;
// load components logic
Debug::initDebugTools('..','0.2', array("save"=>true,"display"=>true,"logPath"=>""));
// Logic of the website

// include 'test';

// process of managing error
Debug::$errorExtend->initExtendError(Debug::$error->getError());
// load Toolbar and display it
require_once Debug::$toolbar->getPathToToolbar();




