<?php

namespace helpers;

function array_get($array, $key, $default = null)
{
    $keysArray = explode('.', $key);
    $path = $array;

    for ($i = 0; $i < count($keysArray); $i++) {
        if (is_array($path) && array_key_exists($keysArray[$i], $path)) {
            $path = $path[$keysArray[$i]];
        } else {
            return $default;
        }
    }

    return $path;
}

function includeView($templateName, $data)
{
    include $templateName;
    return $data;
}
