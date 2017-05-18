'use strict';
angular.module('App').controller('InventarioCtrl', ['API', '$scope', '$interval', '$mdDialog', 'AlertService', 
	function(API, $scope, $interval, $mdDialog, AlertService) {	
		if(localStorage.admin_token)
	    	$scope.admin = true;
		$scope.selected = [];
		$scope.selected2 = [];
		$scope.printqueue = [];
		$scope.loading = true;
		$scope.strSearch = "";
		$scope.query = {
			searchby: 0,
			limit: 5,
			page: 1,
			status: true
		};
		$scope.status_activo = true;
		$scope.tab_size = 700 + "px";

		$scope.$watch('strSearch', val => {
			if(val && val.length > 0)
	  			$scope.strSearch = val.toUpperCase();
	  	});
	  	$scope.$watch('status_activo', val => {
	  		if(val == undefined)
	  			return;

	  		$scope.query.status = val;
			$scope.query.page = 1,
	  		$scope.selected = [];
			$scope.getInventario();
	  	});

		$scope.refreshbodyheight = (down) => {
			var body = document.body;
			var origninal = angular.copy(body.style.height);
			var new_he = "";
			if($scope.query.limit == 5)
				new_he = 826 + "px";
			else if($scope.query.limit == 10)
				new_he = 956 + "px";
			else if($scope.query.limit == 15)
				new_he = 1256 + "px";
			if(origninal != new_he)
				body.style.height = new_he;
			$scope.loading = false;
		}

		var dt = response => {
			$scope.inventario = response.data.data ? response.data: response;
			$scope.total = response.data.total? response.data.total: response.total;
			$scope.refreshbodyheight();
		}

		API.all("inventario").getList().catch(dt);
		$scope.getInventario = () => {
			if($scope.query.limit == 5)
				$scope.tab_size = 700 + "px";	
			else if($scope.query.limit == 10)
				$scope.tab_size = 830 + "px";
			else if($scope.query.limit == 15)
				$scope.tab_size = 1130 + "px";			
			if($scope.inventario && $scope.inventario.data.length > $scope.query.limit)
			{
				var temp = [];
				$.each($scope.inventario.data, (i,o) => {
					if(i < $scope.query.limit)
						temp.push(o);
				});
				$scope.inventario.data = temp;
			}
			$scope.refreshbodyheight();
			$scope.loading = true;
			$scope.selected = [];
			API.all("inventario?").customGET("", $scope.query).then(dt).catch(dt);
		};
		$scope.buscaArticulo = () => {
			if($scope.strSearch.length == 0)
			{
				$scope.selected = [];
				$scope.query = {
						searchby: 0,
						limit: 5,
						page: 1,
						status: $scope.status_activo
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
					// console.log('BUSCAR POR NUMERO DE SERIE');
				}
				else
				{
					// son solo numeros, si es de 5 caracteres buscar por opcion 4 (oficialia_id o numero de inventario)
					$scope.query.searchby = y != 5? 2: 4;
					$scope.getInventario();
					// console.log('BUSCAR POR NUMERO DE INVETARIO O SERIE');
				}
			}
			else
			{
				// no tiene numeros
				$scope.query.searchby = 3;
				$scope.getInventario();
				// console.log('BUSCAR POR OFICIALIA O RESPONSABLE O SERIE')
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
			{
				$scope.printqueue = $scope.printqueue.filter(o => $.grep($scope.selected2, x => x.id == o.id).length == 0);
				$scope.selected2 = [];
			}
		};
		$scope.baja = () => {
			// mandar objeto articulo, adjuntar fecha_baja al articulo y comentarios
			if($scope.selected.length != 1)
				return;
			localStorage.articulo = JSON.stringify($scope.selected[0]);
			$mdDialog.show({
					controller: BajaInventarioController,
					templateUrl: 'angular/modals/baja_articulo.html',
					parent: angular.element(document.body),
					clickOutsideToClose: true,
					fullscreen: true // Only for -xs, -sm breakpoints.
			    }).then(rs => {
			    	// handle confirm from mdDialog (confirmar)
			    	if(rs)
		    		{
		    			let data = {};
		    			data.id = rs.id;
		    			data.comentario = rs.comentario;
		    			data.fecha_baja = rs.fecha_baja.toLocaleDateString();
		    			data.command = 'baja';
		    			API.all('inventario').post(data).then(ad => {
		    				$scope.selected = [];
		    				$scope.selected2 = [];
		    				$scope.getInventario();
		    			});
		    		}
			    }, res => {
			    	// handle cancel from mdDialog (cancelar)
			    	
			    });
		};
		$scope.millisec = date_str => new Date(date_str).getTime();
		$scope.editar = () => {
			sessionStorage.articulo = JSON.stringify($scope.selected[0]);
			window.location = "#/agregar";
		};
		var BajaInventarioController = ($scope, $mdDialog) => {
			$scope.articulo = JSON.parse(localStorage.articulo);
			$scope.articulo.fecha_baja = new Date();
			if(localStorage.articulo)
				localStorage.removeItem('articulo');
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.confirm = () => {
		    	$scope.projectForm.$setSubmitted();
		    	if($scope.articulo.comentario)
		    		$mdDialog.hide($scope.articulo);
		    }
		}
		BajaInventarioController.$inject = ['$scope', '$mdDialog'];
	}
]);