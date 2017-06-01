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

echo 'in stores';
require '../includes/db/db_connection.php';

class Inventory extends DB_Connection{
	
	private $table_name = "products";
	
	public function __construct()
	{
		//echo 'stores connect';
		$this->connect();
	}

	public function exportExc2MySQL()
	{
		
		if(isset($_POST['SUBMIT']))
		{
			$fname = $_FILES['sel_file']['name'];
			$chk_ext = explode(".",$fname);
			if(strtolower($chk_ext[1]) == "csv")
			{
		
				$filename = $_FILES['sel_file']['tmp_name'];
				$handle = fopen($filename, "r");
				
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					$sql = "INSERT into products(name,email,phone) values('$data[0]','$data[1]','$data[2]')";
					mysql_query($sql) or die(mysql_error());
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
?>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>

Import File : <input type='text' name='sel_file' size='20'>
<input type='submit' name='submit' value='submit'>

</form>