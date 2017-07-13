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
echo "<pre>".$data."</pre>";
//echo "dump>>".var_dump($data);
//foreach ($data as $value)
//{
 		$newVal = $data[0];
 		$handle = $data[1];
 		$colIndex = $data[2];

 echo "value".$value;
//}
// 		$sql = "UPDATE `".shp[0]."` SET ".$columns[$colIndex]." = '".$colVal."' WHERE id='".$rowId."'";
// 		$status = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
// 		$msg = array('status' => !$error, 'msg' => 'Success! updation in mysql');
		}
	}
}
	// send data as json format
// 	echo json_encode($msg);
	$obj = new UpdateQuery();
	$obj->ajaxResponse();

?>