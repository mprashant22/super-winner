<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class SelectQuery extends DB_Connection
{
	function __construct(){
		$this->connection = $this->connect();
	}
	
	public function ajaxResponse()
	{
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
// 			echo $shp[0];
		 	$sql4 = "select `Variant SKU`, `Variant Inventory Qty`,`Variant Price` from "."`".$shp[0]."` where `handle` LIKE '".$handle."' AND `Option1 Value` LIKE '".$v1."' AND  `Option2 Value` LIKE '".$v2."' AND  `Option3 Value` LIKE '".$v3."'";
 		 	//echo "sql>>".$sql4."<br>";
		 	$res4=mysqli_query($this->connection,$sql4);
// 		 	echo $res4;
		 	
		 	while($result = mysqli_fetch_assoc($res4)) {
		 		?>
		 		<ul>
		 		<li id="ajax_sku"><?php echo $result['Variant SKU'];?></li>
		 		<li id="ajax_unit"><?php echo $result['Variant Inventory Qty'];?></li>
		 		<li id="ajax_price"><?php echo $result['Variant Price'];?></li>
		 		</ul>
		 	<?php 	 
		 	}
		 	
	}
	}
}

$obj = new SelectQuery();
$obj->ajaxResponse();

?>