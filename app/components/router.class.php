<?php

class Route {

	private static $arrayRoute;

	private static function deleteEmptyValues (array $array) {
		$arrayReturn = array();
		foreach ($array as $key => $value) {
			if($value !== '')
				$arrayReturn[] = $value;
		}
		return $arrayReturn;
	}

	private static function parseRoutes(array $arrayRoutes, array $actualRoute) {
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

	public static function getRoute () {
		$urlParams = self::deleteEmptyValues(explode('/', $_SERVER['PATH_INFO']));
		$yaml = Spyc::YAMLLoad(ROOT.'/app/config/routing.yml');

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

//$routeArray = route::getRoute();

//var_dump($routeArray);
