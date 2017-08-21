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
	function get_last_sync($api_key, $password, $store_url, $collection_id)
	{
		$response = get_data('/admin/collects.json?collection_id='.$collection_id, $api_key, $password, $store_url);		
		return $response->collects->value;
	}
	// writes new timestamp to the last sync file (on shopify)
	function update_last_sync($last_sync, $api_key, $password, $store_url, $collection_id)
	{		
		$data['collect']['key'] = 'snippets/new_file4.liquid';
		$data['collect']['value'] = "something123";
		$data = json_encode($data);
		if(isset($_POST['submit']))
		{		
			$text=$_POST['snippetText'];		
			$response = put_data('/admin/themes/'.$collection_id.'/collects.json?collect[key]=snippets/new_file4.liquid&theme_id='.$collection_id.'&collect[value]='.$text, $data, $api_key, $password, $store_url, $collection_id);
		}
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
	//override for testing:
	//$last_sync = '2016-09-21T09:25:26-05:00';
	$new_last_updated_at = 0;
	// run a query to pull each collect in the theme
	$collects = get_data('/admin/collects.json?collection_id='.$collection_id, $api_key, $password, $store_url);
	$updated_collects = [];
	echo $collects['position'];
	// iterate through the collects
	foreach ($collects->collects as $key => $collect)
	{
		echo '<pre style="color:RED">'.'PRASHANT'.'</pre>';
		// check to see if the updated date on shopify is greater than the last sync date
		$updated_at = $collect->updated_at;
		if ($updated_at > $last_sync)
		{
			if ($updated_at > $new_last_updated_at)
			{
				$new_last_updated_at = $updated_at;
			}
			$file_name = $collect->key;
			// is this an image collect or a template/snippet/config/layout file (the latter file types do not have public urls!)
			if ($collect->public_url!==null)
			{				
				// yes, this is an image, download it and save it
			    $temp_file_contents = get_file($collect->public_url);
			    write_file($temp_file_contents,$file_name);
			}
			else
			{
				// this is a text file of some sort. since it doesn't have a public url, we can't cURL it so the solution is to get the updated value of the file and overwrite the file in the local file structure
				$response = get_data('/admin/collects.json?collection_id='.$collection_i, $api_key, $password, $store_url);				
				file_put_contents($file_name, $response->collect->value);		    	
			}
			// save the collect data we just retrieved to report on it below
		    $updated_collects[] = $collect;
		}
	}
	// finally, update the timestamp with the newest timestamp retrieved in the collects array
	update_last_sync($new_last_updated_at, $api_key, $password, $store_url, $collection_id);
	// deets

?>