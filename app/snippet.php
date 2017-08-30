<?php
include __DIR__ .'../../includes/utils/Shopify.php';
include __DIR__ .'../../includes/db/Stores.php';
$Shopify = new Shopify();
$Stores = new Stores();
$shop = $_GET['shop'];
$shop_info = $Stores->is_shop_exists($shop);
$get_theme = $Shopify->get_theme_data($shop, $shop_info['access_token']);
$theme_id = $get_theme->themes[0]->id;
$get_theme_data = $Shopify->get_themes($shop, $shop_info['access_token'],$theme_id);
//echo "<pre>";
//print_r($get_theme_data);
$get_collections =  $Shopify->get_collections($shop, $shop_info['access_token'],$theme_id);
//print_r($get_collections);
$theme_data = array("asset"=>array("key"=>"snippets/prod-text-snippet.liquid","value"=>"<p>We busy updating the store for you and will be back within the hour.<\/p>"));
//$create_theme = $Shopify->create_theme_data($shop, $shop_info['access_token'],$theme_id,$theme_data);
//print_r($create_theme);
if(isset($_POST['submit'])){
	$ch = $_POST['selected_checkbox'];
	$col_text = "{% for collection in product.collections %}";
	foreach ($ch as $key => $your_slected_id){
	$text = $_POST['collection_handle'.$your_slected_id];
	$pt = $_POST['prod_text'.$your_slected_id];
	$col_text .= "{% if collection.handle == '$text' %}$pt{% endif %}";
	}
	$col_text .="{% endfor %}";
	//echo $col_text;

	$theme_data = array("asset"=>array("key"=>"snippets/prod-text-snippet.liquid","value"=>$col_text));
	$create_theme = $Shopify->create_theme_data($shop, $shop_info['access_token'],$theme_id,$theme_data);
    print_r($theme_data);
}
?>
<form method="post">
<?php $i=0; foreach($get_collections->custom_collections as $collection){ ; ?>
<input type="checkbox" name="selected_checkbox[]" value="<?php echo $i?>" checked />
<input type="text" name="collection_handle<?php echo $i?>" value="<?php echo $collection->handle; ?>" readonly >
<input type="text" name="prod_text<?php echo $i; ?>" />
<?php $i++; } ?>
</select>

<input type="submit" value="Save" name="submit" />
</form>