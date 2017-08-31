<?php

include '../includes/db/Stores.php';
include '../includes/utils/Shopify.php';

$Shopify = new Shopify();
$Stores = new Stores();
$shop = $_REQUEST['shop'];

$shop_info = $Stores->is_shop_exists($shop);
$get_theme = $Shopify->get_theme_data($shop, $shop_info['access_token']);
$theme_id = $get_theme->themes[0]->id;
$theme_data = array("asset"=>array("key"=>"templates/customers/login1.liquid","value"=>"<p>We busy updating the store for you and will be back within the hour.<\/p>"));

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

	 /////////////////////////////////////////////////
	 
	// echo "SHOPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP".$shop_info['access_token'];
	 $col_text = "forcollectioninproductcollections";
	 $login_data = array("asset"=>array("key"=>"templates/customers/login2.liquid","value"=>$col_text));
	 $create_theme = $Shopify->create_theme_data($shop, $shop_info['access_token'],$theme_id,$login_data);
	 //$response=$Shopify->put_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=templates/customers/login2.liquid&theme_id='.$theme_id.'&asset[value]='.$login_data['key'], SHOPIFY_API_KEY, $exchange_token_response->access_token, $shop, $theme_id);
	 print_r($response);
	 
	 
	 /////////////////////////////////////////////////
 
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
  //  $shop_info = $Stores->is_shop_exists($shop);
   // echo $shop_info;
   // echo empty($shop_info);
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