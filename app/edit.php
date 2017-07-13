<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class UpdateQuery extends DB_Connection
{
	function __construct(){
		$this->connection = $this->connect();
	}
	
	public function ajaxResponse()
	{
	
		$shop='mathurs-store.myshopify.com';
		$shp=explode('.', $shop);
		//define index of column
// 		$colVal = '';
		if (isset($_POST["points"])) {
			$data=$_POST["points"];
			$tableheader = array(0=>"Variant SKU",1=>"Variant Inventory Qty",2=>"Variant Price");
			
//echo "<pre>".$data."</pre>";
//echo "dump>>".var_dump($data);
//foreach ($data as $value)
//{
 		$newVal = $data[0];
 		$handle = $data[1];
 		$colIndex = $data[2];

 //echo "newvalue".$handle;
//}
 		$sql = "UPDATE `".$shp[0]."` SET '".$tableheader[$colIndex]."' = '".$newVal."' WHERE handle='".$handle."'";
 		echo $sql;
 		$status = mysqli_query($this->connection, $sql) or die("database error:". mysqli_error($this->connection));
 		$msg = array('status' => !$error, 'msg' => 'Success! updation in mysql');
		}
	}
}
	// send data as json format
// 	echo json_encode($msg);
	$obj = new UpdateQuery();
	$obj->ajaxResponse();

?>