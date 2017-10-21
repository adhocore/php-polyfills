<?php

// Define polyfills in local scope.
// @see http://php.net/manual/en/migration54.functions.php

namespace Ahc;

function hex2bin($hexString)
{
    // Based on http://php.net/manual/en/function.hex2bin.php#105601

    // @todo: validate input.

    return \pack('H*', $hexString);
}
