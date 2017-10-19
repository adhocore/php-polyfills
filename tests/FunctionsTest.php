<?php

class FunctionsTest extends PHPUnit\Framework\TestCase
{
    /** @dataProvider array_column_data */
    public function test_array_column($message, ...$parameters)
    {
        $this->assertEquals(
            \array_column(...$parameters),     # expected = native   implementation
            \Ahc\array_column(...$parameters), # actual   = userland implementation
            $message
        );
    }

    public function array_column_data()
    {
        return \array_column([[
            'message'   => 'array of array, null columnKey, null indexKey',
            'array'     => [['a' => 1, 'b' => 1], ['a' => 2, 'b' => 2]],
            'columnKey' => null,
            'indexKey'  => null,
        ], [
            'message'   => 'array of object, null columnKey, null indexKey',
            'array'     => [(object)['a' => 1, 'b' => 1], (object)['a' => 2, 'b' => 2]],
            'columnKey' => null,
            'indexKey'  => null,
        ], [
            'message'   => 'array of array, null columnKey, string indexKey',
            'array'     => [['a' => 1, 'b' => 1], ['a' => 2, 'b' => 2]],
            'columnKey' => null,
            'indexKey'  => 'a',
        ], [
            'message'   => 'array of object, null columnKey, string indexKey',
            'array'     => [(object)['a' => 1, 'b' => 1], (object)['a' => 2, 'b' => 2]],
            'columnKey' => null,
            'indexKey'  => 'a',
        ], [
            'message'   => 'array of array, null columnKey, integer indexKey',
            'array'     => [['a' => 1, 5 => 1], ['a' => 2, 5 => 2]],
            'columnKey' => null,
            'indexKey'  => 1,
        ], [
            'message'   => 'array of object, null columnKey, integer indexKey',
            'array'     => [(object)['a' => 1, 5 => 1], (object)['a' => 2, 5 => 2]],
            'columnKey' => null,
            'indexKey'  => 1,
        ], [
            'message'   => 'array of array, null columnKey, non existent indexKey',
            'array'     => [['a' => 1, 10.5 => 1], ['a' => 2, 10.5 => 2]],
            'columnKey' => null,
            'indexKey'  => 'non-existent',
        ], [
            'message'   => 'array of object, null columnKey, non existent indexKey',
            'array'     => [(object)['a' => 1, 10.5 => 1], (object)['a' => 2, 10.5 => 2]],
            'columnKey' => null,
            'indexKey'  => 'non-existent',
        ], [
            'message'   => 'array of array, null columnKey, partial-existent indexKey',
            'array'     => [['a' => 1, 10.5 => 1], ['a' => 2, 'partial-existent' => 2]],
            'columnKey' => null,
            'indexKey'  => 'partial-existent',
        ], [
            'message'   => 'array of object, null columnKey, partial-existent indexKey',
            'array'     => [(object)['a' => 1, 10.5 => 1], (object)['a' => 2, 'partial-existent' => 2]],
            'columnKey' => null,
            'indexKey'  => 'partial-existent',
        ], [
            'message'   => 'array of array, string columnKey, null indexKey',
            'array'     => [['a' => 1, 'b' => 1], ['a' => 2, 'b' => 2]],
            'columnKey' => 'a',
            'indexKey'  => null,
        ], [
            'message'   => 'array of object, string columnKey, null indexKey',
            'array'     => [(object)['a' => 1, 'b' => 1], (object)['a' => 2, 'b' => 2]],
            'columnKey' => 'a',
            'indexKey'  => null,
        ], [
            'message'   => 'array of array, integer columnKey, null indexKey',
            'array'     => [['a' => 1, 5 => 1], ['a' => 2, 5 => 2]],
            'columnKey' => 1,
            'indexKey'  => null,
        ], [
            'message'   => 'array of object, integer columnKey, null indexKey',
            'array'     => [(object)['a' => 1, 5 => 1], (object)['a' => 2, 5 => 2]],
            'columnKey' => 1,
            'indexKey'  => null,
        ], [
            'message'   => 'array of array, non-existent columnKey, null indexKey',
            'array'     => [['a' => 1, 10.5 => 1], ['a' => 2, 10.5 => 2]],
            'columnKey' => 'non-existent',
            'indexKey'  => null,
        ], [
            'message'   => 'array of object, non-existent columnKey, null indexKey',
            'array'     => [(object)['a' => 1, 10.5 => 1], (object)['a' => 2, 10.5 => 2]],
            'columnKey' => 'non-existent',
            'indexKey'  => null,
        ], [
            'message'   => 'array of array, partial-existent columnKey, null indexKey',
            'array'     => [['a' => 1, 10.5 => 1], ['a' => 2, 'partial-existent' => 2]],
            'columnKey' => 'partial-existent',
            'indexKey'  => null,
        ], [
            'message'   => 'array of object, partial-existent columnKey, null indexKey',
            'array'     => [(object)['a' => 1, 10.5 => 1], (object)['a' => 2, 'partial-existent' => 2]],
            'columnKey' => 'partial-existent',
            'indexKey'  => null,
        ], [
            'message'   => 'array of array, object columnKey, object indexKey',
            'array'     => [['a' => 1, 'b' => 1], ['a' => 2, 'b' => 2]],
            'columnKey' => new class { function __toString() { return 'a'; } },
            'indexKey'  => new class { function __toString() { return 'b'; } },
        ], [
            'message'   => 'array of object, object columnKey, object indexKey',
            'array'     => [(object)['a' => 1, 'b' => 1], (object)['a' => 2, 'b' => 2]],
            'columnKey' => new class { function __toString() { return 'a'; } },
            'indexKey'  => new class { function __toString() { return 'b'; } },
        ], [
            'message'   => 'array of real object, string columnKey, string indexKey',
            'array'     => [
                new class { public $a = 1; public $b = 1; },
                new class { public $a = 2; public $b = 2; },
            ],
            'columnKey' => 'a',
            'indexKey'  => 'b',
        ], [
            'message'   => 'array of array, string columnKey, duplicate indexKey',
            'array'     => [['a' => 1, 'b' => 1], ['a' => 2, 'b' => 2], ['a' => 3, 'b' => 2]],
            'columnKey' => 'a',
            'indexKey'  => 'b',
        ],
        ], null, 'message');
    }
}
