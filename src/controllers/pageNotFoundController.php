<?php
/**
 *	This class is called when the url doesn't match with any Route.
**/
Class pageNotFoundController extends tzController {

	public function showAction () {
		$this->tiitzData['tzRender']->run('/templates/pageNotFound');
	}
}