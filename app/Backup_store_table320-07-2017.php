<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script> -->

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Philosopher:400,400i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>

<script type="text/javascript" src="script/app2.js"></script>

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
		$shop='mathurs-store.myshopify.com';
		$shp=explode('.', $shop);

		$sql4 = "select distinct(handle) from "."`".$shp[0]."` group by handle";
		//echo "sql>>".$sql4."<br>";
		$res4=mysqli_query($this->connection,$sql4);
?>	
	
<div>
<form id="my_form">
<div class="container" ng-app="">
  <div ng-controller="initApp">
    <div class="row">
      <div class="col-md-3">
        <div class="input-group input-group-lg add-on">
          <input type="text" class="form-control search-query" ng-model="query" ng-change="search()" placeholder="Search">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="text-center">Store 1</h2>
      </div>
      <div class="col-md-3">
        <select class="form-control input-lg pull-right" ng-model="itemsPerPage" ng-change="perPage()" ng-options="('show '+size+' per page') for size in pageSizes">
        </select>
      </div>
    </div>
    <table class="table table-striped table-bordered table-hover">
      <tbody>
        <tr>
          <th class="field0"><input type="checkbox" ng-click="toggleSelect()" /> Select All <br />
      <div ng-repeat="checkbox in checkboxes">
         <input type="checkbox" name="{{checkbox.name}}" value="{{checkbox.value}}" ng-click="clearParent()" ng-model="checkbox.selected">{{checkbox.label}}
      </div></th>
          <th class="id"><span ng-click="sort_by('id')">Handle <i class="fa fa-sort"></i></span></th>
          <th class="name"><span ng-click="sort_by('name')">Title <i class="fa fa-sort"></i></span></th>
          <th class="description" title="non-sortable">Variant1</th>
          <th class="field3"><span ng-click="sort_by('field3')">Variant2 <i class="fa fa-sort"></i></span></th>
          <th class="field4"><span ng-click="sort_by('field4')">Variant3 <i class="fa fa-sort"></i></span></th>
          <th class="field5"><span ng-click="sort_by('field5')">Variant~SKU <i class="fa fa-sort"></i></span></th>
          <th class="field6"><span ng-click="sort_by('field6')">Units <i class="fa fa-sort"></i></span></th>
          <th class="field7"><span ng-click="sort_by('field7')">Price <i class="fa fa-sort"></i></span></th>
          <th align="center" style="text-align:center">Action</th>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="10">{{sizes}}
            <div class="text-center">
              <ul class="pagination">
                <li ng-class="{disabled: currentPage == 0}"> <a href="javascript:;" ng-click="prevPage()">« Prev</a> </li>
                <li ng-repeat="n in range(pagedItems.length)" ng-class="{active: n == currentPage}" ng-click="setPage()"> <a href="javascript:;" ng-bind="n + 1">1</a> </li>
                <li ng-class="{disabled: currentPage == pagedItems.length - 1}"> <a href="javascript:;" ng-click="nextPage()">Next »</a> </li>
              </ul>
            </div></td>
        </tr>
      </tfoot>
      <tbody>
        <tr ng-repeat="item in pagedItems[currentPage] | orderBy:sortingOrder:reverse">
         <td><input type="checkbox" ng-model="item.Selected"> </td>
          <td>{{item.id}}</td>
          <td contenteditable="true">{{item.name}}</td>
          <td><select class="sect">
<option ng-repeat="x in records">{{x}}</option>
</select></td>
          <td><select class="sect">
<option ng-repeat="x in records">{{x}}</option>
</select></td>
          <td>{{item.field4}}</td>
          <td>{{item.field5}}</td>
          <td>{{item.field6}}</td>
          <td>{{item.field7}}</td>
          <td align="center">
          <a href="#" class="delet-btn" ng-click="deleteItem($index)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
          <a href="#" class="delet-btn" ng-click="deleteItem($index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>




<!-- ------------------------ PRASHANT  -->


