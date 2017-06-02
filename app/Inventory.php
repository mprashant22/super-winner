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
	
	public function __construct()
	{
		echo 'inventory connect';
		$this->connect();
	}

	public function exportExc2MySQL()
	{
		echo 'x';
		if(isset($_POST['submit']))
		{ echo 'y';
			$fname = $_FILES["file"]["name"];
			echo "file>>".$fname;
			$chk_ext = explode(".",$fname);
			print_r($chk_ext);
			$myfile = fopen("C:/xampp/htdocs/index.php", "r") or die("Unable to open file!");
			echo fread($myfile,filesize("webdictionary.txt"));
			if(strtolower($chk_ext[1]) == "php")
			{		
				$filename = $_FILES["file"]["name"];
				echo 'file name>>'.$filename;
				$handle = fopen("C:/xampp/htdocs/index.php", "r");
				echo 'handle >>'.$handle;
				
				
				
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor,Type,Tags,Published,Option1_Name,Option1_Value,
							Option2_Name,Option2_Value,Option3_Name,Option3_Value,Variant_SKU,Variant_Grams,Variant_Inventory_Tracker,
							Variant_Inventory_Qty,Variant_Inventory_Policy,Variant_Fulfillment_Service,Variant_Price,
							Variant_Compare_At_Price,Variant_Requires_Shipping,Variant_Taxable,Variant_Barcode,Image_Src,
							Image_Position,Image_Alt_Text,Gift_Card,SEO_Title,SEO_Description,Google_Shopping_Google_Product_Category,
							Google_Shopping_Gender,Google_Shopping_Age_Group,Google_Shopping_MPN,Google_Shopping_AdWords_Grouping,
							Google_Shopping_AdWords_Labels,Google_Shopping_Condition,Google_Shopping_Custom_Product,
							Google_Shopping_Custom_Label0,Google_Shopping_Custom_Label1,Google_Shopping_Custom_Label2,
							Google_Shopping_Custom_Label3,Google_Shopping_Custom_Label4,Variant_Image,Variant_Weight_Unit,
							Variant_Tax_Code) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]','$data[31]','$data[32]','$data[33]','$data[34]','$data[35]','$data[36]','$data[37]','$data[38]','$data[39]','$data[40]','$data[41]','$data[42]','$data[43]','$data[44]','$data[45]')";
					mysqli_query($sql) or die(mysqli_error());
				}
		
				fclose($handle);
				echo "Successfully Imported";
			}
			else
			{
				echo "Invalid File";
			}
		}
	}
}	
$Inv = new Inventory();
$Inv->exportExc2MySQL();
?>

<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">

Import File : <input type="file" name="file">
<input type="submit" name="submit" value="submit">

</form>