<?php
/**
 * This class is call by /src/config/routing.yml
 * when no parameters are passed.
 * You can change is behavior, do what you want.
 */
class defaultController extends TzController {

	// first method call when the website is launched
	public function showAction () {
		var_dump($this->Auth->login(array('user' => 'lol', 'password' => 'lol' )));
		var_dump($this->Auth->readUser());
		var_dump($this->Auth->readUser('user'));
		$this->Auth->logout();
		var_dump($this->Auth->readUser());
		$this->tzRender->run('/templates/default');                                                        
	}
}