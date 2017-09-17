<?php

// Sample Bird Model

class SampleModel {

	public static function getRandomBirdMessage() {
		$messages = ["Birds are cool", "Fly fly!", "Wohoo"];
		return $messages[rand(0, 2)];
	}

	public static function all() {
		$query = "SELECT * FROM bird";
		$response = Database::$connection->query($query);
		return Database::fetchAllAssocFromResponse($response);
	}

	public static function find($id) {
		$query = "SELECT * FROM bird WHERE id = " . $id;
		$response = Database::$connection->query($query);
		if (!$response) {
			return null;
		} else {
			return Database::fetchFirstAssocFromResponse($response);
		}
	}

	public static function update($bird) {
		$query = "UPDATE bird
		 SET name='" . $bird['name'] . "',
		 description='" . $bird['description'] . "',
		 biotope='" . $bird['biotope'] . "',
		 size=" . $bird['size'] . ",
		 migratory='" . $bird['migratory'] . "'
		 WHERE id = " . $bird['id'];

		return Database::$connection->query($query);
	}

	public static function delete($id) {
		$query = "DELETE FROM bird WHERE id = " . $id;
		return Database::$connection->query($query);
	}

	public static function create($bird) {
		$query = "INSERT INTO bird (name, description, biotope, size, migratory) VALUES 
				 ('" . $bird['name'] . "',
				  '" . $bird['description'] . "',
				  '" . $bird['biotope'] . "',
				  " . $bird['size'] . ",
				  '" . $bird['migratory'] . "'
				 )";
		return Database::$connection->query($query);
	}

	public static function generateBirdArrayByPost() {
		$bird = [
				'id' => Request::post('id'),
				'name' => Request::post('name'),
				'description' => Request::post('description'),
				'biotope' => Request::post('biotope'),
				'size' => Request::post('size'),
				'migratory' => Request::post('migratory') ? 'Y' : 'N'
			];
		return $bird;
	}

}