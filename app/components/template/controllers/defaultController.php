<?php
/**
 * This class is call by /src/config/routing.yml
 * when no parameters are passed.
 * You can change is behavior, do what you want.
 */
class mainController extends tzController {

	// first method call when the website is launched
	public function mainAction () {
		$this->tzRender->run('/templates/main');                                                        
	}
}