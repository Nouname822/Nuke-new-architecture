<?php

function module(string $path): string
{
    return dirname(__DIR__, 1) . '/' . ltrim($path, '/');
}
