<?php

echo "store table";
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class StoreTable extends DB_Connection{
	 
	function __construct(){
		$this->connection = $this->connect();
	}
	
	private $table_name = "products";
	public $connection = '';
	public function sync($shop)
	{
		
		
		echo "in class shop >>".$shop;
		$shp=explode('.', $shop);
		echo "^^^^^^^^".$shp[0];
		//$sql = "create table `".$shp[0]."`(Handle text, Title text, Variant1 text,Variant2 text, Variant3 text, VariantSKU integer, VariantInventory integer, VariantPrice integer)";
		$sql = "create table `".$shp[0]."`(Handle text, Title text, Body_HTML text,Vendor text)";
		echo "sql>>".$sql;
		if(!mysqli_query($this->connection,"desc `".$shp[0]."`"))
		{
			echo "IFF";
			mysqli_query($this->connection,$sql);// or die(mysqli_error($this->connection));
		}
		else
		{
			echo "ELSE";
			mysqli_query($this->connection,"truncate `".$shp[0]."`");
		}
		
		
		
		
		
		$target_dir = dirname(getcwd()).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
		
		
		
		
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		
		
		$csvFileType = pathinfo($target_file);
		
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '/var/www/html/shopifyDemoLamp/uploads/'.basename($_FILES["fileToUpload"]["name"]));
		
		
		
		
		$filename = "/var/www/html/shopifyDemoLamp/uploads/".basename($_FILES["fileToUpload"]["name"]);
		
		$handle = fopen($filename, "r");
		print_r($handle);
		
		$data_csv = fgetcsv($handle);
		print_r($data_csv);
		$t=0;
		while(! feof($handle))
		{
			echo "<pre style='color:BLUE'><h4>".++$t."</h4></pre>";
			if(feof($handle))
			{
				echo 'break';
				break;
			}
			
			
			$data_csv = fgetcsv($handle);
			
			
			$values_csv=[];
			$values_csv=$data_csv;
			
			
			for ($i=0;$i<count($data_csv);$i++)
			{
				$data1=mysqli_escape_string($this->connection, $data_csv[$i]);
				$db.="'".$data1."',";
			}
			
			$sql = "INSERT into `".$shp[0]."`(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
			$db="";
			mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
			
		}
		
		fclose($handle);
		echo "Successfully Imported";
		

	}
}


?>
<div>
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

