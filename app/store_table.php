<?php

echo "store table";
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class StoreTable extends DB_Connection{
	 
	function __construct(){
		$this->connection = $this->connect();
	}
	
	private $table_name = "products";
	public $connection = '';
	public function storeDisplay()
	{
		$shop='mathurs-storezz.myshopify.com';
		$shp=explode('.', $shop);

		$sql4 = "select distinct(handle) from "."`".$shp[0]."` group by handle";
		//echo "sql>>".$sql4."<br>";
		$res4=mysqli_query($this->connection,$sql4);
?>		
<div>
 <table border=1>  
   <tr>
     <th>Handle</th>
     <th>Title</th>
     <th style="color: #FF0000">Variant1</th>
     <th style="color: #008c33">Variant2</th>
     <th style="color: #4298f4">Variant3</th>
     <th>Variant~SKU</th>
     <th>Units</th>
     <th>Price</th>
    </tr>
		<?php 
		
		
	
			 while($result = mysqli_fetch_assoc($res4)) {
 
			 	$sql1= "select distinct(`Option1 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option1 Value` ASC";
			 	//echo "sql>>".$sql5."<br>";
			 	$res1=mysqli_query($this->connection,$sql1);
			 	
			 	$sql2 = "select distinct(`Option2 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option2 Value` ASC";
			 	//echo "sql>>".$sql5."<br>";
			 	$res2=mysqli_query($this->connection,$sql2);
			 	
// 			 	while($res_v1=mysqli_fetch_assoc($res2)
// 			 	{
// 			 		print_r($res_v1['Option2 Value']);
// 			 	}		 	
			 	
	
			 	
    	 ?>

   
    <tr>
		<td><?php print_r($result['handle']); ?></td>
     	<td>Title</td>
      	<td>
     	<select name="variant1" onClick="">
      		<option>-- Option1 --</option> 
     		<?php 
 				while ($query_data1 = mysqli_fetch_assoc($res1)) {
			?>			
	 		<option value="<?php echo $query_data1["Option1 Value"]; ?>"><?php echo $query_data1["Option1 Value"]; ?></option>		
  			<?php
 				}
 			?>
   		</select>
  		</td>
     	<td>
    	<select name="variant2" onClick="">
      		<option>-- Option2 --</option> 
     		<?php 
 				while ($query_data2 = mysqli_fetch_assoc($res2)) {
			?>			
			<option value="<?php echo $query_data2["Option2 Value"]; ?>"><?php echo $query_data2["Option2 Value"]; ?></option>
  			<?php
 				}
 			?>
   		</select>
  		</td>
      	<td>
     	<select name="variant3" onClick="">     	
      		<option>-- Option3 --</option>
     		<?php 
 				while ($query_data3 = mysqli_fetch_assoc($res3)) {
			?>			
			<option value="<?php echo $query_data3["Option3 Value"]; ?>"><?php echo $query_data3["Option3 Value"]; ?></option>			
  			<?php
 				}
 			?>
   		</select> 
   		</td> 
 		<td>Variant~SKU</td>
    	<td>Units</td>
    	<td>Price</td>
	</tr>
	
	
	<?php 
 	}
	?>	
 </table> 
</div>
  
   <?php 
  
//  			for($i=0;$i<count($query_data);$i++) 
//  			echo "<pre>".$query_data[$i]."</pre><br>"; 
//  			$options[$query_data["handle"]] = $query_data["HANDLE"]; 
	}
}	
	$obj=new StoreTable();
	$obj->storeDisplay();

?>