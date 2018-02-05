<?php
require __DIR__."/../vendor/autoload.php";


use LuhnAlgo\Card;
use LuhnAlgo\Test\Test;

$test_directory = __DIR__.'/testdata/';
$test = new Test($test_directory);
$card = new Card();
$result = $test->execute($card);
//print_r($result);
echo '---------------------------------------------------------------------------------------------------'.PHP_EOL;
echo "|\t".str_pad('Issuing Network',18)."|\t".str_pad( 'Card Number',18)."|\t".str_pad('Is Valid Card Number' ,25)."|\t".str_pad('Status', 10).'|'.PHP_EOL;
foreach ($result as $card) 
{
    $msg = $card['isValidNumber']    ? 'yes' : 'No';
    echo '---------------------------------------------------------------------------------------------------'.PHP_EOL;
    echo "|\t".str_pad($card['cardName'],18)."|\t".str_pad( $card['cardNumber'],18)."|\t".str_pad($msg ,25)."|\t".str_pad($card['status'], 10).'|'.PHP_EOL;    
}
echo '---------------------------------------------------------------------------------------------------'.PHP_EOL;
