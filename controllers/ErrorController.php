<?php

class ErrorController extends Controller {

	// Error 404: Not Found
	public function notFound() {
		View::render('error/404');
	}

}