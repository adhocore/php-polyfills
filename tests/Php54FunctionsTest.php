<?php

namespace Ahc\Tests;

use PHPUnit\Framework\TestCase;

class Php54FunctionsTest extends TestCase
{
    private $errors;

    public function errorHandler($errno, $errstr, $errfile, $errline, $errcontext)
    {
        $this->errors[] = compact('errno', 'errstr', 'errfile',
            'errline', 'errcontext');
    }

    public function assertError($errstr, $errno)
    {
        foreach ($this->errors as $error) {
            if ($error['errstr'] === $errstr
                && $error['errno'] === $errno) {
                return;
            }
        }
        $this->fail('Error with level ' . $errno .
            " and message '" . $errstr . "' not found in ",
            var_export($this->errors, true));
    }

    /** @dataProvider hex2bin_data */
    public function test_hex2bin($message, $hexString)
    {
        $this->assertEquals(
            \hex2bin($hexString),     // expected = native   implementation
            \Ahc\hex2bin($hexString), // actual   = userland implementation
            $message
        );
    }

    /**
     * @expectedException \PHPUnit\Framework\Error\Warning
     * @expectedExceptionMessage hex2bin(): Hexadecimal input string must have an even length
     */
    public function test_hex2bin_invalid_length()
    {
        $this->assertFalse(@\Ahc\hex2bin('a'));

        \Ahc\hex2bin('1');
    }

    /**
     * @expectedException \PHPUnit\Framework\Error\Warning
     * @expectedExceptionMessage hex2bin(): Input string must be hexadecimal string
     */
    public function test_hex2bin_non_hex()
    {
        $this->assertFalse(@\Ahc\hex2bin('zz'));

        \Ahc\hex2bin('yx');
    }

    /** @dataProvider http_response_code_data */
    public function test_http_response_code($message, $responseCode)
    {
        $this->assertEquals(
            \http_response_code($responseCode),     // expected = native   implementation
            \Ahc\http_response_code($responseCode), // actual   = userland implementation
            $message
        );
    }

    public function test_http_response_code_with_invalid_code()
    {
        $this->errors = [];
        set_error_handler([$this, 'errorHandler']);

        $result = \Ahc\http_response_code('invalid_code');

        $this->assertError('http_response_code() expects parameter 1 to be integer', E_USER_WARNING);
        $this->assertNull($result);
    }

    public function hex2bin_data()
    {
        return [[
            'message'   => 'all decimal',
            'hexString' => '6578616d706c65206865782064617461',
        ], [
            'message'   => 'all hex',
            'hexString' => 'aabbcc',
        ], [
            'message'   => 'mix',
            'hexString' => 'aa61bb74cc',
        ],
        ];
    }

    public function http_response_code_data()
    {
        return [[
            'message'      => 'null',
            'responseCode' => null,
        ], [
            'message'      => 'zero',
            'responseCode' => 0,
        ], [
            'message'      => 'hundred',
            'responseCode' => 100,
        ], [
            'message'      => 'null',
            'responseCode' => null,
        ], [
            'message'      => 'zero',
            'responseCode' => 0,
        ], [
            'message'      => '4 hundred',
            'responseCode' => 400,
        ], [
            'message'      => '2 hundred',
            'responseCode' => 200,
        ],
        ];
    }
}
