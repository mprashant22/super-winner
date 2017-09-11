<?php

require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
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
		
		
		
		
    	
    	$sql = "INSERT into '".$this->$table_name."'(storeName, optionGoogle, `optionFacebook`,`optionTwitter`, `optionInstagram`, `optionTumblr`) values('".
      	
      	
    	$request[0]."',".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].")";
    	echo $sql;
//mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
    	//$shop = $_REQUEST['shop'];
    	//echo "dukaan".$shop;
		//echo $sql.">>".
  //  	print_r($request);
    }
}
$obj=new SocialLoginSelect();
$obj->insertToggleValue();

?>