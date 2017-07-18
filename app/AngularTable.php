<html>
<style>
table, td  {
  border: 1px solid blue;
  border-collapse: collapse;
  padding: 5px;
}

.odd {
background-color: RED;
}

.even {
background-color: BLUE;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="customersCtrl"> 

<table>
  <tr ng-repeat="x in names" >
    <td ng-if="$odd" class="odd">
    {{ x.Name }}</td>
    
    <td ng-if="$even" class="even">
    {{ x.Name }}</td>
        
    <td ng-if="$odd" class="odd">
    {{ x.Country }}</td>
    
    <td ng-if="$even" class="even">
    {{ x.Country }}</td>
    
    
  </tr>    
</table>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
    $http.get("https://www.w3schools.com/angular/customers.php")
    .then(function (response) {$scope.names = response.data.records;});
});
</script>

</body>
</html>
