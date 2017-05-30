<?php
echo " in shopify";
class Shopify {
    
    protected $_APP_KEY;
    protected $_APP_SECRET;

    public function __construct()
    {
        $this->initializeKeys();
    }

    protected function initializeKeys()
    {
        $this->_APP_KEY = SHOPIFY_API_KEY;
//        echo 'api key============'.$this->_APP_KEY;
        $this->_APP_SECRET = SHOPIFY_API_SECRET;
    }
    
    function exchangeTempTokenForPermanentToken($shopifyUrl , $TempCode){
    	echo "XXXXXXXXXXXXX";
    	// encode the data
    	$data = json_encode(array("client_id"=>$this->_APP_KEY , "client_secret"=>$this->_APP_SECRET , "code"=>$TempCode));
    	echo 'insisde xchange'.$data;
    	//the curl url
    	$curl_uri = "https://$shopifyUrl/admin/oauth/access_token";
    	echo 'curlURI'.$curl_uri;
    	// set curl option
    	
    	$ch = curl_init();
    	curl_setopt($ch,CURLOPT_URL , $curl_uri);
    	curl_setopt($ch,CURLOPT_HEADER , false);
    	curl_setopt($ch,CURLOPT_HTTPHEADER , array("Content-Type:application/json"));
    	curl_setopt($ch,CURLOPT_POSTFIELDS , $data);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER , 1);
    	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER , false);
    	
    	// execute curl
    	$response = json_decode(curl_exec($ch));
    	
    	// close curl
    	curl_close($ch);
    	
    	return $response;
    }
    
    public function getAuthUrl($shop)
    {
    	echo 'inside getAuth';
        $scopes = ["read_products", "read_orders"];
        return 'https://' . $shop . '/admin/oauth/authorize?'
                . 'scope=' . implode("%2C", $scopes)
                . '&client_id=' . SHOPIFY_API_KEY
                . '&redirect_uri=' . CALLBACK_URL;
    }   
    
    /*
     * Products API related methods
     */
    public function get_products($shop, $access_token)
    {
    	echo 'inside get_prod > shop'.$shop."\n".'access token))'.$access_token;
        // the curl url
        $curl_url = "https://$shop/admin/products.json";

        return $this->curlRequest($curl_url, $access_token);
    }
    
    public function add_product($shop, $access_token, $data)
    {
        $curl_url = "https://$shop/admin/products.json";
        
        return $this->curlRequest($curl_url, $access_token, $data);
    }
    
    public function update_product($shop, $access_token, $product_id)
    {
        $curl_url = "https://$shop/admin/products/$product_id.json";
    }
    
    
    public function get_order_info_by_id($shop, $access_token, $order_id)
    {
        $curl_url = "https://$shop/admin/orders/$order_id.json?fields=id,name,total_price";

        return $this->curlRequest($curl_url, $access_token);
    }
    
    public function get_orders($shop, $access_token)
    {
        $curl_url = "https://$shop/admin/orders.json";
        
        return $this->curlRequest($curl_url, $access_token);
    }
    
    private function curlRequest($url, $access_token = NULL, $data = NULL)
    {
        // set curl options
        echo $url;
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

        //if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //}

        $output = curl_exec($ch); // Download the given URL, and return output

        if ($output === false) {
            return 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch); // Close the cURL resource, and free system resources
print_r($output);
        return json_decode($output);

    }

}
