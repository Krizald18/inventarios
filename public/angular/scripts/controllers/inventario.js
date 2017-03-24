'use strict';
angular.module('App').controller('InventarioCtrl', function(API, $scope, $interval, AlertService) {	
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

	$scope.$watch('strSearch', val => {
		if(val && val.length > 0)
  			$scope.strSearch = val.toUpperCase();
  	});

	$scope.refreshbodyheight = () => {
		var body = document.body,
		    html = document.documentElement;
		body.style.height = 100 + "%";
		setTimeout(() => {
			var height = Math.max( body.scrollHeight, body.offsetHeight, 
		        html.clientHeight, html.scrollHeight, html.offsetHeight );
			body.style.height = height + "px";
		}, 500);
		$scope.loading = false;
	}

	var dt = response => {
		$scope.inventario = response.data;
		$scope.total = response.data.total;
		$scope.refreshbodyheight()
	}

	API.all("inventario").getList().catch(dt);

	$scope.getInventario = () => {
		$scope.loading = true;
		API.all("inventario?").customGET("", $scope.query).catch(dt);
	};
	$scope.buscaArticulo = () => {
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
	$scope.print = () => AlertService.show("Función no implementada", "Esta funcón sera habilitada proximamente...");
	$scope.printqueueprint = () => AlertService.show("Función no implementada", "Esta funcón sera habilitada proximamente...");

	$scope.printqueueAdd = () => {
		if($scope.selected.length > 0)
		{
			$.each($scope.selected, (i,o) => {
				if($scope.printqueue.length == 0)
					$scope.printqueue.push(o);
				else
				{
					let x = $.grep($scope.printqueue, pr => pr.id == o.id);
					if(x.length == 0)
						$scope.printqueue.push(angular.copy(o));
				}
			});
			$scope.selected = [];
			$scope.selected2 = [];
			$scope.refreshbodyheight();
		}
	};
	$scope.remove = () => {
		if($scope.printqueue.length > 0 && $scope.selected2.length > 0)
			$scope.printqueue = $scope.printqueue.filter(o => $.grep($scope.selected2, x => x.id == o.id).length == 0);
	};
	$scope.baja = (articulo) => AlertService.show("Función no implementada", "Esta funcón sera habilitada proximamente...");
	/*{
		$mdDialog.show({
				controller: BajarEvidenciasController,
				templateUrl: 'angular/modals/baja_articulo.html',
				parent: angular.element(document.body),
				clickOutsideToClose: true,
				fullscreen: true // Only for -xs, -sm breakpoints.
		    }).then(rs => {}, res => {
		    	// handle cancel from mdDialog (salir)
		    	if(res)
	    		{
	    			//
	    		}
		    });
	};*/
	$scope.editar = (articulo) => AlertService.show("Función no implementada", "Esta funcón sera habilitada proximamente...");
});