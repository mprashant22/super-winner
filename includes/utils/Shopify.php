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
    
    public function exchangeTempTokenForPermanentToken($ShopifyURL, $TempCode)
    {
    	// encode the data
    	$data = json_encode(array("client_id" => $this->_APP_KEY, "client_secret" => $this->_APP_SECRET, "code" => $TempCode));
    	
    	// the curl url
    	$curl_url = "https://$ShopifyURL/admin/oauth/access_token";
    	
    	return $this->curlRequest($curl_url, null, $data);
    }
    
    private function curlRequest($url, $access_token = NULL, $data = NULL)
    {
    	// set curl options
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	
    	$http_headers = array("Content-Type:application/json");
    	if ($access_token) {
    		$http_headers = array("Content-Type:application/json", "X-Shopify-Access-Token: $access_token");
    	}
    	
    	curl_setopt($ch, CURLOPT_HEADER, false); // Include header in result? (0 = yes, 1 = no)
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	
    	if ($data) {
    		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	}
    	
    	$output = curl_exec($ch); // Download the given URL, and return output
    	echo "output>>".$output;
    	if ($output === false) {
    		return 'Curl error: ' . curl_error($ch);
    	}
    	
    	curl_close($ch); // Close the cURL resource, and free system resources
    	
    	return json_decode($output);
    	
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
    	$scopes = ["read_products", "read_orders","write_products","write_orders","read_themes", "write_themes"];
        return 'https://' . $shop . '/admin/oauth/authorize?'
                . 'scope=' . implode("%2C", $scopes)
                . '&client_id=' . SHOPIFY_API_KEY
                . '&redirect_uri=' . CALLBACK_URL;
    }   
    
    public function create_theme_data($shop, $access_token,$theme_id,$tdata)
    {        
        echo "TDATAAAAAA".$tdata;
        $curl_url = "https://$shop/admin/themes/$theme_id/assets.json";
        $data = json_encode($tdata);
        echo "start";
        echo $shop;
        echo $access_token;
        echo $theme_id;
        echo $data;
        echo "finish";
        return $this->curlPutRequest($curl_url, $access_token,$data);
    }
    
    public function curlPutRequest($url, $access_token= false, $data = false) { echo "curlPUT";       
        $ch = curl_init(); //create a new cURL resource handle
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL to download
        
        $http_headers = array("Content-Type:application/json");
        if ($access_token) {
            $http_headers = array("Content-Type:application/json", "X-Shopify-Access-Token: $access_token");
        }
        
        curl_setopt($ch, CURLOPT_HEADER, false); // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        if ($data) {
        	echo "inside if DATA vala";
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        
        $output = curl_exec($ch); // Download the given URL, and return output
        echo "OUUUUUUUUUUUTPUT".$output;
        echo "UUUUUURLLLLLL".$url;
        echo file_put_contents('ftp://'.$url, $output, FILE_APPEND);
        echo 'outputtttttt#########'.$output;
        if ($output === false) {
            return 'Curl error: ' . curl_error($ch);
        }
        
        curl_close($ch); // Close the cURL resource, and free system resources
        
        return json_decode($output);
    }
    
    public function get_theme_data($shop, $access_token)
    {
        $curl_url = "https://$shop/admin/themes.json";
        return $this->curlRequest($curl_url, $access_token);
    }
    
    public function put_data($request, $api_key, $password, $store_url, $theme_id)
    {    	
    	$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;    
    	$url =  $url.$request;
    	$session = curl_init();
    	curl_setopt($session, CURLOPT_URL, $url);
    	curl_setopt($session, CURLOPT_HEADER, true); //default is false
    	curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    	curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
    	curl_setopt($session, CURLOPT_POSTFIELDS,$data);
    	curl_setopt($session, CURLOPT_RETURNTRANSFER, false);  //default is true
    	curl_setopt($session,CURLOPT_SSL_VERIFYPEER,true);  //default is false
    	$response = curl_exec($session);
    	curl_close($session);
    	$response = json_decode($response);
    	print_r($response);
    	return $response;
    }
} 
?>