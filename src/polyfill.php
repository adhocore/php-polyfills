<?php

// Apply polyfills to global scope if required.

/*
 * -----
 * PHP5.5
 * -----
 */
if (PHP_VERSION_ID < 50500) {
require_once __DIR__ . '/php55functions.php';

if (!function_exists('array_column')) {
    function array_column($array, $columnKey, $indexKey = null)
    {
        return \Ahc\array_column($array, $columnKey, $indexKey);
    }
}
}

/*
 * ------
 * PHP5.4
 * ------
 */
if (PHP_VERSION_ID < 50400) {
require_once __DIR__ . '/php54functions.php';

if (!function_exists('hex2bin')) {
    function hex2bin($hexString)
    {
        return \Ahc\hex2bin($hexString);
    }
}

if (!function_exists('http_response_code')) {
    function http_response_code($responseCode = null)
    {
        return \Ahc\http_response_code($responseCode);
    }
}

}
