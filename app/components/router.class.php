<?php

class Route {

	private static $arrayRoute;

	private static function checkRequirement(array $req, array $params) {

		$valid = array();
		$match = array();
		foreach ($params as $k => $v) {

			if (array_key_exists($params[$k]["name"], $req)) 
			{
				if ($req[$params[$k]["name"]] == "int") {
					$valid['int'] = (is_int($params[$k]["value"])) ? true : false;
				}
				else if ($req[$params[$k]["name"]] == "string") {
					$valid['string'] = (is_string($params[$k]["value"])) ? true : false;
				}
				else
				{
					if (preg_match("/".$req[$params[$k]["name"]]."/", $params[$k]["value"]))
						$match[$params[$k]["name"]] = true;
					else
						$match[$params[$k]["name"]] = false;
				}
			}

			if (array_key_exists("_method", $req))
			{
				if ($req["_method"] == "post" || $req["_method"] == "POST")
					$valid['post'] = (!empty($_POST)) ? true : false;

				if ($req["_method"] == "get" || $req["_method"] == "GET")
					$valid['get'] = (!empty($_GET)) ? true : false;
			}
		}

		foreach ($match as $value) {
			if ($value === false)
				$valid["regexp"] = false;
		}
		foreach ($valid as $value) {
			if ($value === false)
				return false;
		}
		return true;
	}

	private static function deleteEmptyValues(array $array) {
		#var_dump($array);
		$arrayReturn = array();
		if(count($array) == 2 && ($array[0] == '' && $array[1] == ''))
			$arrayReturn = array();
		foreach ($array as $key => $value) {
			if($value !== '')
				$arrayReturn[] = $value;
		}
		return $arrayReturn;
	}

	private static function parseRoutes(array $arrayRoutes, array $actualRoute, $mode) { // Fonction comparant les routes
		if(isset($actualRoute[0]) && $actualRoute[0] == 'configTiitz')
			$type='config';
		else
			$type = 'site';
		if(!file_exists(ROOT.$arrayRoutes[$type]['ressource']))
			die('Routing file missing');
		$arraySubRoutes = Spyc::YAMLLoad(ROOT.$arrayRoutes[$type]['ressource']);

		#echo "ROUTE : ";var_dump($arraySubRoutes);echo "--------------<br />";

		foreach ($arraySubRoutes as $key => $params) {
			$arraySubRoutes[$key]['pattern'] = self::deleteEmptyValues(explode('/', $arraySubRoutes[$key]['pattern']));
			//var_dump($arraySubRoutes[$key]['pattern']);
			$arraySubRoutes[$key]['type'] = $type;
			$arraySubRoutes[$key]['params'] = array();

			foreach ($arraySubRoutes[$key]['pattern'] as $_key => $value) {
				if(strpos($value, '{') === 0 && strpos($value , '}') === strlen($value) -1 ) {
					$value = str_replace('{', '', $value);
					$value = str_replace('}', '', $value);
					if(!empty($actualRoute[$_key])) {
						$arraySubRoutes[$key]['params'][] = array('name' => $value, 'position' => $_key , 'value' => $actualRoute[$_key]);
						$arraySubRoutes[$key]['pattern'][$_key] = $actualRoute[$_key];
					}
				}

			}
			#echo "CHOSEN ROUTE : ";var_dump($arraySubRoutes[$key]);echo "--------------<br />";

			$r = true;
			if (!empty($arraySubRoutes[$key]['requirements']))
				$r = self::checkRequirement($arraySubRoutes[$key]['requirements'], $arraySubRoutes[$key]['params']);

			if($arraySubRoutes[$key]['pattern'] == $actualRoute && $r)
				return $arraySubRoutes[$key];
		}
		return false;
	}

	public static function getRoute($mode = "defaults") { // Fonction retournant la route correspondant a PATH_INFO
		if(empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == '/')
			$urlParams = array();
		else
			$urlParams = self::deleteEmptyValues(explode('/', $_SERVER['PATH_INFO']));

		#echo 'URL PARAM :';var_dump($urlParams);echo '---------<br />';

		$yaml = Spyc::YAMLLoad(ROOT.'/app/config/routing.yml');

		#echo 'YAML SRC :';var_dump($yaml);echo '---------<br />';

		$selectedRoute = self::parseRoutes($yaml, $urlParams, $mode);


        #echo "SELECTED ROUTE : ";var_dump($selectedRoute);echo "--------------<br />";

		if($selectedRoute){
			$arrayController = explode(':', $selectedRoute['defaults']['_controller']);
			if(count($arrayController) !== 2){
				self::$arrayRoute = 'Error While parsing Controller route';
			} else {
				if($selectedRoute['type'] == 'config')
					self::$arrayRoute['path'] = '/app/gui/controller/'.$arrayController[0].'Controller.php';
				else
					self::$arrayRoute['path'] = '/src/controller/'.$arrayController[0].'Controller.php';
				self::$arrayRoute['action'] = $arrayController[1].'Action';
                                self::$arrayRoute['className'] = $arrayController[0].'Controller';
				self::$arrayRoute['params'] = $selectedRoute['params'];
			}
			
		}
		else
			ErrorExtend::catchError('No Route Found');

		return self::$arrayRoute;
	}
}
