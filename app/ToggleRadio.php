<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
    <script type="text/javascript">
    angular.module("myApp", []).controller("Example", ["$scope", function($scope) {
        $scope.test2 = "one"
            alert("PRASHANT");
    }])

</script>

<?php 
 
 echo "<div ng-app='myApp' ng-controller='Example'>";

 // First pair of radio buttons
 echo "Google";
 echo "<input type='radio' id='radio1' ng-model='test1' value='on' tabindex='1' />
 <label for='radio1'>on</label>
 <input type='radio' id='radio2' ng-model='test1' value='off' tabindex='2'/>
 <label for='radio2'>off</label>
 <p>{{test1}}</p>";
 

 echo "Facebook";
 echo "<input type='radio' id='radio3' ng-model='test2' value='on' />
 		<label for='radio3'>on</label>
 		<input type='radio' id='radio4' ng-model='test2' value='off'/>
 		<label for='radio4'>off</label>
 		<p>{{test2}}</p>"; 		

 echo "Twitter";
 echo "<input type='radio' id='radio5' ng-model='test3' value='on'/>
 		<label for='radio5'>on</label>
 		<input type='radio' id='radio6' ng-model='test3' value='off'/>
 		<label for='radio6'>off</label>
 		<p>{{test3}}</p>";
 		

 echo "Instagram";
 echo "<input type='radio' id='radio7' ng-model='test4' value='on' />
 		<label for='radio7'>on</label>
 		<input type='radio' id='radio8' ng-model='test4' value='off'/>
 		<label for='radio8'>off</label>
 		<p>{{test4}}</p>"; 		

 echo "Tumblr";
 echo "<input type='radio' id='radio9' ng-model='test5' value='on' />
 		<label for='radio9'>on</label>
 		<input type='radio' id='radio10' ng-model='test5' value='off' />
 		<label for='radio10'>off</label>
 		<p>{{test5}}</p>
 		</div>";
 
 
 class SocialLoginSelect extends DB_Connection
 {
 	public function insertToggleValue()
 	{
 		echo "MATHUR";
 		$F=$_POST['radio2'];
 		echo $F;
 	}
 }
 new SocialLoginSelect().insertToggleValue();
?>