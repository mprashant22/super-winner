<link href="../templates/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../templates/bootstrap.min.css"  rel="stylesheet" type="text/css">

<table border=1>
  <tr>
    <th>Handle</th>
    <th>Title</th>
    <th>Variant1</th>
    <th>Variant2</th>
    <th>Variant3</th>
    <th>Variant~SKU</th>
    <th>Units</th>
    <th>Price</th>
   </tr>
   <tr>
    <td>Handle</td>
    <td>Title</td>
    <td><select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select></td>
    <td><select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select></td>
    <td><select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select></td>
	<td>Variant~SKU</td>
    <td>Units</td>
    <td>Price</td>
   </tr>
    
   
</table>



<?php

echo 'in inventory';
//require '../includes/db/db_connection.php';
require '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
class Export_Sync extends DB_Connection{
	
	private $table_name = "products";
	protected $connection=null;
	public function __construct()
	{
echo 'inventory connect';
		$connection= $this->connect();
echo "connect>>".$connection; 
	}
function exportExc2MySQL()
	{
		echo 'csv2mysql';
		$connection= $this->connect();
		$cmd="cat /var/www/html/shopifyDemoLamp/temp.txt 2>&1";
		echo shell_exec($cmd);
		
	
// 		if(isset($_POST['submit']))
// 		{ 
			//echo 'y';
			//$fname = $_FILES["file"]["name"];
			//echo "file>>".$fname;
			//chmod($filename, 0777);
			//$chk_ext = explode(".",$fname);
			//print_r($chk_ext);  
		//	if(strtolower($chk_ext[1]) == "csv")
		//	{		
		$filename = "/var/www/html/shopifyDemoLamp/products_export4.csv";
				echo 'file name>>'.$filename;
				//chmod($filename, 0777);
				$handle = fopen($filename, "r");	
				$data = fgetcsv($handle);
				while(! feof($handle))
				{
					if(feof($handle))
					{
						break;
					}
					print_r(fgetcsv($handle));
					$data = fgetcsv($handle);
					echo "<pre>prashant</pre>";

					$values=[];
					$values=$data;


					for ($i=0;$i<count($data);$i++)
					{
						echo $data[$i]."/";
						$data1=mysqli_escape_string($connection, $data[$i]);
						$db.="'".$data1."',";
					}
				
					echo '<pre style="color:#FF0000">'.$db."</pre>";
					$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
					//echo $sql;
					$db="";
					mysqli_query($connection,$sql) or die(mysqli_error($connection));
					
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

	$Inv = new Export_Sync();
 	$Inv->exportExc2MySQL();
?>

<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">

Import File : <input type="hidden" name="file" value="/root/products_export.csv">
<input type="submit" name="submit" value="submit">

</form>