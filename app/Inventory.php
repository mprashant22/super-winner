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

<form action="#" method="post">
<input type="checkbox" name="check_list[]" value="C/C++" onclick="checkB()"><label>C/C++</label><br/>
<!-- <input type="checkbox" name="check_list[]" value="Java" onclick="checkB(this.value)"><label>Java</label><br/>-->
<!-- <input type="checkbox" name="check_list[]" value="PHP" onclick="checkB(this.value)"><label>PHP</label><br/>-->
<input type="submit" name="submit" value="Submit"/>
</form>


<script type="text/javascript">
function checkB()
{
	 var x = document.getElementById('myDIV');
	    if (x.style.display === 'none') {
	        x.style.display = 'none';
	    } else {
	        x.style.display = 'block';
	    }
	
		//alert("hellow");
//  	    if($("input[type=checkbox]:checked"")
//      	{
//  			if(!empty($_POST['check_list']))
//  			{
			
//   Loop to store and display values of individual checked checkbox.
//  				foreach($_POST['check_list'] as $selected)
//  				{
//  					echo $selected."</br>";
//  				}
//  			}
			
//      	}

 }
</script>

<div id="myDIV" style="background-color: lightblue;">
This is my DIV element.
</div>

 <?php
//if(isset($_POST['submit'])){//to run PHP script on submit
//if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
//foreach($_POST['check_list'] as $selected){
//echo $selected."</br>";
//}
//}
//}
?>


<?php

echo 'in inventory';
//require '../includes/db/db_connection.php';
require '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
class Inventory extends DB_Connection{
	
	private $table_name = "products";
	protected $connection=null;
	public function __construct()
	{
		//echo 'inventory connect';
		$connection= $this->connect();
		//echo "connect>>".$connection; 
	}
function exportExc2MySQL()
	{
		//echo 'x';
		$connection= $this->connect();
		//echo shell_exec("cd ..");
		//echo shell_exec("pwd");
		$cmd="cat /var/www/html/shopifyDemoLamp/temp.txt 2>&1";
		//echo shell_exec($cmd);
		//echo '<pre>'.`whoami 2>&1`.'</pre>';
	//	echo '<pre>'.`cat /var/www/html/shopifyDemoLamp/products_export3.csv 2>&1`.'</pre>';
 		//echo '<pre>'.`cat temp.txt 2>&1`.'</pre>';
// 		if(isset($_POST['submit']))
// 		{ 
			//echo 'y';
			//$fname = $_FILES["file"]["name"];
			//echo "file>>".$fname;
			//chmod($filename, 0777);
			//$chk_ext = explode(".",$fname);
			print_r($chk_ext);  
		//	if(strtolower($chk_ext[1]) == "csv")
		//	{		
		$filename = "/var/www/html/shopifyDemoLamp/products_export4.csv";
				//echo 'file name>>'.$filename;
				//chmod($filename, 0777);
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
					//echo "<pre>prashant</pre>";
// 					foreach ($data as $value){
// 						$values[] = "'$value'";
						//echo "<pre".$value."</pre>";
					//}
					$values=[];
					$values=$data;
// $query .= "(".implode(", ", $data).")";
// echo $query;


					for ($i=0;$i<count($data);$i++)
					{
						echo $data[$i]."/";
						$data1=mysqli_escape_string($connection, $data[$i]);
						$db.="'".$data1."',";
					}
				
					echo '<pre style="color:#FF0000">'.$db."</pre>";
					$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values(".rtrim($db,",").")";
					//echo $sql;
					$db="";
					mysqli_query($connection,$sql) or die(mysqli_error($connection));
					
				}
				
// 				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
// 				{
// 					//$num = count($data);
// 		$data_val[] = $data;
// 		print_r($data_val);
// 		foreach($data_val[0] as $val){
// 			echo "<pre>".$val."</pre>";
// 		}
// 					foreach ($data as $value){
// 						$values[] = "'$value'";
// 					}
					//$query .= "(".implode(", ", $values).")";
					//echo "<pre>".$query."</pre>";
				//	$sql = "INSERT into products(Handle,Title,Body_HTML,Vendor) values".$query;
				//	echo 'sql q>>'.$sql;
					//mysqli_query($connection,$sql) or die(mysqli_error($connection));
				//}
				
				
				fclose($handle);
				echo "Successfully Imported";
			//}
			//else
			//{
				//echo "Invalid File";
			//}
		}
	}
//}	
// $Inv = new Inventory();
// $Inv->exportExc2MySQL();
?>

<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">

Import File : <input type="hidden" name="file" value="/root/products_export.csv">
<input type="submit" name="submit" value="submit">

</form>