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
		echo "sql>>".$sql4."<br>";
		$res4=mysqli_query($this->connection,$sql4);
		
// 		$sql1 = "select `Option1 Value` from "."`".$shp[0]."` group by `Option1 Value`";
// 		echo "sql>>".$sql1."<br>";
// 		$res1=mysqli_query($this->connection,$sql1);
		
// 		$sql2 = "select `Option2 Value` from "."`".$shp[0]."` group by `Option2 Value`";
// 		echo "sql>>".$sql2."<br>"; 	
// 		$res2=mysqli_query($this->connection,$sql2);
		
// 		$sql3 = "select `Option3 Value` from "."`".$shp[0]."` group by `Option3 Value`";
// 		echo "sql>>".$sql3."<br>";
// 		$res3=mysqli_query($this->connection,$sql3);
		
		
		
		//echo "<pre>".print_r($res)."</pre>";// or die(mysqli_error($this->connection));		
		
		//$options = array();
			 while($result = mysqli_fetch_assoc($res4)) {
    //extract($result);
    
			 	$sql5 = "select distinct(`Option2 Value`) from "."`".$shp[0]." where handle like '".$result['handle']."' order by `Option2 Value` ASC";
			 	echo "sql>>".$sql5."<br>";
			 	$res5=mysqli_query($this->connection,$sql5);
			 	
			 	
			 	while($res_v1=mysqli_fetch_assoc($res5))
			 	{
			 		print_r('Option1 Value');
			 	}		 	
			 	
			 	
			 	
			 	
			 	
    	 print_r($result['handle']);}?>
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
   
    <tr>
		<td></td>
     	<td>Title</td>
<!--      	<td> -->
     	<select name="variant1" onClick="">
<!--      		<option>-- Option1 --</option> -->
     		<?php 
// 				while ($query_data1 = mysqli_fetch_array($res1)) {
			?>			
	<!-- 		<option value="<?php echo $query_data1["Option1 Value"]; ?>"><?php echo $query_data1["Option1 Value"]; ?></option>-->			
  			<?php
// 				}
// 			?>
<!--   		</select> -->
<!--  		</td> -->
<!--     	<td> -->
    	<select name="variant2" onClick="">
<!--      		<option>-- Option2 --</option> -->
     		<?php 
// 				while ($query_data2 = mysqli_fetch_array($res2)) {
			?>			
	<!-- >		<option value="<?php echo $query_data2["Option2 Value"]; ?>"><?php echo $query_data2["Option2 Value"]; ?></option>-->			
  			<?php
// 				}
// 			?>
<!--   		</select> -->
<!--  		</td> -->
<!--      	<td> -->
     	<select name="variant3" onClick="">     	
<!--      		<option>-- Option3 --</option> -->
     		<?php 
// 				while ($query_data3 = mysqli_fetch_array($res3)) {
			?>			
			<!-- <option value="<?php echo $query_data3["Option3 Value"]; ?>"><?php echo $query_data3["Option3 Value"]; ?></option>-->			
  			<?php
// 				}
// 			?>
<!--   		</select> -->
<!--   		</td>  -->
 		<td>Variant~SKU</td>
    	<td>Units</td>
    	<td>Price</td>
	</tr>
	<?php 
// 	}
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