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
		$columns = array(
			0 =>'employee_name',
			1 => 'employee_salary',
			2 => 'employee_age'
		);
		$error = true;
		$colVal = '';
		$colIndex = $rowId = 0;

		$msg = array('status' => !$error, 'msg' => 'Failed! updation in mysql');

		if(isset($_POST)){
			if(isset($_POST['val']) && !empty($_POST['val']) && $error) {
			$colVal = $_POST['val'];
			$error = false;
		
		} else {
			$error = true;
		}
		if(isset($_POST['index']) && $_POST['index'] >= 0 &&  $error) {
			$colIndex = $_POST['index'];
			$error = false;
		} else {
			$error = true;
		}
		if(isset($_POST['id']) && $_POST['id'] > 0 && $error) {
			$rowId = $_POST['id'];
			$error = false;
		} else {
			$error = true;
		}
	
		if(!$error) {
			$sql = "UPDATE `".shp[0]."` SET ".$columns[$colIndex]." = '".$colVal."' WHERE id='".$rowId."'";
			$status = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
			$msg = array('status' => !$error, 'msg' => 'Success! updation in mysql');
		}
	}
	// send data as json format
	echo json_encode($msg);
	}
}

	$obj = new UpdateQuery();
	$obj->ajaxResponse();

?>