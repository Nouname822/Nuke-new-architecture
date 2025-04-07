<?php

use Nurymbet\Core\Container\Config;

$config = Config::getInstance();

$config->set('bootstrap_file_name', 'bootstrap.php');
$config->set('modules_folder_path', root('/modules'));
