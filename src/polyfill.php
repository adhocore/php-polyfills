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
