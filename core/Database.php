<?php

class Database {

	public static $connection;

	public static function connect($config) {
		self::$connection = new mysqli($config['DB_HOST'], $config['DB_USER'], $config['DB_PASS'], $config['DB_NAME']);
	}


	public static function fetchAllAssocFromResponse($response) {
		$data = [];
		while ($row = $response->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

	public static function fetchFirstAssocFromResponse($response) {
		return self::fetchAllAssocFromResponse($response)[0];
	}

}