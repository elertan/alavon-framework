<?php

class ModelProvider {

	public static function useModel($name) {
		$path = Application::$current->config['ROOT_PATH'] . '/models/' . $name . '.php';
		require($path);
	}

}