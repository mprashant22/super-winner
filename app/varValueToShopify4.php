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

	// get_data retrives data with the API
	function get_data($request, $api_key, $password, $store_url, $collection_id)
	{		
		$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
		$url =  $url.$request;
		$session = curl_init();
		curl_setopt($session, CURLOPT_URL, $url);
		curl_setopt($session, CURLOPT_HTTPGET, 1);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);
		$response = curl_exec($session);
		curl_close($session);
		$response = json_decode($response);
		return $response;
	}
	// put data updates or uploads data with the API
	function curlPutRequest($store_url, $password, $data = false) {
		$ch = curl_init(); //create a new cURL resource handle
		curl_setopt($ch, CURLOPT_URL, $store_url); // Set URL to download
		
		$http_headers = array("Content-Type:application/json");
		if ($password) {
			$http_headers = array("Content-Type:application/json", "X-Shopify-Access-Token: $password");
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
	
	function updatecollect($store_url, $password) {
		
		$curl_url = "https://$store_url/admin/smart_collections/345548033/order.json";
		echo $curl_url;
		//$order = array()
		//$data = json_encode($order);
		
		return $this->curlPutRequest($curl_url, $password);
	}
?>