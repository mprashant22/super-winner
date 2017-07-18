<html ng-app="myApp">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    
    <script>
      
angular.module("myApp" , [])

.controller("myController", function($scope) {
  $scope.isVisible1="false";
  $scope.isVisible2="false";
  $scope.isVisible3="false";
  $scope.isVisible4="false";
  
  $scope.myCollection = [
      { name: 'John', age: 25 },
      { name: 'Barry', age: 43 },
      { name: 'Kim', age: 26 },
      { name: 'Susan', age: 51 },     
    ];
  $scope.selection=[];  
  $scope.toggleVisible = function(person) {
	  var idx = $scope.selection.indexOf(person);

	    // is currently selected
	    if (idx > -1) {
	      $scope.selection.splice(idx, 1);
	    }

	    // is newly selected
	    else {
	      $scope.selection.push(person);
	    }
  };
});

  </script>
  </head>
  <body ng-controller="myController">
    <ul>
      <li ng-repeat="person in myCollection">
     <!-- <input type="checkbox" ng-checked="selection.indexOf(person.name) > -1" ng-click="toggleVisible(person.name)">--> 
     <input type="checkbox" ng-click="toggleVisible(person.name)">
      </li>
    </ul>
    <div ng-repeat="name in selection">
		{{name}}:{{age}}
		</div>
  </body>
</html>
