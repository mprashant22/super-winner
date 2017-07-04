<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

// Test if our data came through
if (isset($_POST["points"])) {
	// Decode our JSON into PHP objects we can use
	$points = json_decode($_POST["points"]);
	// Access our object's data and array values.
	//echo "Data is: " . $points->data . "<br>";
	$handle = $points->arPoints[0]->x ;
	
	$v1 = $points->arPoints[0]->y;

	$v2 = $points->arPoints[0]->z;

	$v3 = $points->arPoints[0]->p;
	
	$shop='mathurs-storezz.myshopify.com';
	$shp=explode('.', $shop);
	
	$sql4 = "select `Variant SKU`, `Variant Inventory Qty`,`Variant Price` from "."`".$shp[0]."` where `handle` LIKE '".$handle."' AND `Option1 Value` LIKE '".$v1."' AND  `Option2 Value` LIKE '".$v2."' AND  `Option3 Value` LIKE '".$v3."'";
	echo "sql>>".$sql4."<br>";
	$res4=mysqli_query($this->connection,$sql4);
}


?>