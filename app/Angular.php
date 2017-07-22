<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Shopify App</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Philosopher:400,400i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
<script type='text/javascript'>
var generateData = function(){
 var arr = [];
  var letterWords = ["alpha","bravo","charlie","daniel","earl","fish","grace","henry","ian","jack","karen","mike","delta","alex","larry","bob","zelda"]
  for (var i=1;i<60;i++){
  var id = letterWords[Math.floor(Math.random()*letterWords.length)];
   arr.push({"id":id+i,"name":"name "+i,"description":"Description of item #"+i,"field3":id,"field4":"Some stuff about rec: "+i,"field5":"field"+i});
  }
  return arr;
}

var sortingOrder = 'name'; //default sort

function initApp($scope, $filter) {
 
  // init
  $scope.sortingOrder = sortingOrder;
  $scope.pageSizes = [5,10,25,50];
  $scope.reverse = false;
  $scope.filteredItems = [];
  $scope.groupedItems = [];
  $scope.itemsPerPage = 10;
  $scope.pagedItems = [];
  $scope.currentPage = 0;
  $scope.items = generateData();

  var searchMatch = function (haystack, needle) {
    if (!needle) {
      return true;
    }
    return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
  };
  
  // init the filtered items
  $scope.search = function () {
    $scope.filteredItems = $filter('filter')($scope.items, function (item) {
      for(var attr in item) {
        if (searchMatch(item[attr], $scope.query))
          return true;
      }
      return false;
    });
    // take care of the sorting order
    if ($scope.sortingOrder !== '') {
      $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
    }
    $scope.currentPage = 0;
    // now group by pages
    $scope.groupToPages();
  };
  
  // show items per page
  $scope.perPage = function () {
    $scope.groupToPages();
  };
  
  // calculate page in place
  $scope.groupToPages = function () {
    $scope.pagedItems = [];
    
    for (var i = 0; i < $scope.filteredItems.length; i++) {
      if (i % $scope.itemsPerPage === 0) {
        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
      } else {
        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
      }
    }
  };
  
   $scope.deleteItem = function (idx) {
        var itemToDelete = $scope.pagedItems[$scope.currentPage][idx];
        var idxInItems = $scope.items.indexOf(itemToDelete);
        $scope.items.splice(idxInItems,1);
        $scope.search();
        
        return false;
    };
  
  $scope.range = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.prevPage = function () {
    if ($scope.currentPage > 0) {
      $scope.currentPage--;
    }
  };
  
  $scope.nextPage = function () {
    if ($scope.currentPage < $scope.pagedItems.length - 1) {
      $scope.currentPage++;
    }
  };
  
  $scope.setPage = function () {
    $scope.currentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.search();
 
  
  // change sorting order
  $scope.sort_by = function(newSortingOrder) {
    if ($scope.sortingOrder == newSortingOrder)
      $scope.reverse = !$scope.reverse;
    
    $scope.sortingOrder = newSortingOrder;
  };

};

initApp.$inject = ['$scope', '$filter'];
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope) {
  $scope.records = [
    "Store 1",
    "Store 2",
    "Store 3",
    "Store 4",
  ]
});
        
</script>
</head>
<body ng-app="myApp" ng-controller="myCtrl">
<div class="margtop30">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="store-detail martop-10">
          <center>
          <h3>Dashboard</h3>
          
            <nav>
              <ul class="mcd-menu">
                <li> <a href=""> <i class="fa fa-home"></i> <strong>Add Store</strong> </a> </li>
                <li> <a href="" class="active"> <i class="fa fa-edit"></i> <strong>Inventory Management</strong> </a>
                  <ul>
                    <li class="head-bg"><a href="#">Select the Store to be Managed</a> <i class="fa fa-check-square-o" aria-hidden="true"></i></li>
                    <!--  LOOP -->
                    <li ng-repeat="x in records"> <a href="#">{{x}}</a>
                      <input type="checkbox" ng-checked="all">
                    </li>
                    
                    <li> <a href="#">Select All</a>
                      <input type="checkbox" ng-model="all" >
                    </li>
                  </ul>
                </li>
                <li> <a href=""> <i class="fa fa-sliders"></i> <strong>Settings</strong> </a> </li>
                <li> <a href=""> <i class="fa fa-file-text-o"></i> <strong>Reports</strong> </a> </li>
                <li> <a href=""> <i class="fa fa-comments-o"></i> <strong>Contact Us</strong> </a>                   
                </li>
                <li> <a href=""> <i class="fa fa-question"></i> <strong>Help/FAQ</strong> </a> </li>
              </ul>
            </nav>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
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
          <th class="id"><span ng-click="sort_by('id')">Handle <i class="fa fa-sort"></i></span></th>
          <th class="name"><span ng-click="sort_by('name')">Title <i class="fa fa-sort"></i></span></th>
          <th class="description" title="non-sortable">Variant1</th>
          <th class="field3"><span ng-click="sort_by('field3')">Variant2 <i class="fa fa-sort"></i></span></th>
          <th class="field4"><span ng-click="sort_by('field4')">Variant3 <i class="fa fa-sort"></i></span></th>
          <th class="field5"><span ng-click="sort_by('field5')">Variant~SKU <i class="fa fa-sort"></i></span></th>
          <th align="center" style="text-align:center">Action</th>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="9">{{sizes}}
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
          <td align="center">
          <a href="#" class="delet-btn" ng-click="deleteItem($index)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
          <a href="#" class="delet-btn" ng-click="deleteItem($index)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script type='text/javascript' src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>