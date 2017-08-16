<?php
echo "prashant";
// Update these variables with the correct values from a new *Private* app in Shopify
$api_key = '731148aba4b8f20f0d72c25e0a884f8b';
$password = 'd2e065e22c0a2436c47ef27d7996a99f';
$store_url = 'newtest-18.myshopify.com';
$theme_id = '143487233';
// get_data retrives data with the API
// function get_data($request, $api_key, $password, $store_url, $theme_id)
// {
// 	$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
// 	$url =  $url.$request;
// 	$session = curl_init();
// 	curl_setopt($session, CURLOPT_URL, $url);
// 	curl_setopt($session, CURLOPT_HTTPGET, 1);
// 	curl_setopt($session, CURLOPT_HEADER, false);
// 	curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
// 	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
// 	curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);
// 	$response = curl_exec($session);
// 	curl_close($session);
// 	$response = json_decode($response);
// 	return $response;
// }
// put data updates or uploads data with the API
function put_data($request, $data, $api_key, $password, $store_url, $theme_id)
{
	echo "put data";
	$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
	echo $url;
	$url =  $url.$request;
	echo $url;
	$session = curl_init();
	echo "session>>>>".$session;
	curl_setopt($session, CURLOPT_URL, $url);
	curl_setopt($session, CURLOPT_HEADER, false);
	curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($session, CURLOPT_POSTFIELDS,$data);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);
	$response = json_decode(curl_exec($session));
	echo "<<<<>>>>".$response;
	curl_close($session);
	
	return $response;
}

 	$data = "madhavmahesh";
 	echo $data;
 	$response = put_data('/admin/themes/'.$theme_id.'/assets.json', $data, $api_key, $password, $store_url, $theme_id);
 	echo "after put_Data".$response;

function get_file($url){
	echo("inside get");
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

function write_file($text, $new_filename){
	echo "inside write";
	$fp = fopen($new_filename, 'w+');
	fwrite($fp, $text);
	fclose($fp);
}

 
$new_last_updated_at = 0;

$updated_assets = [];

foreach ($assets->assets as $key => $asset)
{
	
	$updated_at = $asset->updated_at;
	if ($updated_at > $last_sync)
	{
		if ($updated_at > $new_last_updated_at)
		{
			$new_last_updated_at = $updated_at;
		}
		$file_name = $asset->key;
		echo "filename>>>>>>>>>>>>>>>".$file_name;
		
		
		if ($asset->public_url!==null)
		{
		
			$temp_file_contents = "prashant mathur";
			write_file($temp_file_contents,$file_name);
		}
		else
		{
			
			$response = get_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]='.$file_name.'&theme_id='.$theme_id, $api_key, $password, $store_url, $theme_id);
			file_put_contents($file_name, $response->asset->value);
		}
		
		$updated_assets[] = $asset;
	}
}

echo '<h3>The following files were updated:</h3>';
echo '<pre>';
print_r($updated_assets);
echo '</pre>';
?>