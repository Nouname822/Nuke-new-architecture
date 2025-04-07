<?php

function root(string $path = ''): string
{
    return dirname(__DIR__, 2) . '/' . ltrim($path, '/');
}

function config(string $key, ?string $default = null): mixed
{
    $keys = explode('.', $key);
    $value = include root('config/' . $keys[0] . '.php');
    unset($keys[0]);

    foreach ($keys as $k) {
        if (!is_array($value) || !array_key_exists($k, $value)) {
            return $default;
        }
        $value = $value[$k];
    }

    return $value;
}
