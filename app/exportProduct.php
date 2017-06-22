<?php
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
	
	
	for ($i=0;$i<count($data);$i++)
	{
		$data1=mysqli_escape_string($connection, $data[$i]);
		$db.="'".$data1."',";
	}
	
	$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
	$db="";
	mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
	
}

fclose($handle);
}
?>

<form action='' method='post' enctype="multipart/form-data">
<input type="submit" name="SYNC" value="SYNC">
</form>
