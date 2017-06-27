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
		$sql = "select * from "."`".$shp[0]."` order by handle";
		echo "sql>>".$sql."<br>";
		$res=mysqli_query($this->connection,$sql);
		//echo "<pre>".print_r($res)."</pre>";// or die(mysqli_error($this->connection));		
		
		$options = array();
		while ($query_data = mysqli_fetch_array($res)) {
			echo "<>".$query_data;
			$options[$query_data["handle"]] = $query_data["HANDLE"];
		}
		
	}
}
	
	$obj=new StoreTable();
	$obj->storeDisplay();

?>


<select name="REL" onClick="submitCboSemester();">
<?php foreach ($options as $key => $value) : ?>
    <?php $selected = ($key == $_POST['REL']) ? 'selected="selected"' : ''; ?>
    <option value="<?php echo $key ?>" <?php echo $selected ?>>
    <?php echo $value ?>
    </option>
<?php endforeach; ?>
</select>



<div>
 <table border=1> 
   <tr>
     <th>Handle</th>
     <th>Title</th>
     <th>Variant1</th>
     <th>Variant2</th>
     <th>Variant3</th>
     <th>Variant~SKU</th>
     <th>Units</th>
     <th>Price</th>
    </tr>
    <tr>
     <td>Handle</td>
     <td>Title</td>
     <td><select>
   <option value="volvo">Volvo</option>
   <option value="saab">Saab</option>
   <option value="mercedes">Mercedes</option>
   <option value="audi">Audi</option>
 </select></td>
    <td><select>
   <option value="volvo">Volvo</option>
   <option value="saab">Saab</option>
   <option value="mercedes">Mercedes</option>
   <option value="audi">Audi</option>
 </select></td>
     <td><select>
   <option value="volvo">Volvo</option> 
   <option value="saab">Saab</option> 
   <option value="mercedes">Mercedes</option>
   <option value="audi">Audi</option>
 </select></td> 
 	<td>Variant~SKU</td>
     <td>Units</td>
     <td>Price</td>
</tr>
</table> 

