<?php

require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class Export_Sync extends DB_Connection{
	 
	function __construct(){
		$this->connection = $this->connect();
	}

	public $connection = '';	
	public function sync($shop)
	{
		 		$shp=explode('.', $shop);
		 		$sql = "create table `".$shp[0]."`(Handle text, Title text, `Option1 Name` text,`Option1 Value` text, `Option2 Name` text, `Option2 Value` text, `Option3 Name` text, `Option3 Value` text, `Variant SKU` text, `Variant Inventory Qty` text, `Variant Price` text)";

		 		if(!mysqli_query($this->connection,"desc `".$shp[0]."`"))
		 		{
		 			mysqli_query($this->connection,$sql);// or die(mysqli_error($this->connection));
		 		}
		 		else
		 		{
		 			mysqli_query($this->connection,"truncate `".$shp[0]."`");
		 		}
		 		
		$target_dir = dirname(getcwd()).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
 		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$csvFileType = pathinfo($target_file);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '/var/www/html/shopifyDemoLamp/uploads/'.basename($_FILES["fileToUpload"]["name"]));
 				
 		$filename = "/var/www/html/shopifyDemoLamp/uploads/".basename($_FILES["fileToUpload"]["name"]);
		$handle="";
		$handle = fopen($filename, "r");

		print_r($handle);

 				
		$data_csv = fgetcsv($handle); //first row of CSV having column headers.
		
		$t=0;
		while(!feof($handle))
		{
				$data_csv = fgetcsv($handle); // CSV is read by row by row.
				
				if(empty($data_csv)) // while loop breaks if any row is empty.
				{
					echo 'break';
					break; 
				}
		
				for ($i=0;$i<count($data_csv);$i++)
				{					
					$data1=mysqli_escape_string($this->connection, $data_csv[$i]);
					$db.="'".$data1."',";
				}
 		
				$temp="(".rtrim($db,",").")"; // Data for each row.
				$bulk.=$temp; // Concatenating each row in 'bulk' variable. 
				$bulk.=","; // Adding comma after each row.
 				$db="";
 		}
 		
 		$sql = "INSERT into `".$shp[0]."`(Handle, Title, `Option1 Name`,`Option1 Value`, `Option2 Name`, `Option2 Value`, `Option3 Name`, `Option3 Value`, `Variant SKU`, `Variant Inventory Qty`, `Variant Price`) values".rtrim($bulk,",");
 		echo $sql; 
 		mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));		
 		fclose($handle);
 		echo "Successfully Imported";
	}
}
?>