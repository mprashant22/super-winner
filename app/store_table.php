<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

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

<input type="text" id="search" placeholder="Type to search">
<button class="btn btn-primary delete_all"></button>
<table id="store-table" border=1>
   <tr>
   	 <th><input type="checkbox" id="master"></th>
     <th>Handle</th>
     <th>Title</th>
     <th style="color: #FF0000">Variant1</th>
     <th style="color: #008c33">Variant2</th>
     <th style="color: #4298f4">Variant3</th>
     <th>Variant~SKU</th>
     <th>Units</th>
     <th>Price</th>     
     <th>Action</th>
    </tr>
		<?php		
			 while($result = mysqli_fetch_assoc($res4)) {
 
			 	$sql1 = "select distinct(`Option1 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option1 Value` ASC";
			 	$res1 = mysqli_query($this->connection,$sql1);
			 	
			 	$sql2 = "select distinct(`Option2 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option2 Value` ASC";
			 	$res2 = mysqli_query($this->connection,$sql2);
			 	
			 	$sql3 = "select distinct(`Option3 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option3 Value` ASC";
			 	$res3 = mysqli_query($this->connection,$sql3);
 print_r( $result['handle']);
    	 ?>
  
    <tr data-row-id="<?php echo $result['handle']; ?>">
		<td><input type="checkbox" class="sub_chk" data-id="1"></td>
		<td class="handle"><?php print_r($result['handle']); ?></td>
     	<td><span class="title">Title</span></td>
      	<td>
     	<select class="v1" name="variant1" onClick="">
<!--       		<option>-- Option1 --</option>  -->
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
<!--       		<option>-- Option2 --</option>  -->
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
<!--       		<option>-- Option3 --</option> -->
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
 		<td><span class="sku">0</span></td>
    	<td><span class="units">0</span></td>
    	<td><span class="price">0</span></td>
    	<td><a href='javascript: void(0)' class="glyphicon glyphicon-edit"></a>~<a href='javascript: void(0)' class="remove-row pull-right glyphicon glyphicon-trash"></a></td>
	</tr>
	<?php 
 	}
	?>	
 </table>
 </form>
</div>
  
   <?php 
  
	}
}	
	$obj=new StoreTable();
	$obj->storeDisplay();
?>

	<script type="text/javascript">
		$(document).ready(function() {

			jQuery('#master').on('click', function(e) {
			 if($(this).is(':checked',true))  
			 {
			 $(".sub_chk").prop('checked', true);  
			 }  
			 else  
			 {  
			 $(".sub_chk").prop('checked',false);  
			 }  
			});



			jQuery('.delete_all').on('click', function(e) { 
				var allVals = [];  
						$(".sub_chk:checked").each(function() {  
							allVals.push($(this).attr('data-row-id'));
						});  
						alert(allVals);
						//alert(allVals.length); return false;  
						if(allVals.length <=0)  
						{  
							alert("Please select row.");  
						}  
						else {  
							//$("#loading").show(); 
							WRN_PROFILE_DELETE = "Are you sure you want to delete these rows?";  
							var check = confirm(WRN_PROFILE_DELETE);  
							if(check == true){
								alert("value>>"+check);  
								//for server side
								
								var join_selected_values = allVals.join(","); 
								alert(join_selected_values);
								
								$.ajax({   
								  
									type: "POST",  
									url: "delete.php",  
									cache:false,  
									data: 'ids='+join_selected_values,  
									success: function(response)  
									{   
										$("#loading").hide();  
										$("#msgdiv").html(response);
										//referesh table
									}   
								});
				              //for client side
							  $.each(allVals, function( index, value ) {
								  $('store-table tr').filter("[data-row-id='" + value + "']").remove();
							  });
								

							}  
						}  
					});

			jQuery('.remove-row').on('click', function(e) {
				WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
					var check = confirm(WRN_PROFILE_DELETE);  
					if(check == true){alert("true");
						$('table tr').filter("[data-row-id='" + $(this).attr('data-id') + "']").remove();
					}
			});

			

			

			var $rows = $('#store-table tr');
			$('#search').keyup(function() {
			    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
			    
			    $rows.show().filter(function() {
			        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
			        return !~text.indexOf(val);
			    }).hide();
			});			
			

			function myQ()
			{
				$( "#my_form tr td select" ).change();
			}
			

			disen = function(s){ // disable, enable
				$(s).prop('disabled', function(i, v) { return !v; });
				console.log('disable/enable button');
			};

			$( "#my_form tr td select" ).change( function() {
               var handle = $(this).parent("td").siblings(".handle").text();
               var title = $(this).parents("tr").find(".title").val();
               var v1 = $(this).parents("tr").find(".v1").val();
               var v2 = $(this).parents("tr").find(".v2").val();
               var v3 = $(this).parents("tr").find(".v3").val();               

               var ourObj = {};
               ourObj.handle = handle;
               ourObj.title = title;
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
                       var ajax_title = $("#ajax_title").html();
                       var ajax_sku = $("#ajax_sku").html();
                       var ajax_unit = $("#ajax_unit").text();
                       var ajax_price = $("#ajax_price").text();


                       $t.parents("tr").find(".title").text(ajax_title);
                       $t.parents("tr").find(".price").text(ajax_price);
                       $t.parents("tr").find(".sku").text(ajax_sku);
                       $t.parents("tr").find(".units").text(ajax_unit);
                  }
               });

				
                                  
			});

			 myQ();
			
			
		});
		</script>
 		<div id="ajax_success" style="visibility: hidden"></div>