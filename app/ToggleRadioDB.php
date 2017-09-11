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
    	//echo 'prashant';
    	$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		
		
		print_r($request);
		echo $request[0].$request[1].$request[2].$request[3].$request[4].$request[5];
    	
    	//$sql = "INSERT into '".$this->$table_name."'(storeName, optionGoogle, `optionFacebook`,`optionTwitter`, `optionInstagram`, `optionTumblr`) values('".
      	
      	
    	//$request[0]."',".$request[1].",".$request[2].",".$request[3].",".$request[4].",".$request[5].")";
    	//echo $sql;
//mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
    	//$shop = $_REQUEST['shop'];
    	//echo "dukaan".$shop;
		//echo $sql.">>".
  //  	
    }
}
$obj=new SocialLoginSelect();
$obj->insertToggleValue();

?>