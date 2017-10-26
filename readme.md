## adhocore/php-polyfills

[![Latest Version](https://img.shields.io/github/release/adhocore/php-polyfills.svg?style=flat-square)](https://github.com/adhocore/php-polyfills/releases)
[![Travis Build](https://img.shields.io/travis/adhocore/php-polyfills/master.svg?style=flat-square)](https://travis-ci.org/adhocore/php-polyfills?branch=master)
[![Scrutinizer CI](https://img.shields.io/scrutinizer/g/adhocore/php-polyfills.svg?style=flat-square)](https://scrutinizer-ci.com/g/adhocore/php-polyfills/?branch=master)
[![Codecov branch](https://img.shields.io/codecov/c/github/adhocore/php-polyfills/master.svg?style=flat-square)](https://codecov.io/gh/adhocore/php-polyfills)
[![StyleCI](https://styleci.io/repos/107555333/shield)](https://styleci.io/repos/107555333)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)


Miscellaneous polyfills for older PHP versions. This library should run on any PHP5 versions or later.
At the time being it contains some polyfills for PHP5.4 and PHP5.5. However it is being actively developed and new polyfills will be added from time to time.


# Installation


```bash
composer require adhocore/php-polyfills

```


# Available Polyfills

Please see the native counterpart (linked below) for the documentation and usage.

### PHP5.5

- **array_column** - [native](http://php.net/array_column)

### PHP5.4

- **http_response_code** - [native](http://php.net/http_response_code)
- **hex2bin** - [native](http://php.net/hex2bin)

*and more to come by*

# Tests

The tests for this library runs with latest PHP version and asserts against the native implementation to ensure that the polyfills this library provides are compatible as much as possible.

To run the tests:
```bash
vendor/bin/phpunit
```
