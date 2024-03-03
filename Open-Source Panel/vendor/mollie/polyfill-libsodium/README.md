# Polyfill Libsodium

A simple Polyfill for giving libsodium compatibility when having sodium installed.

[![Build Status](https://travis-ci.org/mollie/polyfill-libsodium.svg?branch=master)](https://travis-ci.org/mollie/polyfill-libsodium)

The new sodium extension has been accepted and will be distributed with PHP >= 7.2.  
This will have a few breaking changes:

- No more `\Sodium\` namespace. Everything must be in the global namespace.
- The extension will be renamed to `sodium`. 
- `\Sodium\randombytes_buf()` and `\Sodium\randombytes_random16()` have been removed. 

So the current namespaced functions will not work anymore. So we created a polyfill for this.

Reference: https://github.com/jedisct1/libsodium-php

# Installation

**Using Composer:**  

The easiest way to install is to require the polyfill-libsodium library with Composer:  
```shell
composer require mollie/polyfill-libsodium
```

After installation of the package the bootstrap.php file will be autoloaded.

**Manual installation:**  
Checkout or download all the files and include them manually into your project.

Include the bootstrap file in your project: 
```php
require 'vendor/mollie/polyfill-libsodium/bootstrap.php';
```

# License
This software is licensed under the [MIT License](LICENSE)

© 2017 Mollie
