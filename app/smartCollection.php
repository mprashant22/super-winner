<form action='' method='post' enctype="multipart/form-data">
<input type="text" id="browse" name="snippetText"/>
<input type="submit" name="submit">
</form>

<?php

echo $text."MATHUR";
// Update these variables with the correct values from a new *Private* app in Shopify
$api_key = '731148aba4b8f20f0d72c25e0a884f8b';
$access_token= '00f7d6f7ad1d8649bd7bc855d2caff6e';
$store_url = 'newtest-18.myshopify.com';

$collection_id='345548033';

curlPutRequest($store_url,$api_key,$access_token);
function curlPutRequest($store_url,$api_key,$access_token) {
		
		echo "curlPut";			
		$url = 'https://' . $api_key . ':' . $access_token. '@' . $store_url.'/admin/smart_collections/order.json?collection_id=345548033';
		echo $url;
		
		$ch = curl_init(); //create a new cURL resource handle
		curl_setopt($ch, CURLOPT_URL, $url); // Set URL to download
		
		$http_headers = array("Content-Type:application/json");
		if ($access_token) {echo "PRASHANT";
			$http_headers = array("Content-Type:application/json", "X-Shopify-Access-Token: $access_token");
			print_r($http_headers);
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