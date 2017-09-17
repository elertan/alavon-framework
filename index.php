<?php
set_include_path(__DIR__);

$config = require("config/config.php");
$config['ROOT_PATH'] = __DIR__;

require('core/Application.php');

$app = new Application();
$app->config = $config;
Application::$current = $app;

$app->run();