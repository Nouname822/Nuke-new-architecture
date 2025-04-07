<?php

require_once __DIR__ . '/helpers/functions.php';
require_once module('/vendor/autoload.php');

// Файл маршрутов
require_once module('/routes/web.php');

$dotenv = Dotenv\Dotenv::createImmutable(module(''));
$dotenv->load();
