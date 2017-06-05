<link href="../templates/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../templates/bootstrap.min.css"  rel="stylesheet" type="text/css">

<!-- <table border=1> -->
<!--   <tr> -->
<!--     <th>Handle</th> -->
<!--     <th>Title</th> -->
<!--     <th>Variant1</th> -->
<!--     <th>Variant2</th> -->
<!--     <th>Variant3</th> -->
<!--     <th>Variant~SKU</th> -->
<!--     <th>Units</th> -->
<!--     <th>Price</th> -->
<!--    </tr> -->
<!--    <tr> -->
<!--     <td>Handle</td> -->
<!--     <td>Title</td> -->
<!--     <td><select> -->
<!--   <option value="volvo">Volvo</option> -->
<!--   <option value="saab">Saab</option> -->
<!--   <option value="mercedes">Mercedes</option> -->
<!--   <option value="audi">Audi</option> -->
<!-- </select></td> -->
<!--     <td><select> -->
<!--   <option value="volvo">Volvo</option> -->
<!--   <option value="saab">Saab</option> -->
<!--   <option value="mercedes">Mercedes</option> -->
<!--   <option value="audi">Audi</option> -->
<!-- </select></td> -->
<!--     <td><select> -->
<!--   <option value="volvo">Volvo</option> -->
<!--   <option value="saab">Saab</option> -->
<!--   <option value="mercedes">Mercedes</option> -->
<!--   <option value="audi">Audi</option> -->
<!-- </select></td> -->
<!-- 	<td>Variant~SKU</td> -->
<!--     <td>Units</td> -->
<!--     <td>Price</td> -->
<!--    </tr> -->
    
   
<!-- </table> -->

<?php

echo 'in inventory';
require '../includes/db/db_connection.php';
class Inventory extends DB_Connection{
	
	private $table_name = "products";
	protected $connection=null;
	public function __construct()
	{
		echo 'inventory connect';
		$connection= $this->connect();
		//echo "connect>>".$connection; 
	}
function exportExc2MySQL()
	{
		echo 'x';
		$connection= $this->connect();
		echo shell_exec("cd ..");
		echo shell_exec("pwd");
		echo '<pre>'.`whoami 2>&1`.'</pre>';
	//	echo '<pre>'.`cat /var/www/html/shopifyDemoLamp/products_export3.csv 2>&1`.'</pre>';
		echo '<pre>'.`cat temp.txt 2>&1`.'</pre>';
		if(isset($_POST['submit']))
		{ 
			//echo 'y';
			//$fname = $_FILES["file"]["name"];
			//echo "file>>".$fname;
			//chmod($filename, 0777);
			//$chk_ext = explode(".",$fname);
			print_r($chk_ext);  
		//	if(strtolower($chk_ext[1]) == "csv")
		//	{		
		$filename = "/var/www/html/shopifyDemoLamp/products_export4.csv";
				//echo 'file name>>'.$filename;
				//chmod($filename, 0777);
				$handle = fopen($filename, "r");
				$values = [];
				echo 'handle >>'.$handle;
				$row = 1;
				$data = fgetcsv($handle);
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					echo 'in while';echo "DATA">>implode(", ", $data);
					$num = count($data);
				echo $num;
					print_r($data);
					$row++;
					for ($c=0; $c < $num; $c++) {
						echo $data[$c] . "<br />\n";
					}
					echo $row;
					//echo 'implode >>'.implode(", ", '$data');
					foreach ($data as $value){
						$values[] = $value;
					}
					$query .= "VALUES(".implode(", ", "'.$values.'").")";
					echo $query;
// 					$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values(". implode(", ", $values).")";
// 					echo 'sql q>>'.$sql;
// 					mysqli_query($connection,$sql) or die(mysqli_error($connection));
				}
				
				
				fclose($handle);
				echo "Successfully Imported";
			//}
			//else
			//{
				//echo "Invalid File";
			//}
		}
	}
}	
$Inv = new Inventory();
$Inv->exportExc2MySQL();
?>

<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">

Import File : <input type="hidden" name="file" value="/root/products_export.csv">
<input type="submit" name="submit" value="submit">

</form>