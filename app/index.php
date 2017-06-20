<link href="../templates/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../templates/bootstrap.min.css"  rel="stylesheet" type="text/css">


<?php
echo "in   app  index";
require __DIR__. '../../includes/utils/Shopify.php';
require __DIR__. '../../includes/db/Stores.php';
require __DIR__. '../../app/Export_Sync.php';

$Shopify = new Shopify();
echo '$ shopify'.$Shopify;
$Stores = new Stores();
echo '$ stores'.$Stores;

$shop = $_GET['shop'];
$shop_info = $Stores->is_shop_exists($shop);

echo "<pre>";
echo 'shop_info>>'.$shop_info;
echo "</pre>";

echo "access token is: " . $shop_info[0]['access_token'];
$products = $Shopify->get_products($shop, $shop_info[0]['access_token']);
echo 'products>>'.$products;

echo "<pre>";
print_r($products->products);
echo "</pre>";

?>
