<?php
define('START', microtime(true));

if (file_exists($app = __DIR__ . '/../bootstrap/app.php')) {
    require $app;
} else {
    die("App not found");
}
