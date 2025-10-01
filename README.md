# Correios Web Service client wrapper for PHP

[![Build Status](https://travis-ci.org/chico-rei/correios-php.svg?branch=master)](https://travis-ci.org/chico-rei/correios-php) 
[![Coverage Status](https://coveralls.io/repos/github/chico-rei/correios-php/badge.svg?branch=master)](https://coveralls.io/github/chico-rei/correios-php?branch=master)
[![Latest Stable Version](https://poser.pugx.org/chico-rei/correios-php/v/stable)](https://packagist.org/packages/chico-rei/correios-php)
[![License](https://poser.pugx.org/chico-rei/correios-php/license)](https://packagist.org/packages/chico-rei/correios-php)

This is a PHP client wrapper for [Correios Web Service](https://cws.correios.com.br/).

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require chico-rei/correios-php "dev-master"
```

Requires PHP 7.4 or newer.

## Features

* [x] Token
    * [x] **POST** /v1/autentica ``getClient()->getToken()``
    * [x] **POST** /v1/autentica/contrato ``getClient()->getToken()``
    * [x] **POST** /v1/autentica/cartaopostagem ``getClient()->getToken()``
* [ ] CEP
    * [x] **GET** /v2/enderecos/{cep} ``cepHandler()->get()``
    * [ ] ...
* [x] Pré-Postagem
    * [x] **GET** /v2/prepostagens ``prePostagemHandler()->query()``
    * [x] **POST** /v1/prepostagens ``prePostagemHandler()->create()``
    * [x] **DELETE** /v1/prepostagens/objeto/{codigoObjeto} ``prePostagemHandler()->deleteByCode()``
    * [ ] ...
* [ ] ...

## Usage

```php
use \ChicoRei\Packages\Correios\Correios;
use \ChicoRei\Packages\Correios\Account;

try {
    $correios = new Correios(
        Account::create([
            'username' => '',
            'password' => '',
            'contract' => '',
            'postcard' => '',
        ])
    );

    $response = $correios->cepHandler()->get('36033-007');
    
    echo $response->getLogradouro() . PHP_EOL;
    echo $response->getUf() . PHP_EOL;
} catch (Exception $e) {
    echo 'Code: ' . $e->getCode() . PHP_EOL;
    echo 'Message: ' . $e->getMessage() . PHP_EOL;
}
```

See [examples](examples) for more.

## Testing

```bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.