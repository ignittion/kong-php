# Kong-php

<p align="center">
  <a href="https://travis-ci.org/ignittion/kong-php"><img src="https://travis-ci.org/ignittion/kong-php.svg?branch=master" alt="Build Status"></a>
  <a href="https://styleci.io/repos/64416976"><img src="https://styleci.io/repos/64416976/shield?branch=master" alt="StyleCI"></a>
  <a href="https://packagist.org/packages/ignittion/kong-php"><img src="https://poser.pugx.org/ignittion/kong-php/downloads?format=flat-square" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/ignittion/kong-php"><img src="https://poser.pugx.org/ignittion/kong-php/v/stable?format=flat-square" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/ignittion/kong-php"><img src="https://poser.pugx.org/ignittion/kong-php/license?format=flat-square" alt="License"></a>
</p>

## About

A PHP Library for interacting with the Kong API Gateway Admin.

## Official Documentation

Coming Soon...

## Issues

If you have any issues please create a new [Support](https://github.com/ignittion/kong-php/issues) ticket.

## Requirements

+ PHP >= 5.5.9
+ PHP5-cURL Extension

## Installation

Installation via Composer:

```
composer require ignittion/Kong-php
```

## Configuration

### PHP

Import the composer autoload file.

```php
require 'vendor/autoload.php';
```

Define the Kong URL and Admin Port:

```php
define('KONG_URL', 'https://kong-gateway.com');
define('KONG_PORT', 8001);
```

### Laravel 5.1+

Add the Service Provider in `config/app.php`:

```php
Ignittion\Kong\KongServiceProvider::class,
```

Add the Class Alias in `config/app.php`:

```php
'Kong' => Ignittion\Kong\Facades\Kong::class,
```

Publish the `kong.php` config file:

```php
php artisan vendor:publish
```

### Lumen

Copy the `src/config/kong.php` to `/path/to/root/config/kong.php`

Register the ServiceProvider in `bootstrap/app.php`:

```php
$app->register(Ignittion\Kong\KongServiceProvider::class);
$app->configure('kong');
```

Register Alias in `bootstrap/app.php` (optional):

+ Uncomment Facades: `$app->withFacades();`
+ Register Alias: `class_alias(Ignittion\Kong\Facades\Kong::class, 'Kong');`

## Usage

### PHP

```php
$kong = new \Ignittion\Kong\Kong(KONG_URL, KONG_PORT);
$nodes = $kong->node()->get();
```

### Laravel 5.1+

```php
$nodes = Kong::node()->get();
```

### Lumen

```php
$nodes = app('kong')->nodes()->get();
```

## License

Kong-php is open-source software and licensed under the [MIT License](http://opensource.org/licenses/MIT).

Kong is Copyright Mashape, inc.
