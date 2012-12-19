<?php
define("ROOT", realpath(__DIR__."/../")); // base of the web site

// Include of usefull components, do not delete
require_once(ROOT.'/app/components/spyc/Spyc.php');
require_once(ROOT.'/app/components/router.class.php');
require_once(ROOT.'/app/components/sqlConnect.class.php'); 

$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml'); // Configuration 


/*

	Analyse/interpretation conf object

	Connection bdd

	

*/
//$routeArray = route::getRoute();

//var_dump($routeArray);

var_dump($conf);