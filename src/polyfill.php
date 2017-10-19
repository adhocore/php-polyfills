<?php

// Apply polyfills to global scope if required.

require_once __DIR__ . '/functions.php';

if (!function_exists('array_column')) {
	function array_column($array, $columnKey, $indexKey = null)
	{
		return \Ahc\array_column($array, $columnKey, $indexKey);
	}
}
