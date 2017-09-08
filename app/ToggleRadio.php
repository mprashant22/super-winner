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
echo "<input type='radio' id='radio3' ng-model='test2' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio3'>on</label>".
		"<input type='radio' id='radio4' ng-model='test2' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio4'>off</label>".
		"<p>{{test2}}</p>".
		"</div>";

echo "Twitter<br><br>";
echo "<input type='radio' id='radio5' ng-model='test3' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio5>on</label>".
		"<input type='radio' id='radio6' ng-model='test3' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio6'>off</label>".
		"<p>{{test3}}</p>".
		"</div>";

echo "Instagram<br><br>";
echo "<input type='radio' id='radio7' ng-model='test4' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio7'>on</label>".
		"<input type='radio' id='radio8' ng-model='test4' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio8'>off</label>".
		"<p>{{test4}}</p>".
		"</div>";

echo "Tumblr<br><br>";
echo "<input type='radio' id='radio9' ng-model='test5' ng-click='toggle($event)' ng-keydown='toggle($event)' value='on' tabindex='1' />".
		"<label for='radio9'>on</label>".
		"<input type='radio' id='radio10' ng-model='test5' ng-click='toggle($event)' ng-keydown='toggle($event)' value='off' tabindex='2'/>".
		"<label for='radio10'>off</label>".
		"<p>{{test5}}</p>".
		"</div>";

?>

 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
    <script type="text/javascript">
    angular.module("Example", []).controller("Example", ["$scope", function($scope) {
        $scope.test2 = "one"
    }])
    </script>