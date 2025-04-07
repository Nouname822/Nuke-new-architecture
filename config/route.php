<?php

use Nurymbet\Route\Core\Config;
use Nurymbet\Route\Http\Request;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;

$config = Config::getInstance();

$config->set('auth.root', root('/routes/web.php'));
$config->set('cache_dir', root('/storage/cache'));
$config->set('route_dir', root('/modules'));
$config->set('route_root_dir', 'routes');
$config->set('prefix', 'api');
$config->set('cache_namespace', 'route_cache');
$config->set('redis', RedisAdapter::createConnection('redis://127.0.0.1:6379'));
$config->set('resource_route', [
    [
        'http_method' => 'post',
        'prefix_name' => 'create',
        'handler_method_name' => 'create',
    ],
    [
        'http_method' => 'get',
        'prefix_name' => 'show',
        'handler_method_name' => 'show',
    ],
    [
        'http_method' => 'put',
        'prefix_name' => 'update',
        'handler_method_name' => 'update',
    ],
    [
        'http_method' => 'delete',
        'prefix_name' => 'destroy',
        'handler_method_name' => 'destroy',
    ],
]);
$config->set('cache_keys', [
    'routes_array' => 'routes',
    'routes_name_array' => 'routes_names',
]);

function RequestConfig(): void
{
    $config = Request::getInstance();

    $jsonData = json_decode(file_get_contents('php://input'), true);
    $isJson = json_last_error() === JSON_ERROR_NONE && is_array($jsonData);

    $params = array_merge($_POST, $_FILES);
    $allParams = array_merge($params, $_GET);

    if ($isJson) {
        $params = array_merge($params, $jsonData);
        $allParams = array_merge($allParams, $jsonData);
    }

    $config->set('path', $_SERVER['REQUEST_URI']);
    $config->set('method', $_SERVER['REQUEST_METHOD']);
    $config->set('host', $_SERVER['HTTP_HOST'] ?? null);
    $config->set('auth', $_SERVER['HTTP_AUTHORIZATION'] ?? null);
    $config->set('cache_control', $_SERVER['HTTP_CACHE_CONTROL'] ?? null);
    $config->set('os', $_SERVER['HTTP_SEC_CH_UA_PLATFORM'] ?? null);
    $config->set('user_agent', $_SERVER['HTTP_USER_AGENT'] ?? null);
    $config->set('scheme', (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
    $config->set('port', $_SERVER['SERVER_PORT'] ?? null);
    $config->set('query', $_GET);
    $config->set('param', $params);
    $config->set('all_param', $allParams);
    $config->set('date', date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
}
