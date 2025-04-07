<?php

use Nurymbet\Core\Error\Config;

$config = Config::getInstance();

$config->set('log_file', root('/storage/logs/server.log'));
$config->set('date_format', 'Y-m-d H:i:s');
$config->set('message_format', '[{type}] {message} in {file}:{line} happened in {date}');
$config->set('colors', [
    'reset'  => "\033[0m",
    'red'    => "\033[31m",
    'yellow' => "\033[33m",
    'blue'   => "\033[34m",
    'green'  => "\033[32m",
]);
