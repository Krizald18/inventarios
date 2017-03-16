'use strict';
angular.module('App').controller('InventarioCtrl', function (API, $scope, $interval) {	
	$scope.selected = [];
	$scope.selected2 = [];
	$scope.printqueue = [];
	$scope.loading = true;
	$scope.strSearch = "";
	$scope.query = {
		searchby: 0,
		limit: 5,
		page: 1
	};

	$scope.$watch('strSearch', function(val){
		if(val && val.length > 0)
  			$scope.strSearch = val.toUpperCase();
  	});

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
		$scope.total = response.data.total;
		$scope.refreshbodyheight()
	}

	API.all("inventario").getList().catch(dt);

	$scope.getInventario = function () {
		$scope.loading = true;
		API.all("inventario?").customGET("", $scope.query).catch(dt);
	};
	$scope.buscaArticulo = function(){
		if($scope.strSearch.length == 0)
		{
			$scope.selected = [];
			$scope.query = {
					searchby: 0,
					limit: 5,
					page: 1
				};
			$scope.getInventario();
			return;
		}
		$scope.selected = [];
		$scope.query.txt = $scope.strSearch.toUpperCase();
		var x = $scope.strSearch.replace(/\D/g,'').length;
		var y = $scope.strSearch.length;
		$scope.query.page = 1;
		$scope.query.limit = 10;
		if(x > 0) // quitarle las letras dejo algo de cadena
		{
			if(x < y) // la cadena resultante es menor que la inicial
			{
				// tiene numeros y letras
				$scope.query.searchby = 1;
				$scope.getInventario();
				console.log('BUSCAR POR NUMERO DE SERIE');
			}
			else
			{
				// son solo numeros
				$scope.query.searchby = 2;
				$scope.getInventario();
				console.log('BUSCAR POR NUMERO DE INVETARIO O SERIE');
			}
		}
		else
		{
			// no tiene numeros
			$scope.query.searchby = 3;
			$scope.getInventario();
			console.log('BUSCAR POR OFICIALIA O RESPONSABLE O SERIE')
		}
	};
	$scope.sortbyOF = function(o){
		console.log(o);
	}
	$scope.printqueueAdd = function(){
		if($scope.selected.length > 0)
		{
			$.each($scope.selected, function(i,o){
				if($scope.printqueue.length == 0)
					$scope.printqueue.push(o);
				else
				{
					let x = $.grep($scope.printqueue, function(pr){
						return pr.id == o.id;
					});
					if(x.length == 0)
						$scope.printqueue.push(angular.copy(o));
				}
			});
			$scope.refreshbodyheight();
		}
	}
	$scope.remove = function(){
		if($scope.printqueue.length > 0 && $scope.selected2.length > 0)
		{
			$scope.printqueue = $scope.printqueue.filter(function(o) {
				return $.grep($scope.selected2, function(x){
					return x.id == o.id;
				}).length == 0;
			});
		}
	}
});