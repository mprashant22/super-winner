<?php 

echo "<div ng-app ng-controller='Example'>";

// First pair of radio buttons
echo "Google ";
echo "<input type='radio' id='radio1' ng-model='test1' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
"<label for='radio1'>on</label>".
"<input type='radio' id='radio2' ng-model='test1' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
"<label for='radio2'>off</label>".
"<p>{{test1}}</p>".
"</div>";

echo "Facebook<br><br>";
echo "<input type='radio' id='radio1' ng-model='test2' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio1'>on</label>".
		"<input type='radio' id='radio2' ng-model='test2' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio2'>off</label>".
		"<p>{{test2}}</p>".
		"</div>";

echo "Twitter<br><br>";
echo "<input type='radio' id='radio1' ng-model='test3' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio1'>on</label>".
		"<input type='radio' id='radio2' ng-model='test3' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio2'>off</label>".
		"<p>{{test3}}</p>".
		"</div>";

echo "Instagram<br><br>";
echo "<input type='radio' id='radio1' ng-model='test4' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio1'>on</label>".
		"<input type='radio' id='radio2' ng-model='test4' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio2'>off</label>".
		"<p>{{test4}}</p>".
		"</div>";

echo "Tumblr<br><br>";
echo "<input type='radio' id='radio1' ng-model='test5' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio1'>on</label>".
		"<input type='radio' id='radio2' ng-model='test5' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio2'>off</label>".
		"<p>{{test5}}</p>".
		"</div>";

?>

 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
    <script type="text/javascript">

    angular.module("Example", []).controller("Example", ["$scope", function($scope) {
        $scope.test2 = "one"
    }])
    </script>