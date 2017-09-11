<?php 
require_once '/var/www/html/shopifyDemoLamp/includes/db/db_connection.php';
//require __DIR__. '../../includes/utils/Shopify.php';
//require __DIR__. '../../includes/db/Stores.php';
//$Shopify = new Shopify();
//$Stores = new Stores();
//echo "vapas";
//$shop = $_REQUEST['shop'];
//echo "shooooop".$shop;
//$shop_info = $Stores->is_shop_exists($shop);
//print_r($shop_info);

$shop = "mathurs-store.myshopify.com";

 echo "<div ng-app='myApp' ng-controller='Example'>";
 echo "<form ng-submit='myFunc()' ng-controller='Example'>";
// echo "<input type='hidden' name='shop' ng-init="shop='prashant'" ng-value='shop'>";
 // First pair of radio buttons
 echo "Google";
 echo "<input type='radio' id='radio1' ng-model='test1' value=1 tabindex='1' />
 <label for='radio1'>on</label>
 <input type='radio' id='radio2' ng-model='test1' value=0 tabindex='2'/>
 <label for='radio2'>off</label>
 <p>{{test1}}</p>";
 

 echo "Facebook";
 echo "<input type='radio' id='radio3' ng-model='test2' value=1 />
 		<label for='radio3'>on</label>
 		<input type='radio' id='radio4' ng-model='test2' value=0 />
 		<label for='radio4'>off</label>
 		<p>{{test2}}</p>";

 echo "Twitter";
 echo "<input type='radio' id='radio5' ng-model='test3' value=1 />
 		<label for='radio5'>on</label>
 		<input type='radio' id='radio6' ng-model='test3' value=0 />
 		<label for='radio6'>off</label>
 		<p>{{test3}}</p>";
 		

 echo "Instagram";
 echo "<input type='radio' id='radio7' ng-model='test4' value=1 />
 		<label for='radio7'>on</label>
 		<input type='radio' id='radio8' ng-model='test4' value=0 />
 		<label for='radio8'>off</label>
 		<p>{{test4}}</p>"; 		

 echo "Tumblr";
 echo "<input type='radio' id='radio9' ng-model='test5' value=1 />
 		<label for='radio9'>on</label>
 		<input type='radio' id='radio10' ng-model='test5' value=0 />
 		<label for='radio10'>off</label>
 		<p>{{test5}}</p>
 		</div>";
 
 echo "<input type='submit' id='submit' value='Submit' />";

?>


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
    <script type="text/javascript">
    angular.module("myApp", []).controller("Example", ["$scope", "$http", function($scope,$http) {
        $scope.test2 = "on"
           // alert("PRASHANT");
			var shop="<?php echo $shop; ?>";
        	$scope.myFunc = function () {alert("in func"+shop);
        	$scope.rdo=[shop,$scope.test1,$scope.test2,$scope.test3,$scope.test4,$scope.test5];
        	$http({
        	    method : "POST",
        	    url : "ToggleRadioDB.php",
        	    data: $scope.rdo
        	  }).then(function mySuccess(response) {
        	      $scope.myWelcome = response.data;
        	      console.log(response.data);
        	    }, function myError(response) {
        	      $scope.myWelcome = response.data;
        	  });
           // $scope.myTxt = "You clicked submit!";
        }
    }])

</script>