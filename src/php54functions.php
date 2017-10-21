<?php

// Define polyfills in local scope.
// @see http://php.net/manual/en/migration54.functions.php

namespace Ahc;

function hex2bin($hexString)
{
    // Based on http://php.net/manual/en/function.hex2bin.php#105601

    if (\strlen($hexString) % 2) {
        \trigger_error('hex2bin(): Hexadecimal input string must have an even length', E_USER_WARNING);

        return false;
    }

    if (!\preg_match('/^[a-f0-9]+$/i', $hexString)) {
        \trigger_error('hex2bin(): Input string must be hexadecimal string', E_USER_WARNING);

        return false;
    }

    return \pack('H*', $hexString);
}

/** @internal */
function status_codes()
{
    return array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        419 => 'Authentication Timeout',
        420 => 'Enhance Your Calm',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        444 => 'No Response',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        451 => 'Unavailable For Legal Reasons',
        494 => 'Request Header Too Large',
        495 => 'Cert Error',
        496 => 'No Cert',
        497 => 'HTTP to HTTPS',
        499 => 'Client Closed Request',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
        598 => 'Network read timeout error',
        599 => 'Network connect timeout error',
    );
}

function http_response_code($responseCode = null)
{
    // Based on http://php.net/manual/en/function.http-response-code.php#107261

    static $recentCode = null;

    if (null !== $responseCode && !\is_int($responseCode)) {
        \trigger_error('http_response_code() expects parameter 1 to be integer', E_USER_WARNING);

        return null;
    }

    if (PHP_SAPI === 'cli') {
        if (!$responseCode) {
            return $recentCode ? $recentCode : false;
        }

        $toReturn   = $recentCode;
        $recentCode = $responseCode;

        if (!$toReturn) {
            return true;
        }

        return $toReturn;
    }

    if (!$responseCode) {
        return $recentCode ? $recentCode : 200;
    }

    $statusCodes   = status_codes();
    $protocol      = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
    $toReturn      = $recentCode;
    $statusMessage = isset($statusCodes[$responseCode]) ? ' ' . $statusCodes[$responseCode] : '';

    \header("{$protocol} {$responseCode}{$statusMessage}");
    $recentCode    = $responseCode;

    return $toReturn ? $toReturn : 200;
}
