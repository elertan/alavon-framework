<?php

class FileManager {

	private static function joinPaths() {
	    $paths = array();

	    foreach (func_get_args() as $arg) {
	        if ($arg !== '') { $paths[] = $arg; }
	    }

	    return preg_replace('#/+#','/',join('/', $paths));
	}

	public static function getFilePath($relativePath) {
		return self::joinPaths(Application::$current->config['ROOT_PATH'], $relativePath);
	}

}