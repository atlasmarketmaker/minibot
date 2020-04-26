<?php
require 'api.php';
        
use API\Client\API as API;

$API_KEY      = "";
$API_SECRET   = "";




if(!$api = new API($API_KEY,$API_SECRET)){
	echo "erro de conexão"; return false;
}



#Volume
$response = $api->volume();
var_dump($response);

#Markets
$response = $api->markets();
var_dump($response);

#trades/BTC_BTCQ
$response = $api->trades("BTC_BTCQ");
var_dump($response);

#ticker/BTC_BTCQ
$response = $api->ticker("BTC_BTCQ");
var_dump($response);

#orderbook/BTC_BTCQ
$response = $api->orderbook("BTC_BTCQ");
var_dump($response);

#Buy
/*
$type          = "buy"; //OR sell
$pair          = "BTC-ETH"; 
$executionType = "LIMIT"; 
$unitPrice     = 6442.25;
$quantity      = 0.005000;
$response      = $api->newOrder($type, $pair, $executionType, $unitPrice, $quantity);
var_dump($response);
*/


#Cancel
/*
$order_id		= 1;
$response       = $api->cancelOrder($order_id);
var_dump($response);
*/

#GetBalance
/*
$coin = "BTC"; 
$response = $api->balance($coin);
var_dump($response);
*/


#ListOrders
/*
$pair          = "BTC-ETH"; 
$response      = $api->orders($pair);
var_dump($response);
*/
