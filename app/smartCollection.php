<form action='' method='post' enctype="multipart/form-data">
<input type="text" id="browse" name="snippetText"/>
<input type="submit" name="submit">
</form>

<?php

echo $text."MATHUR";
// Update these variables with the correct values from a new *Private* app in Shopify
$api_key = '731148aba4b8f20f0d72c25e0a884f8b';
$password = '00f7d6f7ad1d8649bd7bc855d2caff6e';
$store_url = 'newtest-18.myshopify.com';

$collection_id='345548033';

	function getAuthUrl($shop)
	{	
		$shp=explode('.', $shop);
		$scopes = ["read_products", "read_orders","write_orders","write_products","read_smart_collections", "write_smart_collections"];
		
		return 'https://' . $shop . '/admin/oauth/authorize?'
				. 'scope=' . implode("%2C", $scopes)
				. '&client_id=' . $api_key
				. '&redirect_uri=' . CALLBACK_URL;
	}

	function curlPutRequest($url,$password,$api_key,$access_token= false) {
		
		echo "curlPut";
		//$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
		//echo $url;
		$url =  $url.$request;
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
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		
		$output = curl_exec($ch); // Download the given URL, and return output
		
		if ($output === false) {
			return 'Curl error: ' . curl_error($ch);
		}
		
		curl_close($ch); // Close the cURL resource, and free system resources
		
		return json_decode($output);
	}
	
	function updateSmartCollections($shop, $access_token,$cdata)
	{
		$curl_url = "https://$shop/admin/smart_collections/order.json?collection_id=345548033";		
		return $this->curlPutRequest($curl_url, $access_token,$data);
	}
	
		
?>