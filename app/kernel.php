<?php
define("ROOT", realpath(__DIR__."/../")); // base of the web site
require_once("../app/components/views.class.php");
require_once("../app/components/validator.class.php");
require_once(ROOT.'/app/components/spyc/Spyc.php'); // YAML parser
$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml'); // Configuration 