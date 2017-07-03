<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
$variant1 = $_POST["variant1"];
$variant2 = $_POST["variant2"];
$variant3 = $_POST["variant3"];



$shop='mathurs-storezz.myshopify.com';
$shp=explode('.', $shop);

$sql4 = "select * from "."`".$shp[0]."` where `Option1 Value` like ".$variant1;
echo "sql>>".$sql4."<br>";
$res4=mysqli_query($this->connection,$sql4);

while($result = mysqli_fetch_assoc($res4))
{
	echo "sku>>".$result["Variant SKU"];
}

?>		