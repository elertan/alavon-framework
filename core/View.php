<?php

class View {
	
	// Keys
	const DATA_PAGE_TITLE = "DATA_PAGE_TITLE";

	/**
	 * Renders a page
	 * @param  string $filename The filename
	 * @param  array $data     Arguments for the view
	 * @return void
	 */
	public static function render($filename, $data = []) {
		// Set default page title
		if (!isset($data[View::DATA_PAGE_TITLE])) {
			$data[View::DATA_PAGE_TITLE] = Application::$current->config['pages']['default_title'];
		}

		require('views/templates/head.php');
		self::renderWithoutHeadAndFooter($filename, $data);
		require('views/templates/footer.php');
	}

	/**
	 * Renders a page without a heading and a footer
	 * @param  string $filename The filename
	 * @param  array $data     Arguments for the view
	 * @return void
	 */
	public static function renderWithoutHeadAndFooter($filename, $data = []) {
		if (file_exists('views/' . $filename . '.php')) {
			require('views/' . $filename . '.php');			
		} else {
			self::render('error/404');
		}
	}

}