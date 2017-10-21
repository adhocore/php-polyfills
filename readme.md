# adhocore/php-polyfills [![build status](https://travis-ci.org/adhocore/php-polyfills.svg?branch=master)](https://travis-ci.org/adhocore/php-polyfills)

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
