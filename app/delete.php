<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class DeleteQuery extends DB_Connection
{
	function __construct(){
		$this->connection = $this->connect();
	}
	
	public function ajaxResponse()
	{
		
		$shop='mathurs-store.myshopify.com';
		$shp=explode('.', $shop);
		
		// Test if our data came through
		if (isset($_POST["points"])) {
			
			$arr=[];
			$handle=$_POST["points"];
			echo $handle;
			//$arr=explode(",",$handle);
			echo var_dump($handle);
			print_r($handle);
			foreach($handle as $value)
  			{
  				echo $value."//";
			
   				$sql4 = "delete from "."`".$shp[0]."` where `handle` LIKE '".$value."'";
   			echo "sql>>".$sql4;
    			$res4=mysqli_query($this->connection,$sql4);
    			
//  		 	echo $res4;
  			}
					 	
		}
		else 
		{
			if (isset($_POST["one_Handle"]))
			{
				$handle=$_POST["one_Handle"];
				$sql4 = "delete from "."`".$shp[0]."` where `handle` LIKE '".$value."'";
				echo "sql>>".$sql4;
				$res4=mysqli_query($this->connection,$sql4);
			}
		}
	}
}

$obj = new DeleteQuery();
$obj->ajaxResponse();

?>