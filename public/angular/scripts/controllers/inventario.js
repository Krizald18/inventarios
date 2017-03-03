'use strict';
angular.module('App').controller('InventarioCtrl', function (API, $scope, $interval) {	
	$scope.selected = [];
	$scope.loading = true;
	$scope.query = {
		order: 'name',
		limit: 5,
		page: 1
	};	
	$scope.refreshbodyheight = function(){
		var body = document.body,
		    html = document.documentElement;
		body.style.height = 100 + "%";
		setTimeout(function(){
			var height = Math.max( body.scrollHeight, body.offsetHeight, 
		                       html.clientHeight, html.scrollHeight, html.offsetHeight );
			body.style.height = height + "px";
		}, 500);
		$scope.loading = false;
	}

	var dt = function(response){
		$scope.inventario = response.data;
		$scope.refreshbodyheight()
	}

	API.all("inventario").getList().catch(dt);

	$scope.getInventario = function () {
		$scope.loading = true;
		API.all("inventario?page=" + $scope.query.page).customGET("", $scope.query).catch(dt);
	};
});