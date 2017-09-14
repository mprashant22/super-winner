<?php

include '../includes/db/Stores.php';
include '../includes/utils/Shopify.php';

$Shopify = new Shopify();
$Stores = new Stores();
$shop = $_REQUEST['shop'];
echo "DOKAAN".$shop;
$shop_info = $Stores->is_shop_exists($shop);

$theme_data = array("asset"=>array("key"=>"templates/customers/login1.liquid","value"=>"<p>We busy updating the store for you and will be back within the hour.<\/p>"));
echo "shopinfooooo";
print_r($shop_info);
$code = isset($_GET["code"]) ? $_GET["code"] : false;

if ($shop && !$code) {
    // validate the shopify url
    if (!$Shopify->validateMyShopifyName($shop)) {
        echo "Invalid shopify url";
    }
    $redirect_url = $Shopify->getAuthUrl($shop);
    header("Location: $redirect_url");
}

if ($code) {
	
	// we want to exchange the temp token passed by the shopify server during the installation process
    // in exchange of a permanent token which we need in order to get/gain access on the shopify store
	$exchange_token_response = $Shopify->exchangeTempTokenForPermanentToken($shop, $code);
 
    // validate access token
    if(!isset($exchange_token_response->access_token) && isset($exchange_token_response->errors)) {        

        // access token is not valid, redirect user to error page
        echo "<pre>";
        print_r($exchange_token_response->errors);
        echo "</pre>";
    }
    
    $access_token = $exchange_token_response->access_token;

    if (empty($access_token)) {
        echo "Invalid access token";
    }
    echo '1211113';
    echo "dukaan".$shop."//";
    // we check if it's a fresh installation
  //  $shop_info = $Stores->is_shop_exists($shop);

    if (empty($shop_info)) {
    	$api_key=SHOPIFY_API_KEY;
    	echo 'fresh installation of app'; // this means that's it's a fresh installation, so we do the installation process
        $Stores->addData(array(
            "store_url" => "'$shop'",
        		"access_key" => "'$api_key'",
            "access_token" => "'$access_token'",
            "created_at" => "'" . date("Y-m-d") . "'"));
        		
    
        		
        
        
    } else {
    	echo "else";
        $Stores->updateData(array(
            "access_token" => "'$access_token'",
            "modified_at" => date("Y-m-d")
        ), "store_url = '$shop'");
    }
    
    /////////////////////////////////////////////////
    //echo "Empty".empty($shop_info);
    
    $get_theme = $Shopify->get_theme_data($shop, $access_token);
    $theme_id = $get_theme->themes[0]->id;echo "THEME ID:".$theme_id;
    $test = "india vs austria vs africa vs england vs south-africa";
    
    $test_data = array("customers"=>array("id"=>5682587493,"email"=>"pra231453t@acmeiqqwech.in",    
    "created_at"=>"2017-09-14T04:20:17-04:00",
    "updated_at"=>"2017-09-13T04:20:17-04:00",
    "first_name"=>"ACME",
    "last_name"=>"Mathur"));
    
    echo "STAAAAAAAAAART";
    echo $shop;
    echo $access_token;
    echo $theme_id;
    echo "ENDDDDDDDD";
   // $Shopify->backupOfLiquid($shop, $access_token, $theme_id);
   // $test_snippet = $Shopify->create_theme_data($shop, $access_token,$theme_id,$test_data);
    $Shopify->createNewCustomer($shop, $access_token,$theme_id,$test_data);
   // $Shopify->fetchCurrentLiquidData($shop, $access_token, $theme_id);
    
    /////////////////////////////////////////////////
    
    echo "yahan tak";
    
    //header("Location: " . APP_URL . "?shop=$shop");
}
?>

<form action="" method="post">
    <input type="text" name="shop" value="" placeholder="ex. your-store.myshopify.com" />
    <input type="submit" value="Submit" />
</form>