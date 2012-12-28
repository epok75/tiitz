<?php

class Route {

	private static $arrayRoute;

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

	private static function parseRoutes(array $arrayRoutes, array $actualRoute) { // Fonction comparant les routes
		if(isset($actualRoute[0]) && $actualRoute[0] == 'configTiitz')
			$type='config';
		else
			$type = 'site';
		if(!file_exists(ROOT.$arrayRoutes[$type]['ressource']))
			die('Routing file missing');
		$arraySubRoutes = Spyc::YAMLLoad(ROOT.$arrayRoutes[$type]['ressource']);

		foreach ($arraySubRoutes as $key => $params) {
			$arraySubRoutes[$key]['pattern'] = self::deleteEmptyValues(explode('/', $arraySubRoutes[$key]['pattern']));
			//var_dump($arraySubRoutes[$key]['pattern']);
			$arraySubRoutes[$key]['type'] = $type;
			$arraySubRoutes[$key]['params'] = array();
			foreach ($arraySubRoutes[$key]['pattern'] as $_key => $value) {
				if(strpos($value, '{') === 0 && strpos($value , '}') === strlen($value) -1 ) {
					$value = str_replace('{', '', $value);
					$value = str_replace('}', '', $value);
					$arraySubRoutes[$key]['params'][] = array('name' => $value, 'position' => $_key , 'value' => $actualRoute[$_key]);
					$arraySubRoutes[$key]['pattern'][$_key] = $actualRoute[$_key];
				}

			}
			#var_dump($arraySubRoutes[$key]);
			if($arraySubRoutes[$key]['pattern'] == $actualRoute)
				return $arraySubRoutes[$key];
		}
		return false;
	}

	public static function getRoute() { // Fonction retournant la route correspondant a PATH_INFO
		if(empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == '/')
			$urlParams = array();
		else
			$urlParams = self::deleteEmptyValues(explode('/', $_SERVER['PATH_INFO']));

		#echo 'URL PARAM :';var_dump($urlParams);echo '---------<br />';

		$yaml = Spyc::YAMLLoad(ROOT.'/app/config/routing.yml');

		#echo 'YAML SRC :';var_dump($yaml);echo '---------<br />';

		$selectedRoute = self::parseRoutes($yaml, $urlParams);
                var_dump($selectedRoute);
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
			self::$arrayRoute = 'Error no route found';

		return self::$arrayRoute;
	}
}


