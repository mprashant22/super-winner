<!-- <link href="../templates/bootstrap.css" rel="stylesheet" type="text/css"> -->
<!-- <link href="../templates/bootstrap.min.css"  rel="stylesheet" type="text/css"> -->

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
<!--    </tr>    -->
<!-- </table> -->



<?php
echo 'in xpo';
require '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';


class Export_Sync{
	 
	function __construct(){
		$this->connection = $this->connect();
	}
	private $table_name = "products";
	public $connection = '';
	public function sync()
	{
	
		echo 'csv2mysql';

 		
 			$target_dir = dirname(getcwd()).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
 			
 			echo 'Trdr>'.$target_dir;
 			
 			
 			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  			echo "trget file>><pre>".$target_file."</pre>";
 			$uploadOk = 1;
 			$csvFileType = pathinfo($target_file);
  			echo "extension>>".$csvFileType['extension'];
//  			print_r($csvFileType);
 			
  				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '/var/www/html/shopifyDemoLamp/uploads/'.basename($_FILES["fileToUpload"]["name"]));
  				
  				echo '$_FILES>>'.$_FILES["fileToUpload"]["name"];
  				echo  '>>shop>>{{'.$_REQUEST['shop']."}}";
  				
// 		$filename = "/var/www/html/shopifyDemoLamp/uploads/products_export4.csv";

// 				$handle = fopen($filename, "r");
// 				$data = fgetcsv($handle);
// 				while(! feof($handle))
// 				{
// 					if(feof($handle))
// 					{
// 						break;
// 					}
// 					//print_r(fgetcsv($handle));
// 					$data = fgetcsv($handle);

// 					$values=[];
// 					$values=$data;


// 					for ($i=0;$i<count($data);$i++)
// 					{
// 						$data1=mysqli_escape_string($connection, $data[$i]);
// 						$db.="'".$data1."',";
// 					}
				
// 					$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
// 					$db="";
// 					mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
					
// 				}
				
// 				fclose($handle);
// 				echo "Successfully Imported";
		
		$store='storedemo.myshopify.com';
		$table=explode(".", $store);
		echo $table[0];
		
		 
			$sql = "create table ".$table[0]."(Handle text, Title text, Variant1 text,Variant2 text, Variant3 text, VariantSKU integer, VariantInventory integer, VariantPrice integer)";
			echo "sql>>".$sql;
			mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
		}
	}


?>
