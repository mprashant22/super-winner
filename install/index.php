<?php

include '../includes/db/Stores.php';
include '../includes/utils/Shopify.php';

$Shopify = new Shopify();
$Stores = new Stores();
$shop = $_REQUEST['shop'];
echo "Shop=======".$shop;
$code = isset($_GET["code"]) ? $_GET["code"] : false;
echo "code;;;;;;;;;;".$code;

if ($shop && !$code) {echo "ohkay";
    // validate the shopify url
    if (!$Shopify->validateMyShopifyName($shop)) {
        echo "Invalid shopify url";
    }
    
    $redirect_url = $Shopify->getAuthUrl($shop);
    echo 'redirect url : '.$redirect_url;
    header("Location: $redirect_url");
    
}

if ($code) {echo 'ohkay1';
    // we want to exchange the temp token passed by the shopify server during the installation process
    // in exchange of a permanent token which we need in order to get/gain access on the shopify store
    $exchange_token_response = $Shopify->exchangeTempTokenForPermanentToken($shop, $code);
    echo 'exchange token  : '.$exchange_token_response;
    // validate access token
    if(!isset($exchange_token_response->access_token) && isset($exchange_token_response->errors)) {
        // access token is not valid, redirect user to error page
        echo "<pre>";
        print_r($exchange_token_response->errors);
        echo "</pre>";
    }
    
//     echo "<pre>";
//     print_r($exchange_token_response);
//     echo "</pre>";
    
    $access_token = $exchange_token_response->access_token;
    echo 'acess tokken >>'.$access_token;
    if (empty($access_token)) {
        echo "Invalid access token";
    }
    
    // we check if it's a fresh installation
    $shop_info = $Stores->is_shop_exists($shop);
    echo 'shopInfo>>'.$shop_info;
    if (!empty($shop_info)) {
    	$api_key=SHOPIFY_API_KEY;
    	echo 'fresh installation of app'; // this means that's it's a fresh installation, so we do the installation process
        $Stores->addData(array(
            "store_url" => "'$shop'",
        		"access_key" => "'$api_key'",
            "access_token" => "'$access_token'",
            "created_at" => "'" . date("Y-m-d") . "'"
        ));
        
        
        echo "stores>>>>>>".$Stores;
        
    } else {echo 'inside updateData.............';
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