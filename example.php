<?php 

require_once __DIR__.'/vendor/autoload.php';
use KS\Aras\Aras;

$aras = new Aras([
	'username' => 'neodyum',
    'password' => 'nd2580',
    'sandbox' => true // Test sistemlerinde denemek yapmak için
]);

try {
    $result = $aras->CreateShipment([
        'InvoiceNumber' => '124324',
        'ReceiverName' => 'John'
    ]);

    var_dump($result);

} catch (Exception $e) {
    var_dump($e->getMessage());
}