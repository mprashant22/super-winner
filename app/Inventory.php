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
		return $connection;
	}

	public function exportExc2MySQL()
	{
		echo 'x';
		echo "CONN>>".$connection;
		echo shell_exec("cd ..");
		echo shell_exec("pwd");
		echo '<pre>'.`whoami 2>&1`.'</pre>';
		echo '<pre>'.`cat /var/www/html/shopifyDemoLamp/products_export3.csv 2>&1`.'</pre>';
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
		$filename = "/var/www/html/shopifyDemoLamp/products_export3.csv";
				//echo 'file name>>'.$filename;
				//chmod($filename, 0777);
				$handle = fopen($filename, "r");
				echo 'handle >>'.$handle;
				$row = 1;
				$data = fgetcsv($handle);
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					echo 'in while';
					$num = count($data);
				echo $num;
					print_r($data);
					$row++;
					for ($c=0; $c < $num; $c++) {
						echo $data[$c] . "<br />\n";
					}
					echo $row;
					$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor,Type,Tags,Published,Option1_Name,Option1_Value,
							Option2_Name,Option2_Value,Option3_Name,Option3_Value,Variant_SKU,Variant_Grams,Variant_Inventory_Tracker,
							Variant_Inventory_Qty,Variant_Inventory_Policy,Variant_Fulfillment_Service,Variant_Price,
							Variant_Compare_At_Price,Variant_Requires_Shipping,Variant_Taxable,Variant_Barcode,Image_Src,
							Image_Position,Image_Alt_Text,Gift_Card,SEO_Title,SEO_Description,Google_Shopping_Google_Product_Category,
							Google_Shopping_Gender,Google_Shopping_Age_Group,Google_Shopping_MPN,Google_Shopping_AdWords_Grouping,
							Google_Shopping_AdWords_Labels,Google_Shopping_Condition,Google_Shopping_Custom_Product,
							Google_Shopping_Custom_Label0,Google_Shopping_Custom_Label1,Google_Shopping_Custom_Label2,
							Google_Shopping_Custom_Label3,Google_Shopping_Custom_Label4,Variant_Image,Variant_Weight_Unit,
							Variant_Tax_Code) values(". implode(", ", $data).")";
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
}	
$Inv = new Inventory();
$Inv->exportExc2MySQL();
?>

<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">

Import File : <input type="hidden" name="file" value="/root/products_export.csv">
<input type="submit" name="submit" value="submit">

</form>