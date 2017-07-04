<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
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
<form id="my_form">
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
		<td class="handle"><?php print_r($result['handle']); ?></td>
     	<td>Title</td>
      	<td>
     	<select class="v1" name="variant1" onClick="">
      		<option>-- Option1 --</option> 
     		<?php 
 				while ($query_data1 = mysqli_fetch_assoc($res1)) {
 					$v1=$query_data1["Option1 Value"];
			?>			
	 		<option value="<?php echo $query_data1["Option1 Value"]; ?>" selected="selected"><?php echo $query_data1["Option1 Value"]; ?></option>		
  			<?php
 				}
 			?>
   		</select>
  		</td>
     	<td>
    	<select class="v2" name="variant2" onClick="">
      		<option>-- Option2 --</option> 
     		<?php 
 				while ($query_data2 = mysqli_fetch_assoc($res2)) {
 					$v2=$query_data2["Option2 Value"];
			?>			
			<option value="<?php echo $query_data2["Option2 Value"]; ?>" selected="selected"><?php echo $query_data2["Option2 Value"]; ?></option>
  			<?php
 				}
 			?>
   		</select>
  		</td>
      	<td>
     	<select class="v3" name="variant3" onClick="">     	
      		<option>-- Option3 --</option>
     		<?php 
 				while ($query_data3 = mysqli_fetch_assoc($res3)) {
 					$v3=$query_data3["Option3 Value"];
			?>			
			<option value="<?php echo $query_data3["Option3 Value"]; ?>" selected="selected"><?php echo $query_data3["Option3 Value"]; ?></option>			
  			<?php
 				}
 			?>
   		</select> 
   		</td> 
 		<td>
           <span class="sku">sku</span>
 		</td>
    	<td ><span class="units">Units</span></td>
    	<td ><span class="price">Price</span></td>
	</tr>
	
	
	<?php 
 	}
	?>	
 </table> 

 </form>
</div>


<div id=info></div>
  
   <?php 
  
//  			for($i=0;$i<count($query_data);$i++) 
//  			echo "<pre>".$query_data[$i]."</pre><br>"; 
//  			$options[$query_data["handle"]] = $query_data["HANDLE"]; 
	}
}	
	$obj=new StoreTable();
	$obj->storeDisplay();
?>




	<script type="text/javascript">
	alert("load");
		$(document).ready(function() {

			disen = function(s){ // disable, enable
				$(s).prop('disabled', function(i, v) { return !v; });
				console.log('disable/enable button');
			};

			$( "#my_form tr td select" ).change( function() {
               var handle = $(this).parent("td").siblings(".handle").text();
               var v1 = $(this).parents("tr").find(".v1").val();
               var v2 = $(this).parents("tr").find(".v2").val();
               var v3 = $(this).parents("tr").find(".v3").val();


               var ourObj = {};
               ourObj.handle = handle;
               ourObj.v1 = v1;
               ourObj.v2 = v2;
               ourObj.v3 = v3;
               ourObj.arPoints = [{'x':handle, 'y': v1 , 'z':v2, 'p':v3}];
               var $t = $(this);
               $.ajax({
                  url: 'select_query_for_AJAX.php',
                  type: 'post',
                  data: {"points" : JSON.stringify(ourObj)},
                  success: function(data) {
                      
                       $("#ajax_success").html(data);
                       var ajax_sku = $("#ajax_sku").html();
                       var ajax_unit = $("#ajax_unit").text();
                       var ajax_price = $("#ajax_price").text();


                       $t.parents("tr").find(".price").text(ajax_price);
                       $t.parents("tr").find(".sku").text(ajax_sku);
                       $t.parents("tr").find(".units").text(ajax_unit);
                       //$(this).parent("td").siblings("td").find(".sku").text("rr");
                       //$(this).parent("td").siblings(".units").html(ajax_unit);
                       //$(this).parent("td").siblings(".price").html(ajax_price);
                       
                  }
               });   

              



               
			});
		});
		</script>
		<div id="ajax_success"></div>


