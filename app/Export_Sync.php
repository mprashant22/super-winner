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

//echo 'in inventory';
//require '../includes/db/db_connection.php';
require '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
class Export_Sync extends DB_Connection{
	
	private $table_name = "products";
	protected $connection = null;
	public function __construct()
	{
//echo 'inventory connect';
		$connection= $this->connect();
//echo "connect>>".$connection; 
	}
public function exportExc2MySQL()
	{
		//echo 'csv2mysql';
		//$connection= $this->connect();
		
	
 		if(isset($_POST['EXPORT']))
 		{ 
		$filename = "/var/www/html/shopifyDemoLamp/products_export4.csv";

				$handle = fopen($filename, "r");	
				$data = fgetcsv($handle);
				while(! feof($handle))
				{
					if(feof($handle))
					{
						break;
					}
					//print_r(fgetcsv($handle));
					$data = fgetcsv($handle);

					$values=[];
					$values=$data;


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
				echo "Successfully Imported";
			}
			//else
			//{
				//echo "Invalid File";
			//}
			
			//sync();
		}
		
	public function sync()
	{
		$store='store-demo.myshopify.com';
		$table=explode(".", $store);
		echo $table[0];
		
		$sql = "create table".$table[0]."(Handle text, Title text, Variant 1 text,Variant 2 text, Variant 3 text, Variant SKU integer, Variant Inventory integer, Variant Price integer)";
		mysqli_query($connection,$sql) or die(mysqli_error($connection));		
	}
	
		
	
		
		
		
		
		
		
		
		
		
		
		
		
		
	}

	$Inv = new Export_Sync();
 	$Inv->exportExc2MySQL();
 	$Inv->sync();
?>

<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">


<input type="submit" name="EXPORT" value="EXPORT">
<input type="button" name="SYNC" value="SYNC" onclick="sync()">

</form>

<script>
function sync()
{
		
}
</script>