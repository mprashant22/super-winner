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
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';


class Export_Sync extends DB_Connection{
	 
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
  			print_r($csvFileType);
 			
  				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '/var/www/html/shopifyDemoLamp/uploads/'.basename($_FILES["fileToUpload"]["name"]));
  				
  				echo '$_FILES>>'.$_FILES["fileToUpload"]["name"];
  				
  				
  			//	$filename = '/var/www/html/shopifyDemoLamp/uploads/'.$_FILES["fileToUpload"]["name"];
  				$filename = '/var/www/html/shopifyDemoLamp/uploads/Book1.csv';

  				//echo "?filxx>>>>".$filename;
  				
 				$handle = fopen($filename, "r");
 				//echo "handlxxxx".$handle;
 				
 				$data = fgetcsv($handle);
 				//echo "<pre>".$data."</pre>";
 				while(! feof($handle))
 				{
 					//echo '1x';
 					if(feof($handle))
 					{
 					//	echo '2x';
 						break;
 					}
 					//echo "<pre>".fgetcsv($handle)."</pre>";
 					
 					
 					
 					$data = fgetcsv($handle);
 					//echo '3x';
 					$values=[];
 					$values=$data;
 					//echo '4x';
 					//echo "<pre>".($data)."</pre>";

 					for ($i=0;$i<count($data);$i++)
 					{
 						//echo '5x';
 						$data1=mysqli_escape_string($connection, $data[$i]);
 						//echo '6x';
 						//print_r($data1);
 						$db.="'".$data1."',";
 						//echo '7x'.$db;
 					}
				
 					$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
 					echo $sql;
 					$db="";
 					mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
 					//echo '9x';
					
 				}
				
 				fclose($handle);
 				echo "Successfully Imported";
		
		$store='storedemo.myshopify.com';
		$table=explode(".", $store);
		echo $table[0];
		
		 
			$sql = "create table ".$table[0]."(Handle text, Title text, Variant1 text,Variant2 text, Variant3 text, VariantSKU integer, VariantInventory integer, VariantPrice integer)";
			echo "sql>>".$sql;
			mysqli_query($this->connection,$sql);// or die(mysqli_error($this->connection));
		}
	}


?>
