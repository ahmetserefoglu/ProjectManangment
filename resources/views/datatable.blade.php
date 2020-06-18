<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="{{ asset('datatable/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('datatable/datatables.bootstrap.css')}}">
		
	</head>
	<body>
		<div ng-app="customerApp" ng-controller="customerController" class="container">

			<br />
			<h3 align="center">How to Use Jquery Datatable with AngularJS & PHP</h3>
			<br />

			<table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="okul in okullar">
						<td>@{{ okul.OkulAdi }}</td>
						<td>@{{ okul.OkulTipi }}</td>
					</tr>
				</tbody>
			</table>
			<br />
			<br />
		</div>
		<script src="{{ asset('datatable/jquery.min.js')}}"></script>
		<script src="{{ asset('datatable/jquery.dataTables.min.js')}}"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
		<script src="{{ asset('datatable/angular-datatables.min.js')}}"></script>
	</body>
</html>

<script>

var app = angular.module('customerApp', ['datatables']);

app.controller('customerController', function($scope, $http){
	$http.get('/api/v1/okulplanlama')
      .then(function success(e) {
        $scope.okullar = e.data.okul; 
        $scope.satirSayisi=3;
    });
});

</script>

