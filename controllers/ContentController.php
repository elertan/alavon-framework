<?php

class ContentController extends Controller {

	public function doesResourceExist($url) {
		return file_exists($url);
	}

	public function sendResource($url) {
		include($url);
	}

}