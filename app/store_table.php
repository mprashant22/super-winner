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
		$sql3 = "select `Option3 Value` from "."`".$shp[0]."` group by `Option3 Value`";
		echo "sql>>".$sql3."<br>";
		$res=mysqli_query($this->connection,$sql3);
		//echo "<pre>".print_r($res)."</pre>";// or die(mysqli_error($this->connection));		
		
		$options = array();?>
			
<div>
 <table border=1> 
   <tr>
     <th>Handle</th>
     <th>Title</th>
     <th>Variant1</th>
     <th>Variant2</th>
     <th style="color: #FF0000">Variant3</th>
     <th>Variant~SKU</th>
     <th>Units</th>
     <th>Price</th>
    </tr>
    <tr>
		<td>Handle</td>
     	<td>Title</td>
     	<td>
     	<select>
   			<option value="volvo">Volvo</option>
   			<option value="saab">Saab</option>
   			<option value="mercedes">Mercedes</option>
   			<option value="audi">Audi</option>
 		</select>
 		</td>
    	<td>
    	<select name="variant2" onClick="">
     		<option>-- Option2 --</option>
     		<?php 
				while ($query_data = mysqli_fetch_array($res)) {
			?>			
			<option value="<?php echo $query_data["Option3 Value"]; ?>"><?php echo $query_data["Option3 Value"]; ?></option>			
  			<?php
				}
			?>
  		</select>
 		</td>
     	<td>
     	<select name="variant3" onClick="">     	
     		<option>-- Option3 --</option>
     		<?php 
				while ($query_data = mysqli_fetch_array($res)) {
			?>			
			<option value="<?php echo $query_data["Option3 Value"]; ?>"><?php echo $query_data["Option3 Value"]; ?></option>			
  			<?php
				}
			?>
  		</select>
  		</td> 
 		<td>Variant~SKU</td>
    	<td>Units</td>
    	<td>Price</td>
	</tr>
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