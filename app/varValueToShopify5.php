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
$theme_id = '143487233';

	function get_data($request, $api_key, $password, $store_url, $theme_id)
	{
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
		print_r($response);
		return $response;
	}

	function put_data($request, $data, $api_key, $password, $store_url, $theme_id)
	{
		$url = 'https://' . $api_key . ':' . $password . '@' . $store_url;
		echo $url;
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
		print_r($response);
		return $response;
	}

	function get_last_sync($api_key, $password, $store_url, $theme_id)
	{
		$response = get_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=snippets/new_file2.liquid&theme_id='.$theme_id, $api_key, $password, $store_url, $theme_id);
		return $response->asset->value;
	}

	function update_last_sync($last_sync, $api_key, $password, $store_url, $theme_id)
	{
		$text=$_POST['snippetText'];
		echo $text." blabla";
		$data['asset']['key'] = 'snippets/new_file2.liquid';
		$data['asset']['value'] = $text;

		$data = json_encode($data);
		print_r($data);
		if(isset($_POST['submit']))
		{
			echo "response";
			$text=$_POST['snippetText'];		
			$response = put_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=snippets/new_file2.liquid&theme_id='.$theme_id.'&asset[value]='.'NARENDRA#321MODI', $data, $api_key, $password, $store_url, $theme_id);
			
		}
		print_r($response);
	}
	
    function get_file($url){
    	
    	echo "getFiles";
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
    	echo "write_file";
        $fp = fopen($new_filename, 'w+');
      //  fwrite($fp, $text);
        fclose($fp);
    }
    
	$last_sync = get_last_sync($api_key, $password, $store_url, $theme_id);
	$new_last_updated_at = 0;
	
	$assets = get_data('/admin/themes/'.$theme_id.'/assets.json?asset[key]=snippets/new_file2.liquid&theme_id='.$theme_id, $api_key, $password, $store_url, $theme_id);
	$updated_assets = [];
	print_r($assets);
	
	
	
	update_last_sync($new_last_updated_at, $api_key, $password, $store_url, $theme_id);
	
?>