<input type="text" id="search" placeholder="Type to search">
<button class="btn btn-primary delete_all">DELETE</button>
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
		$ii = 0;
			 while($result = mysqli_fetch_assoc($res4)) {
 
			 	$sql1 = "select distinct(`Option1 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option1 Value` ASC";
			 	$res1 = mysqli_query($this->connection,$sql1);
			 	
			 	$sql2 = "select distinct(`Option2 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option2 Value` ASC";
			 	$res2 = mysqli_query($this->connection,$sql2);
			 	
			 	$sql3 = "select distinct(`Option3 Value`) from "."`".$shp[0]."` where handle like '".$result['handle']."' order by `Option3 Value` ASC";
			 	$res3 = mysqli_query($this->connection,$sql3);

				//echo $result['handle'].">";
    	 ?>
  
    <tr class="product_row" id="<?php echo $result['handle']; ?>">
		<td><input type="checkbox" class="sub_chk <?php echo 'sub_chk'.$ii;?>" data-handle="<?php echo($result['handle']); ?>"></td>
		<td class="handle"><?php print_r($result['handle']); ?></td>
     	<td><span class="title">Title</span></td>
      	<td>
     	<select id="v1" class="v1" name="variant1" onClick="">
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
 		<td class="editable-col" contenteditable="true" col-index='0' data-handle="<?php echo($result['handle']); ?>" data-variant1="<?php echo($result['Option1 Value']); ?>" data-variant2="<?php echo($result['Option2 Value']); ?>" data-variant3="<?php echo($result['Option3 Value']); ?>" oldVal ="<?php echo($result['Variant SKU']); ?>"><span class="sku">0</span></td>
    	<td class="editable-col" contenteditable="true" col-index='1' data-handle="<?php echo($result['handle']); ?>" data-variant1="<?php echo($result['Option1 Value']); ?>" data-variant2="<?php echo($result['Option2 Value']); ?>" data-variant3="<?php echo($result['Option3 Value']); ?>" oldVal ="<?php echo($result['Variant Inventory Qty']); ?>"><span class="units">0</span></td>
    	<td class="editable-col" contenteditable="true" col-index='2' data-handle="<?php echo($result['handle']); ?>" data-variant1="<?php echo($result['Option1 Value']); ?>" data-variant2="<?php echo($result['Option2 Value']); ?>" data-variant3="<?php echo($result['Option3 Value']); ?>" oldVal ="<?php echo($result['Variant Price']); ?>"><span class="price">0</span></td>
    	<td><a href='javascript: void(0)' class="glyphicon glyphicon-edit"></a>~<a data-handle="<?php echo($result['handle']); ?>" href='javascript: void(0)' class="remove-row pull-right glyphicon glyphicon-trash"></a></td>
	</tr>
	<?php $ii++;
 	}
	?>
 </table>
 </form>
</div>
  
   <?php 
   header('location:http://192.241.146.48/shopifyDemoLamp/app/store_table.php');
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
							
							WRN_PROFILE_DELETE = "Are you sure you want to delete these rows?";  
							var check = confirm(WRN_PROFILE_DELETE);  
							if(check == true){
							//for server side
								
								var product_row_len = $("#store-table .product_row").length;
                                var g = 0;
                                var arrhand = [];
								for(g = 0; g<product_row_len;g++){
                                     var checkval = $(".sub_chk"+g).is(":checked");
                                     if(checkval == true){
                                    	 arrhand.push($(".sub_chk"+g).attr("data-handle"));     
                                       
                                         }
								}
								
								 //var rr = "ranjeet"; 
//                                 $.post("delete.php",
//                                   {
//                                         name: rr                                       
//                                   },
//                                    function(data){
//                                      alert(data );
//                                  });
	
								$.ajax({
								                  url: 'delete.php',
								                  type: 'post',
								                  data: {points : arrhand},
								                  success: function(data) {
								                     // alert("data>>"+data);                      						
														$("#msgdiv").html(data);
														location.reload();
								                  }
								});


							}  
  
					});

			jQuery('.remove-row').on('click', function(e) {
				WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
					var check = confirm(WRN_PROFILE_DELETE);
					var handle=$(this).attr("data-handle");
				//	alert("handle=="+handle);
					if(check == true){//alert("true-remove row");
 					$.ajax({
 		                  url: 'delete.php',
 		                  type: 'post',
 		                  data: {one_Handle : handle},
 		                  success: function(data) {
 		                     // alert("data>>"+data);                      						
 								$("#msgdiv").html(data);
 								location.reload();
                  }
		});
// 						$('table tr').filter($(this).attr("data-handle")).remove();
 					}
			});

			 $('td.editable-col').on('focusout', function() {

				    data = [];
				    data[0] = $(this).text();
				    data[1] = $(this).attr("data-handle");
				    data[2] = $(this).attr("col-index");
				    data[3] = $(this).parents("tr").find(".v1").val();
				    data[4] = $(this).parents("tr").find(".v2").val();
				    data[5] = $(this).parents("tr").find(".v3").val();
				    console.log("selected>>"+data[3]+data[4]+data[5]);
				    
 				//    alert("data_val=="+data);
// 				    data['id'] = $(this).parent('tr').attr('data-row-id');
// 				    data['index'] = $(this).attr('col-index');
// 				      if($(this).attr('oldVal') === data['val'])
// 				    return false;
				    
 				    $.ajax({   
				          
 				          type: 'post',  
 				          url: 'edit.php',
// 				         cache:false,
				          data: {points : data},
// 				          dataType: "json",
				          success: function(data)  
				          {   
					       //   alert("response>>"+data);
// 				            //$("#loading").hide();
// 				            if(response.status) {
// 				              $("#msg").removeClass('alert-danger');
// 				              $("#msg").addClass('alert-success').html(response.msg);
// 				            } else {
// 				              $("#msg").removeClass('alert-success');
// 				              $("#msg").addClass('alert-danger').html(response.msg);
// 				            }
				          }   
 				        });
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
 		<div id="msgdiv" style="">mathur</div>
 		<div id="msg" style="">mathur</div>
 		<div>{names}</div>