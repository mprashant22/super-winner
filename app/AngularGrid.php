<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Philosopher:400,400i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
<script type='text/javascript' src="script/app.js">

        
</script>
</head>
<body ng-app="myApp" ng-controller="myCtrl">
<div class="margtop30">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="store-detail martop-10">
          <h3>Dashboard</h3>          
            <nav>
              <ul class="mcd-menu">
                <li> <a href=""> <i class="fa fa-home"></i> <strong>Add Store</strong> </a> </li>
                <li> <a href="" class="active"> <i class="fa fa-edit"></i> <strong>Inventory Management</strong> </a>
                  <ul>
                    <li class="head-bg"><a href="#">Select the Store to be Managed</a> <i class="fa fa-check-square-o" aria-hidden="true"></i></li>
                    <li ng-repeat="x in records"> <a href="#">{{x}}</a>
                      <input type="checkbox"  ng-click="clearParent()" ng-model="checkbox.selected" ng-checked="all">
                      <!--  <input type="checkbox" ng-checked="selection.indexOf(checkbox.name) > -1" ng-click="toggleVisible(checkbox.name)"> 
                      {{count}}--> 
                      <!--<input type="checkbox"  ng-model="store1" ng-init="checked=true" ng-checked="all"/>
                         <input type="checkbox"  ng-model="store2" ng-init="checked=true" ng-checked="all"/>
                         <input type="checkbox"  ng-model="store3" ng-init="checked=true" ng-checked="all"/>--> 
                      
                    </li>
                    <li> <a href="#">Select All</a>
                      <input type="checkbox" ng-model="all" >
                    </li>
                  </ul>
                </li>
                <li> <a href=""> <i class="fa fa-sliders"></i> <strong>Settings</strong> </a> </li>
                <li> <a href=""> <i class="fa fa-file-text-o"></i> <strong>Reports</strong> </a> </li>
                <li> <a href=""> <i class="fa fa-comments-o"></i> <strong>Contact Us</strong> </a> 
                  <!--<ul>
					<li><a href="#"><i class="fa fa-globe"></i>Mission</a></li>
					<li>
						<a href="#"><i class="fa fa-group"></i>Our Team</a>
						<ul>
							<li><a href="#"><i class="fa fa-female"></i>Leyla Sparks</a></li>
							<li>
								<a href="#"><i class="fa fa-male"></i>Gleb Ismailov</a>
								<ul>
									<li><a href="#"><i class="fa fa-leaf"></i>About</a></li>
									<li><a href="#"><i class="fa fa-tasks"></i>Skills</a></li>
								</ul>
							</li>
							<li><a href="#"><i class="fa fa-female"></i>Viktoria Gibbers</a></li>
						</ul>
					</li>
					<li><a href="#"><i class="fa fa-trophy"></i>Rewards</a></li>
					<li><a href="#"><i class="fa fa-certificate"></i>Certificates</a></li>
				</ul>--> 
                </li>
                <li> <a href=""> <i class="fa fa-question"></i> <strong>Help/FAQ</strong> </a> </li>
              </ul>
            </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container" ng-app="myApp">
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
    <table class="table table-striped table-hover">
      <tbody>
        <tr>
          <th class="id"><a ng-click="sort_by('id')">Id <i class="fa fa-sort"></i></a></th>
          <th class="name"><a ng-click="sort_by('name')">Name <i class="fa fa-sort"></i></a></th>
          <th class="description" title="non-sortable">Description</th>
          <th class="field3"><a ng-click="sort_by('field3')">Link <i class="fa fa-sort"></i></a></th>
          <th class="field4"><a ng-click="sort_by('field4')">Field 4 <i class="fa fa-sort"></i></a></th>
          <th class="field5"><a ng-click="sort_by('field5')">Field 5 <i class="fa fa-sort"></i></a></th>
          <th></th>
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
          <td>{{item.name}}</td>
          <td>{{item.description}}</td>
          <td><a href="#">{{item.field3}}</a></td>
          <td>{{item.field4}}</td>
          <td>{{item.field5}}</td>
          <td><a href="#" ng-click="deleteItem($index)">x</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script type='text/javascript' src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>