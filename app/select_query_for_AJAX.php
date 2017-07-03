<?php

//echo "select query for ajax";
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class SelectQuery extends DB_Connection{
	 
	function __construct(){
		$this->connection = $this->connect();
	}
	
	
	public $connection = '';
	public function storeDisplay()
	{
		$shop='mathurs-storezz.myshopify.com';
		$shp=explode('.', $shop);

		$sql4 = "select distinct(handle) from "."`".$shp[0]."` group by handle";
	//	echo "sql>>".$sql4."<br>";
		$res4=mysqli_query($this->connection,$sql4);
	
			 while($result = mysqli_fetch_assoc($res4)) {
 
			 	$sql1 = "select distinct(`Option1 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option1 Value` ASC";
			 	$res1 = mysqli_query($this->connection,$sql1);
			 	while ($query_data1 = mysqli_fetch_assoc($res1)) {
			 		echo $query_data1["Option1 Value"]."//";
				}
			 }
	}
}

$obj=new SelectQuery();
$obj->storeDisplay();
?>		