<?php

class HomeController extends Controller {

	public function index() {
		// Get a model
		ModelProvider::useModel('SampleModel');
		$message = SampleModel::getRandomBirdMessage();

		// Render view home/index and pass information to the view to be rendered
		View::render('home/index', [
			View::DATA_PAGE_TITLE => 'Alavon Framework',
			'message_of_the_day' => $message
		]);
	}

}