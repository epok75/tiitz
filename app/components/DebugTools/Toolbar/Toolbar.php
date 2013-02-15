<?php
class Toolbar {
	
	private $path 		= '/views/layout.php';
	private $phpIni 	= array();
	private $conf 		= array();
	private $route		= array();
	private $phpVersion;
	private $frameworkVersion;

	public function __construct($frameworkVersion, array $conf = null, array $route = null){
		$this->phpIni 			= ini_get_all(null, false);
		$this->conf 			= $conf;
		$this->route 			= $route;
		$this->phpVersion 		= phpversion();
		$this->frameworkVersion = $frameworkVersion;
	}

	// getter
	public function getPhpVersion () {
		return $this->phpVersion;
	}
	public function getFrameworkVersion () {
		return $this->frameworkVersion;
	}
	public function getPhpIni () {
		return $this->phpIni;
	}
	public function getRoute() {
		return $this->route;
	}
	public function getConf() {
		return $this->conf;
	}
	public function getPathToToolbar() {
		return __DIR__.$this->path;
	}
	// setter
	public function setFrameworkVersion ($version) {
		$this->frameworkVersion = $version;
	}
}