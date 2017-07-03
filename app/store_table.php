<?php

echo "store table";
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class StoreTable extends DB_Connection{
	 
	function __construct(){
		$this->connection = $this->connect();
	}
	public $v1='',$v2='',$v3='';
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
 
			 	$sql1 = "select distinct(`Option1 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option1 Value` ASC";
			 	$res1 = mysqli_query($this->connection,$sql1);
			 	
			 	$sql2 = "select distinct(`Option2 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option2 Value` ASC";
			 	$res2 = mysqli_query($this->connection,$sql2);
			 	
			 	$sql3 = "select distinct(`Option3 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option3 Value` ASC";
			 	$res3 = mysqli_query($this->connection,$sql3);
			 	
			 	
    	 ?>

   
    <tr>
		<td><?php print_r($result['handle']); ?></td>
     	<td>Title</td>
      	<td>
     	<select name="variant1" onClick="">
      		<option>-- Option1 --</option> 
     		<?php 
 				while ($query_data1 = mysqli_fetch_assoc($res1)) {
 					$v1=$query_data1["Option1 Value"];
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
 					$v2=$query_data2["Option2 Value"];
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
 					$v3=$query_data3["Option3 Value"];
			?>			
			<option value="<?php echo $query_data3["Option3 Value"]; ?>"><?php echo $query_data3["Option3 Value"]; ?></option>			
  			<?php
 				}
 			?>
   		</select> 
   		</td> 
 		<td>
 		<?php 
 		$sql_sku = "select `Variant SKU` from `".$shp[0]."` where handle like '".$result['handle']."' AND `Option1 Value` LIKE '".$v1."' AND `Option2 Value` LIKE '".$v2."' AND `Option3 Value` LIKE '".$v3."'";
		echo $sql_sku;
 		$res_sku = mysqli_query($this->connection,$sql_sku);	
		echo $res_sku;
 		?>
 		</td>
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