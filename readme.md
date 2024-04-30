# PHP Random KeyGenerator

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/ucscode/keygenerator/blob/main/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/ucscode/keygenerator)](https://php.net)

PHP Random KeyGenerator is a versatile PHP library for generating random keys of varying lengths. 
It is an essential tool for creating secure authentication tokens, unique identifiers, or random access keys.

## Features

- **Versatile Usage**: Can be used for various purposes such as generating authentication tokens, unique identifiers, or random access keys.
- **Simplicity**: Provides a simple and easy-to-use interface, making it straightforward to integrate into your projects.
- **Modern PHP Compatibility**: Compatible with PHP 8.1 and higher, ensuring compatibility with modern PHP environments.
- **PSR-4 Autoloading**: Follows PSR-4 autoloading standards for seamless integration with Composer-based projects.

## Direct Installation

You can require the file in your project directly:

```php
require '/path/to/src/KeyGenerator.php';
```

## Installation Via Composer

You can also install the package via Composer. Run the following command:

```bash
composer require ucscode/keygenerator
```

## Usage

```php
use Ucscode\KeyGenerator\KeyGenerator;

// Create a new instance of the key generator
$keyGenerator = new KeyGenerator();

// Generate a random key of length 10
$key = $keyGenerator->generateKey(10);
```

### Instance Configuration

Optionally, you can configure the  `KeyGenerator` instance

```php
/**
 * Generate random keys between 'A' and 'Z'
 * 
 * @param string|array
 */
$keyGenerator->setCharacters(range('A', 'Z'));

/** 
 * This will also generate random keys between 'A' and 'Z' 
 * 
 * @param string|array
 */
$keyGenerator->setCharacters('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

/**
 * Add more possible characters to the list of generated keys
 * 
 * @param string|array
 */
$keyGenerator->addCharacters(['#', '@', '%']);

/**
 * Remove one or more possible character from the list
 * 
 * The "@" symbol will not be part of possible value from the characters
 * 
 * @param string|array
 */
$keyGenerator->removeCharacters('@');

/**
 * Apply usage of the system default special characters
 * 
 * By default, if not configuration is made, the key generator will only contain alpha numeric outputs
 * 
 * @param bool
 */
$keyGenerator->applySpecialCharacters(true);
```
## License

Ucscode KeyGenerator is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

If you encounter any issues or have questions regarding the usage of this package, please feel free to [open an issue](https://github.com/ucscode/keygenerator/issues) on GitHub.
