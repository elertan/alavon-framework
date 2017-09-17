<?php
class Application {

	public static $current;

	private $controller;
	private $parameters;
	private $controllerName;
	private $methodName;

	public $config;

	private function loadCore() {
		$currentFileName = basename(__FILE__);
		$files = glob("core/*.php");
		foreach ($files as $file) {
			// Is the select file the current file?
			if (strpos($file, $currentFileName) != false) {
				continue;
			}
			require($file);
		}
	}

	private function readUrl()
	{
		$url = Server::get('REQUEST_URI');
		// Is it the default url?
		if ($url == "/") {
			$url = "/home/index";
		}
		$url = trim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);

		$this->controllerName = isset($url[0]) ? $url[0] : "Home";
		$this->methodName = isset($url[1]) ? $url[1] : "index";

		unset($url[0], $url[1]);

		$this->parameters = array_values($url);
	}

	private function parseUrl()
	{
		// HomeController
		$this->controllerName = ucwords($this->controllerName) . "Controller";
	}

	private function showNotFoundError()
	{
		require("controllers/ErrorController.php");
		$this->controller = new ErrorController();
		$this->controller->notFound();
	}

	private function executeRequest()
	{
		$controllerPath = "controllers/" . $this->controllerName . ".php";
		if (file_exists($controllerPath)) {
			require($controllerPath);
			$this->controller = new $this->controllerName();

			if ($this->controllerName == "ContentController") {
				// custom
				$url = Server::get('REQUEST_URI');
				if ($this->controller->doesResourceExist($url)) {
					$this->controller->sendResource($url);
				}
				return;
			}

			// Does this method exist?
			if (method_exists($this->controller, $this->methodName)) {
				// Do we have parameters to pass?
				if (!empty($this->parameters)) {
					// Execute with parameters
					call_user_func_array([$this->controller, $this->methodName], $this->parameters);
				} else {
					// Execute without parameters
					$this->controller->{$this->methodName}();
				}
			} else {
				$this->showNotFoundError();
			}
		} else {
			$this->showNotFoundError();
		}
		die();
	}

	public function run()
	{
		// Loading core
		$this->loadCore();

		// Database connection
		//Database::connect($this->config['database']);

		$this->readUrl();
		$this->parseUrl();
		// Execute controller method
		$this->executeRequest();
	}

}