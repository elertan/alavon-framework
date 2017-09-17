<?php

class Redirect {

	public static function to($url) {
		header('location: ' . $url);
	}

}