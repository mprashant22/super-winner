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

	function update_last_sync($last_sync, $api_key, $password, $store_url, $theme_id)
	{
		echo "UPDATE KARO`";
		echo '<pre>';
		echo var_dump($last_sync);
		echo '</pre>';	
		
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
			$text.='<div>{% include'. '/'.'fb_login_snippet.'/' %}</div>';
			$response = put_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=templates/customers/login2.liquid&theme_id='.$theme_id.'&asset[value]='.$text, $data, $api_key, $password, $store_url, $theme_id);
		}
		print_r($response);
	}

	$assets = get_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=templates/customers/login2.liquid&theme_id='.$theme_id, $api_key, $password, $store_url, $theme_id);
	update_last_sync($assets, $api_key, $password, $store_url, $theme_id);	
	echo '<pre>';
	print_r($assets);
	echo '</pre>';
?>