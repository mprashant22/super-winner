<?php
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';


class exportProduct extends DB_Connection{
	
	function __construct(){
		$this->connection = $this->connect();
	}
	private $table_name = "products";
	public $connection = '';
	public function syncc()
	{
if(isset($_POST['SYNC']))
{
$filename = "/var/www/html/shopifyDemoLamp/uploads/products_export4.csv";
echo "((((((())))))))))".$filename;
$handle = fopen($filename, "r");
print_r($handle);

$data_csv = fgetcsv($handle);
print_r($data_csv);
while(! feof($handle))
{
	if(feof($handle))
	{
		break;
	}
	//print_r(fgetcsv($handle));
	echo 'mm';
	$data_csv = fgetcsv($handle);
	print_r($data_csv);
	echo 'nn';
	
	$values_csv=[];
	$values_csv=$data_csv;
	echo "<pre>".print_r($values_csv)."</pre>";
	
	for ($i=0;$i<count($data);$i++)
	{
		echo "loop mei";
		$data1=mysqli_escape_string($connection, $data[$i]);
		$db.="'".$data1."',";
	}
	
	$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
	echo 'sql---------'.$sql;
	$db="";
	mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
	
}

	fclose($handle);
	}

	}
}

$obj=new exportProduct();
$obj->syncc();

?>

<form action='' method='post' enctype="multipart/form-data">
<input type="submit" name="SYNC" value="SYNC">
</form>
