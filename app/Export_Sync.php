<?php
echo 'in xpo';
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class Export_Sync extends DB_Connection{
	 
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
		 		$sql = "create table `".$shp[0]."`(Handle text, Title text, `Option1 Name` text,`Option1 Value` text, `Option2 Name` text, `Option2 Value` text, `Option3 Name` text, `Option3 Value` text, `Variant SKU` integer, `Variant Inventory Qty` integer, `Variant Price` integer)";
		 		//$sql = "create table `".$shp[0]."`(Handle text, Title text, Body_HTML text,Vendor text)";
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
 				$colNames=$data_csv;
 				
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

echo print_r($data_csv);
 					for ($i=0;$i<count($data_csv);$i++)
 					{
 						
 						echo "inside LOOOOOOP";
 						$data1=mysqli_escape_string($this->connection, $data_csv[$i]);
 						if(isset($data1) === false && empty($data1) === true && is_numeric($data1))
 						{
 							echo "ppppppp";
 							$data1=0;
 						}
 							
 						echo '[data1>>'.$data1;
 						$db.="'".$data1."',";
 					}
 					echo "<db>";//.$db;
 					
				
 					//$sql = "INSERT into `".$shp[0]."`(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
 					$sql = "INSERT into `".$shp[0]."`(Handle, Title, `Option1 Name`,`Option1 Value`, `Option2 Name`, `Option2 Value`, `Option3 Name`, `Option3 Value`, `Variant SKU`, `Variant Inventory Qty`, `Variant Price`) values(".rtrim($db,",").")";
 					$db="";
 					
 					mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
					
 				}
 				
				
 				fclose($handle);
 				echo "Successfully Imported";
		}
	}


?>
