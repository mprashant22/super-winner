<form action='' method='post' enctype="multipart/form-data">
<input type="text" id="browse" name="snippetText"/>
<input type="submit" name="submit">
</form>

<?php

$api_key = '731148aba4b8f20f0d72c25e0a884f8b';
$password = 'ccd0e7337573055c4b7328444106729d';
$store_url = 'mathurs-store.myshopify.com';
$theme_id = '164437765';

	// get_data retrives data with the API
	function get_data($request, $api_key, $password, $store_url, $theme_id)
	{
		echo "getData";
		$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
		echo $url;
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
		//echo "GET REsponse";
		//print_r($response);
		//echo "-------";
		return $response;
	}
	// put data updates or uploads data with the API
	function put_data($request, $data, $api_key, $password, $store_url, $theme_id)
	{
		echo "putData".$store_url;
		$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
		echo $url;
		$url =  $url.$request;
		//echo $url;
		$session = curl_init();
		curl_setopt($session, CURLOPT_URL, $url);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($session, CURLOPT_POSTFIELDS,$data);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);
		$response = curl_exec($session);
		curl_close($session);
		$response = json_decode($response);
		print_r($response);
		return $response;
	}
	// returns the timestamp of the last sync
	
	// writes new timestamp to the last sync file (on shopify)
	function update_last_sync($last_sync, $api_key, $password, $store_url, $theme_id)
	{
		
		echo "UPDATE KARO`";echo var_dump($last_sync);
		$data['asset']['key'] = 'templates/customers/login2.liquid';
		$data['asset']['value'] = "something123";
		//print_r($data);
		$data = json_encode($data);
		echo "blabla";
		print_r($data);
		if(isset($_POST['submit']))
		{
			echo "response";
			$text=$_POST['snippetText'];
			$text.='PRASHANT';
			$response = put_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=templates/customers/login2.liquid&theme_id='.$theme_id.'&asset[value]='.$text, $data, $api_key, $password, $store_url, $theme_id);
		}
		print_r($response);
	}
	// download a file from the shopify server. this only works for images!
    function get_file($url){
    	echo "getFile";
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

	$assets = get_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=templates/customers/login2.liquid&theme_id='.$theme_id, $api_key, $password, $store_url, $theme_id);
	$updated_assets = [];
	echo "============";	
	print_r($assets);
	echo assets['value'];
	echo "((((((((((((((((";
	
	
	// finally, update the timestamp with the newest timestamp retrieved in the assets array
	update_last_sync($assets, $api_key, $password, $store_url, $theme_id);
	// deets
	//echo '<h3>The following files were updated:</h3>';
	echo '<pre>';
	print_r($updated_assets);
	echo '</pre>';
?>