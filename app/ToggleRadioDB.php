<?php

require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
require __DIR__. '../../includes/utils/Shopify.php';
require __DIR__. '../../includes/db/Stores.php';
$Shopify = new Shopify();
$Stores = new Stores();
$shop = $_REQUEST['shop'];
$shop_info = $Stores->is_shop_exists($shop);
class SocialLoginSelect extends DB_Connection
{    
    private $table_name = "socialLogin";
    public $connection = '';
    function __construct(){
        $this->connection = $this->connect();
    }
    
    public function insertToggleValue()
    {
    	$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
    	
    	
    	//$sql = "INSERT into `".$table_name."`(storeName, optionGoogle, `optionFacebook`,`optionTwitter`, `optionInstagram`, `optionTumblr`) values".rtrim($bulk,",");
    	
    	//mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));	
    	//$shop = $_REQUEST['shop'];
    	//echo "dukaan".$shop;
		//echo $sql.">>".
    	print_r($shop_info);
    }
}
$obj=new SocialLoginSelect();
$obj->insertToggleValue();

?>