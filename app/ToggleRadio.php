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
    function Example($scope) {
        
        /*
         * When an element is clicked, the model has not yet
         * been updated, so we check the value of the model 
         * to the value of the clicked element.  If they are 
         * identical, then the user is clicking the "current"
         * (selected) option and we can toggle it by setting 
         * the model to null.
         */
        $scope.toggle = function(event) {
            var keyboardEvent = event.type == 'keydown'
            var spaceOrEnterKey = keyboardEvent &&
                                (event.which == 13 ||
                                 event.which == 32)
            var elem = event.target
            var modelKey = angular.element(elem).attr('ng-model')
            if (elem.value == $scope[modelKey]
               && (!keyboardEvent || spaceOrEnterKey)) {
                $scope[modelKey] = null
            } else {
                if (spaceOrEnterKey)
                    $scope[modelKey] = elem.value
            }
            if (spaceOrEnterKey)
                event.preventDefault()
        }

        // Demonstrate radio button with default selection
        $scope.test2 = 'off'
    }
    </script>