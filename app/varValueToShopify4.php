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
	function put_data($request, $data, $api_key, $password, $store_url, $collection_id)
	{
		echo "request>>".$request;
		print_r($data);
		echo "*********";
		$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
		$url =  $url.$request;
		$session = curl_init();
		$x=curl_setopt($session, CURLOPT_URL, $url);
		echo "x===".$x;
		$x=curl_setopt($session, CURLOPT_HEADER, false);
		echo "x===".$x;
		$x=curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		echo "x===".$x;
        $x=curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
        echo "x===".$x;
        $x=curl_setopt($session, CURLOPT_POSTFIELDS,$data);
        echo "x===".$x;
		$x=curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		echo "x===".$x;
		curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);
		echo "x===".$x;
		$response = curl_exec($session);
		echo "@#@#@@#@";
		echo $response;
		if($response===false)
		{
			return 'Curl error'.curl_error($session);
		}
		curl_close($session);
		$response = json_decode($response);
		echo "^^^^^^";
		print_r($response);
		return $response;
	}
	// returns the timestamp of the last sync
	function get_last_sync($api_key, $password, $store_url, $collection_id)
	{
		$response = get_data('/admin/collects.json?collection_id='.$collection_id, $api_key, $password, $store_url);		
		return $response->collects->value;
	}
	// writes new timestamp to the last sync file (on shopify)
	function update_last_sync($collects, $api_key, $password, $store_url, $collection_id)
	{
		$collects = json_encode($collects);
		print_r($collects);
		$response = put_data('/admin/collects.json?collection_id='.$collection_id, $collects, $updated_at, $api_key, $password, $store_url);		
	}
	// download a file from the shopify server. this only works for images!
    function get_file($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return($result);
    }
    // using a temp file we created using get_file, write the file to the local file structure
    function write_file($text, $new_filename){
        $fp = fopen($new_filename, 'w+');
        fwrite($fp, $text);
        fclose($fp);
    }
    // get the timestamp of the last sync so we can compare with the files being pulled
	$last_sync = get_last_sync($api_key, $password, $store_url, $collection_id);

	$collects = get_data('/admin/collects.json?collection_id='.$collection_id, $api_key, $password, $store_url);
	var_dump($collects);
	$updated_collects = [];
	// iterate through the collects
	foreach ($collects->collects as $key => $collect)
	{
		echo '<pre style="color:RED">'.'PRASHANT'.'</pre>';
		$updated_at = $collect->position;
		//$updated_at = $collect->position;
		 //$x=$collect->key;
		if( $collect->position==1){
			$collect->position=2;
		}
		else if ( $collect->position==2){
			$collect->position=3;
		}
		else{
			$collect->position=1;
		}
		echo  $collect->position;
		//$response = get_data('/admin/collects.json?collection_id='.$collection_id, $api_key, $password, $store_url);			
	}
	// finally, update the timestamp with the newest timestamp retrieved in the collects array
	update_last_sync($collects, $api_key, $password, $store_url, $collection_id);
?>