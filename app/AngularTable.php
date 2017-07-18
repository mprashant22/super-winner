<html>
<style>
table, td  {
  border: 1px solid blue;
  border-collapse: collapse;
  padding: 5px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="customersCtrl"> 

<table>
  <tr ng-repeat="x in names" ng-if="$odd" ? 'style="color:#FF0011"':'style="color:#00FF11"'>
    <td>
    {{ x.Name }}</td>
        
    <td>
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
