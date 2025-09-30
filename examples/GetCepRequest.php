<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use \ChicoRei\Packages\Correios\Correios;
use \ChicoRei\Packages\Correios\Account;
use ChicoRei\Packages\Correios\Util;

$correios = new Correios(Account::create([
    'username' => '',
    'password' => '',
    'contract' => '',
    'postcard' => '',
]));

try {
    // Total
    $response = $correios->cepHandler()->get('');

    $arrayResponse = $response->toArray();
    var_dump(Util::cleanArray($arrayResponse));
} catch (Exception $e) {
    echo 'Code: ' . $e->getCode() . PHP_EOL;
    echo 'Message: ' . $e->getMessage() . PHP_EOL;
}
