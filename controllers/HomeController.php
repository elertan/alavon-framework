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

	public function imageCompressTest() {
		$sourcePath = FileManager::getFilePath("content/images/test.jpg");
		$destinationPath = FileManager::getFilePath("content/images/test_compressed.jpg");

		$imageHelper = new ImageHelper;
		$imageHelper->compress($sourcePath, $destinationPath);

		View::render('home/imageCompressTest', [
			'compressQuality' => ImageHelper::DEFAULT_IMAGE_COMPRESSION_QUALITY
		]);
	}

}