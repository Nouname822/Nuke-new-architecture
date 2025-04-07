<?php

use Nurymbet\Core\Server;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Helpers/functions.php';
require_once root('/bootstrap/config.php');

$dotenv = Dotenv\Dotenv::createImmutable(root(''));
$dotenv->load();

return Server::config(header: config('header'), jwtToken: config('app.jwt_token'), timezone: config('app.timezone', 'Europe/Moscow'))::database(db_name: $_ENV['DB_NAME'], db_user: $_ENV['DB_USER'], db_password: $_ENV['DB_PASS'], db_host: $_ENV['DB_HOST'], db_port: $_ENV['DB_PORT'])->create();
