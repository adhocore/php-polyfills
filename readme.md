# adhocore/php-polyfills [![build status](https://travis-ci.org/adhocore/php-polyfills.svg?branch=master)](https://travis-ci.org/adhocore/php-polyfills)

Miscellaneous polyfills for older PHP versions. This library should run on any PHP5 versions or later


# Installation


```bash
composer require adhocore/php-polyfills

```


# Available Polyfills

- **array_column** - [native](http://php.net/array_column)


# Tests

The tests for this library runs with latest PHP version and asserts against the native implementation to ensure that the polyfills this library provides are compatible as much as possible.

To run the tests:
```bash
vendor/bin/phpunit
```
