<?php
echo " in shopify";
class Shopify {
    
    public $_APP_KEY;
    public $_APP_SECRET;

    public function __construct()
    {
        $this->initializeKeys();
    }

    public function initializeKeys()
    {
        $this->_APP_KEY = SHOPIFY_API_KEY;
        $this->_APP_SECRET = SHOPIFY_API_SECRET;
    }
    
    function exchangeTempTokenForPermanentToken($shopifyUrl , $TempCode){
    	echo 'abcde';
    	// encode the data
    	$data = json_encode(array("client_id"=>$this->_APP_KEY , "client_secret"=>$this->_APP_SECRET , "code"=>$TempCode));
    	echo 'efgh'.$data.'<>'.$shopifyUrl;
    	//the curl url
    	$curl_uri = "https://$shopifyUrl/admin/oauth/access_token";
    	echo $curl_uri;
    	// set curl option
    	
    	$ch = curl_init();
    	
    	curl_setopt($ch,CURLOPT_URL , $curl_uri);
    	curl_setopt($ch,CURLOPT_HEADER , false);
    	curl_setopt($ch,CURLOPT_HTTPHEADER , array("Content-Type:application/json")); 
    	curl_setopt($ch,CURLOPT_POSTFIELDS , $data);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER , 1);
    	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER , false);
    	echo 'ch==='.$ch;
    	// execute curl
    	$response = json_decode(curl_exec($ch));
    	$responseInfo = curl_getinfo($ch);
    	
    	
//     	print_r($response);
//     	print_r($responseInfo);
    	// close curl
    	curl_close($ch);
//    	echo 'varDump>>'.var_dump(curl_exec($ch));
    	return $response;
    }

    public function validateMyShopifyName($shop) {
        $subject = $shop;
        $pattern = '/^(.*)?(\.myshopify\.com)$/';
        preg_match($pattern, $subject, $matches);

        return $matches[2] == '.myshopify.com';
    }    

    public function validateRequestOriginIsShopify($code, $shop, $timestamp, $signature) {
        $get_params_string = 'code=' . $code . 'shop=' . $shop . 'timestamp=' . $timestamp . '';
        $calculated_signature = md5(SHOPIFY_APP_PASSWORD . $calculated_signature);

        if ($calculated_signature == $signature) {
            return true;
        } else if ($_GET["origin"] == 'shopify') {
            return true;
        } else {
            return false;
        }
    }
    
    public function getAuthUrl($shop)
    {
    	//echo 'inside getAuth';
        $scopes = ["read_products", "read_orders"];
        return 'https://' . $shop . '/admin/oauth/authorize?'
                . 'scope=' . implode("%2C", $scopes)
                . '&client_id=' . SHOPIFY_API_KEY
                . '&redirect_uri=' . CALLBACK_URL;
    }   
 
} 
?>
