<?php

class Route {

	private static $arrayRoute;

	private static function deleteEmptyValues(array $array) {
		$arrayReturn = array();
		if(count($array) == 2 && ($array[0] == '' && $array[1] == ''))
			$arrayReturn[] = '/';
		foreach ($array as $key => $value) {
			if($value !== '')
				$arrayReturn[] = $value;
		}
		return $arrayReturn;
	}

	private static function parseRoutes(array $arrayRoutes, array $actualRoute) { // Fonction comparant les routes
		if($actualRoute[0] == 'configTiitz')
			$type='config';
		else
			$type = 'site';

		$yaml = Spyc::YAMLLoad(ROOT.$arrayRoutes[$type]['ressource']);
		var_dump($yaml);die;
		foreach ($arrayRoutes as $key => $params) {
			$arrayRoutes[$key]['pattern'] = self::deleteEmptyValues(explode('/', $arrayRoutes[$key]['pattern']));
			foreach ($arrayRoutes[$key]['pattern'] as $_key => $value) {
				if(strpos($value, '{') === 0 && strpos($value , '}') === strlen($value) -1 )
					$arrayRoutes[$key]['params'] = array('name' => $value, 'requirements' => '');

			}
			if($arrayRoutes[$key]['pattern'] == $actualRoute)
				return $arrayRoutes[$key];
		}
		return false;
	}

	public static function getRoute() { // Fonction retournant la route correspondant a PATH_INFO
		if(empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == '/')
			$urlParams = array();
		else
			$urlParams = self::deleteEmptyValues(explode('/', $_SERVER['PATH_INFO']));

		echo 'URL PARAM :';var_dump($urlParams);echo '---------<br />';

		$yaml = Spyc::YAMLLoad(ROOT.'/app/config/routing.yml');

		echo 'YAML SRC :';var_dump($yaml);echo '---------<br />';

		$selectedRoute = self::parseRoutes($yaml, $urlParams);
		if($selectedRoute){
			$arrayController = explode(':', $selectedRoute['defaults']['_controller']);
			if(count($arrayController) !== 3){
				self::$arrayRoute = 'Error While parsing Controller route';
			} else {
				self::$arrayRoute['path'] = '/'.$arrayController[0].'/'.$arrayController[1].'Controller.php';
				self::$arrayRoute['action'] = $arrayController[2];

			}
			
		}
		else
			self::$arrayRoute = 'Error no route found';

		return self::$arrayRoute;
	}
}

//$array1 = array('er', 'eree');
//$array2 = array('awdawd', 'awd');
//var_dump(array_merge($array1, $array2));

//var_dump($routeArray);
