<?php

echo "prashant";
// Update these variables with the correct values from a new *Private* app in Shopify
$api_key = '731148aba4b8f20f0d72c25e0a884f8b';
$password = 'd2e065e22c0a2436c47ef27d7996a99f';
$store_url = 'newtest-18.myshopify.com';
$theme_id = '143487233';
	// get_data retrives data with the API
	function get_data($request, $api_key, $password, $store_url, $theme_id)
	{
		echo "getData";
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
	function put_data($request, $data, $api_key, $password, $store_url, $theme_id)
	{
		echo "putData";
		$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
		$url =  $url.$request;
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
		return $response;
	}
	// returns the timestamp of the last sync
	function get_last_sync($api_key, $password, $store_url, $theme_id)
	{
		echo "get_Last_Sync";
		$response = get_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=assets/last_sync.html&theme_id='.$theme_id, $api_key, $password, $store_url, $theme_id);
		return $response->asset->value;
	}
	// writes new timestamp to the last sync file (on shopify)
	function update_last_sync($last_sync, $api_key, $password, $store_url, $theme_id)
	{
		echo "updateLAstSync";
		$data['asset']['key'] = 'assets/last_sync.html';
		$data['asset']['value'] = $last_sync;
		$data = json_encode($data);
		$response = put_data('/admin/themes/'.$theme_id.'/assets.json', $data, $api_key, $password, $store_url, $theme_id);
		echo $response;
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
    // using a temp file we created using get_file, write the file to the local file structure
    function write_file($text, $new_filename){
    	echo "write_file";
        $fp = fopen($new_filename, 'w+');
        fwrite($fp, $text);
        fclose($fp);
    }
    // get the timestamp of the last sync so we can compare with the files being pulled
	$last_sync = get_last_sync($api_key, $password, $store_url, $theme_id);
	//override for testing:
	//$last_sync = '2016-09-21T09:25:26-05:00';
	$new_last_updated_at = 0;
	// run a query to pull each asset in the theme
	$assets = get_data('/admin/themes/'.$theme_id.'/assets.json', $api_key, $password, $store_url, $theme_id);
	$updated_assets = [];
	// iterate through the assets
	foreach ($assets->assets as $key => $asset)
	{
		// check to see if the updated date on shopify is greater than the last sync date
		$updated_at = $asset->updated_at;
		if ($updated_at > $last_sync)
		{
			if ($updated_at > $new_last_updated_at)
			{
				$new_last_updated_at = $updated_at;
			}
			$file_name = $asset->key;
			// is this an image asset or a template/snippet/config/layout file (the latter file types do not have public urls!)
			if ($asset->public_url!==null)
			{
				// yes, this is an image, download it and save it
			    $temp_file_contents = get_file($asset->public_url);
			    write_file($temp_file_contents,$file_name);
			}
			else
			{
				// this is a text file of some sort. since it doesn't have a public url, we can't cURL it so the solution is to get the updated value of the file and overwrite the file in the local file structure
				$response = get_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]='.$file_name.'&theme_id='.$theme_id, $api_key, $password, $store_url, $theme_id);
				file_put_contents($file_name, $response->asset->value);		    	
			}
			// save the asset data we just retrieved to report on it below
		    $updated_assets[] = $asset;
		}
	}
	// finally, update the timestamp with the newest timestamp retrieved in the assets array
	update_last_sync($new_last_updated_at, $api_key, $password, $store_url, $theme_id);
	// deets
	echo '<h3>The following files were updated:</h3>';
	echo '<pre>';
	print_r($updated_assets);
	echo '</pre>';
?>