<?php

echo "store table";
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';

class StoreTable extends DB_Connection{
	 
	function __construct(){
		$this->connection = $this->connect();
	}
}

?>
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

