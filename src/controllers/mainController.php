<?php 

class mainController extends TzController {
	 public function showAction () {
		$this->tzRender->run('/templates/main');
	}
}
 ?>