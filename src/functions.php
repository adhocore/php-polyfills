<?php

// Define polyfills in local scope.

namespace Ahc;

function array_column($array, $columnKey, $indexKey = null)
{
    $result = array();

    if (!\is_array($array)) {
        \trigger_error('array_column() expects parameter 1 to be array', E_USER_WARNING);

        return null;
    }

    if (null !== $columnKey) {
        if (\is_object($columnKey) && !\method_exists($columnKey, '__toString')) {
            \trigger_error('array_column() expects parameter 2 to be number/string/null', E_USER_WARNING);

            return null;
        }

        $columnKey = \is_float($columnKey) ? (int) $columnKey : (string) $columnKey;
    }

    if (null !== $indexKey) {
        if (\is_object($indexKey) && !\method_exists($indexKey, '__toString')) {
            \trigger_error('array_column() expects parameter 3 to be number/string/null', E_USER_WARNING);

            return null;
        }

        $indexKey = \is_float($indexKey) ? (int) $indexKey : (string) $indexKey;
    }

    foreach ($array as $value) {
        $objectVars = \is_object($value) ? \get_object_vars($value) : array();

        $key = null;
        if (null !== $indexKey) {
            if (\is_array($value) && \array_key_exists($indexKey, $value)) {
                $key = $value[$indexKey];
            } elseif (\array_key_exists($indexKey, $objectVars) || isset($value->{$indexKey})) {
                $key = $value->{$indexKey};
            }
        }

        if (null !== $columnKey) {
            if (\is_array($value) && \array_key_exists($columnKey, $value)) {
                $value = $value[$columnKey];
            } elseif (\array_key_exists($columnKey, $objectVars) || isset($value->{$columnKey})) {
                $value = $value->{$columnKey};
            } else {
                continue;
            }
        }

        if (null === $key) {
            $result[] = $value;
        } else {
            $result[$key] = $value;
        }
    }

    return $result;
}
