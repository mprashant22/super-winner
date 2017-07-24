<?php
//echo 'in xpo';
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class Export_Sync extends DB_Connection{
	 
	function __construct(){
		$this->connection = $this->connect();
	}

	public $connection = '';	
	public function sync($shop)
	{
		 		//echo "in class shop >>".$shop;
		 		$shp=explode('.', $shop);
		 		//echo "^^^^^^^^".$shp[0];
		 		$sql = "create table `".$shp[0]."`(Handle text, Title text, `Option1 Name` text,`Option1 Value` text, `Option2 Name` text, `Option2 Value` text, `Option3 Name` text, `Option3 Value` text, `Variant SKU` text, `Variant Inventory Qty` text, `Variant Price` text)";

		 		//echo "sql>>".$sql;
		 		if(!mysqli_query($this->connection,"desc `".$shp[0]."`"))
		 		{
		 			//echo "IFF";
		 			mysqli_query($this->connection,$sql);// or die(mysqli_error($this->connection));
		 		}
		 		else
		 		{
		 			//echo "ELSE";
		 			mysqli_query($this->connection,"truncate `".$shp[0]."`");
		 		}
		 		
		$target_dir = dirname(getcwd()).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
 		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$csvFileType = pathinfo($target_file);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '/var/www/html/shopifyDemoLamp/uploads/'.basename($_FILES["fileToUpload"]["name"]));
 				
 		$filename = "/var/www/html/shopifyDemoLamp/uploads/".basename($_FILES["fileToUpload"]["name"]);
$handle="";
		$handle = fopen($filename, "r");
		//echo "mmmm".$handle;
		print_r($handle);
		//echo "count?".count($handle);
 				
		$data_csv = fgetcsv($handle);
		//print_r($data_csv);
		//$colNames=$data_csv;
 				
		$t=0;
		while(!feof($handle))
		{
				echo "<pre style='color:BLUE'><h4>".++$t."</h4></pre>";
				
				
				$data_csv = fgetcsv($handle);
				
				if(empty($data_csv))
				{
					echo 'break';
					break; 
				}
	
				
				echo "DATA_CSV";
				//echo "<pre>".print_r($data_csv)."</pre>";				
		
				for ($i=0;$i<count($data_csv);$i++)
				{					
 					//echo "inside LOOOOOOP";
					$data1=mysqli_escape_string($this->connection, $data_csv[$i]);
					//echo '[data1>>'.$data1;
					$db.="'".$data1."',";
				}
 		

				$temp="(".rtrim($db,",").")";
				//echo "bulk insertions"."<br>";
				$bulk.=$temp;
				$bulk.=",";
				echo "temp".$temp;
				
				echo "<pre style='color:RED'>".$bulk."</pre><br><br>";
				
				$sql = "INSERT into `".$shp[0]."`(Handle, Title, `Option1 Name`,`Option1 Value`, `Option2 Name`, `Option2 Value`, `Option3 Name`, `Option3 Value`, `Variant SKU`, `Variant Inventory Qty`, `Variant Price`) values(".rtrim($db,",").")";
 				$db="";
 				//echo $sql;
 				
 				mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
 		}
 				
 		fclose($handle);
 		echo "Successfully Imported";
	}
}
?>