<?php

require 'libs/shopify.php';
define('SHOPIFY_API_KEY', '4bf32fb06e5fc1b2dbde39e17690a20e');
define('SHOPIFY_SECRET', 'XXXX');
define('SHOPIFY_SHOP', 'nmsshop.myshopify.com');

$variant = array(
		'sku' => 'tieRed',
		'id' => 1109059849,
		'title' => 'Red',
		'inventory_quantity'=>'17'
);
$product = array(
		'id' =>  422795077,
		'variants' => array($variant)
);
$json['product'] = $product;

$stock = json_encode($json);

$sc = new ShopifyClient(SHOPIFY_SHOP, 'XXXX', SHOPIFY_API_KEY, SHOPIFY_SECRET);

try {
	$put = $sc->call('PUT', '/admin/products/#422795077.json',$stock);
	if ($put > 0) {
		echo $stockVal . ': success';
	} else {
		echo 'fail';
	}
} catch (ShopifyApiException $e)
{
	echo 'API fail';
	print_r($e);
}
catch (ShopifyCurlException $e)
{
	echo 'Curl fail (PUT)';
	print_r($e);
}