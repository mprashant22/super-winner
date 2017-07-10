<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class DeleteQuery extends DB_Connection
{
	function __construct(){
		$this->connection = $this->connect();
	}
	
	public function ajaxResponse()
	{
		
		$shop='mathurs-storezz.myshopify.com';
		$shp=explode('.', $shop);
		echo $shp[0];
		// Test if our data came through
		if (isset($_POST["points"])) {
		echo "isset";	
			$handle=[];
			$handle=$_POST["points"];
			echo $handle;
			echo count($handle);
			foreach($value as $handle)
  			{
  				echo $value."<br>";
			
//   				$sql4 = "delete from "."`".$shp[0]."` where `handle` LIKE '".$value."'";
//   			echo "sql>>".$sql4."<br>";
//    			$res4=mysqli_query($this->connection,$sql4);
//  		 	echo $res4;
  			}
					 	
		}
	}
}

$obj = new DeleteQuery();
$obj->ajaxResponse();

?>