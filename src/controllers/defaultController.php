<?php
/**
 * This class is call by /src/config/routing.yml
 * when no parameters are passed.
 * You can change is behavior, do what you want.
 */
class defaultController extends TzController {

	// first method call when the website is launched
	public function showAction () {
		$userInfo = array(
			'firstname' => 'Benjamin',
			'password'	=> 'azerty91'
			);
		tzAuth::login($userInfo);
		var_dump(tzAuth::readUser());
		//tzAuth::logout();
		//var_dump(tzAuth::readUser());
		$this->tzRender->run('/templates/default');                                                        
	}

	public function logoutAction(){
		tzAuth::logout();
		var_dump(tzAuth::readUser());
		$this->tzRender->run('/templates/default');    
	}
}