<?php

include '../includes/db/Stores.php';
include '../includes/utils/Shopify.php';

$Shopify = new Shopify();
$Stores = new Stores();
$shop = $_REQUEST['shop'];
$shop_info = $Stores->is_shop_exists($shop);
$get_theme = $Shopify->get_theme_data($shop, $shop_info['access_token']);
$theme_id = $get_theme->themes[0]->id;
$theme_data = array("asset"=>array("key"=>"snippets/prod-text-snippet.liquid","value"=>"<p>We busy updating the store for you and will be back within the hour.<\/p>"));

$code = isset($_GET["code"]) ? $_GET["code"] : false;

if ($shop && !$code) {
    // validate the shopify url
    if (!$Shopify->validateMyShopifyName($shop)) {
        echo "Invalid shopify url";
    }
    $redirect_url = $Shopify->getAuthUrl($shop);
    //echo 'redirect url : '.$redirect_url;
    header("Location: $redirect_url");
    
}

if ($code) {
    echo "KODE>".$code;
	
	// we want to exchange the temp token passed by the shopify server during the installation process
    // in exchange of a permanent token which we need in order to get/gain access on the shopify store
	 $exchange_token_response = $Shopify->exchangeTempTokenForPermanentToken($shop, $code);
	 
	 
	 //////////////////////////////////////////////////
	 
	 
	 
	 
	 $theme_data = array("asset"=>array("key"=>"templates/customers/login.liquid","value"=>"prashant"));
	 $create_theme = $Shopify->create_theme_data($shop, $shop_info['access_token'],$theme_id,$theme_data);
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 ////////////////////////////////////////////////////
	 
	 
 
    // validate access token
    if(!isset($exchange_token_response->access_token) && isset($exchange_token_response->errors)) {
        
        echo "XXXXXXCHNGE OF TOKEN";
        // access token is not valid, redirect user to error page
        echo "<pre>";
        print_r($exchange_token_response->errors);
        echo "</pre>";
    }
    
    $access_token = $exchange_token_response->access_token;
    //echo 'AToken>>'.$access_token;
    if (empty($access_token)) {
        echo "Invalid access token";
    }
    echo '1211113';
    echo "dukaan".$shop."//";
    // we check if it's a fresh installation
    $shop_info = $Stores->is_shop_exists($shop);
    echo $shop_info;
    echo empty($shop_info);
    if (empty($shop_info)) {
    	$api_key=SHOPIFY_API_KEY;
    	echo 'fresh installation of app'; // this means that's it's a fresh installation, so we do the installation process
        $Stores->addData(array(
            "store_url" => "'$shop'",
        		"access_key" => "'$api_key'",
            "access_token" => "'$access_token'",
            "created_at" => "'" . date("Y-m-d") . "'"
        ));
        
        
       // echo "stores>>>>>>".$Stores;
        
    } else {  //echo 'inside updateData.............';
        $Stores->updateData(array(
            "access_token" => "'$access_token'",
            "modified_at" => date("Y-m-d")
        ), "store_url = '$shop'");
    }
    
    header("Location: " . APP_URL . "?shop=$shop");
}
?>

<form action="" method="post">
    <input type="text" name="shop" value="" placeholder="ex. your-store.myshopify.com" />
    <input type="submit" value="Submit" />
</form>