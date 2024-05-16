<?php

date_default_timezone_set('Africa/Cairo');

define('ROOT', "/var/www/src");

require ROOT . '/vendor/System/Application.php';
require ROOT . '/vendor/System/File.php';

use System\File;
use System\Application;

$file = new File(ROOT);

$app = Application::getInstance($file);

$app->run();
