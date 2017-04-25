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
			$scope.inventario = response.data.data ? response.data: response;
			$scope.total = response.data.total? response.data.total: response.total;
			$scope.refreshbodyheight()
		}

		API.all("inventario").getList().catch(dt);

		$scope.getInventario = () => {
			$scope.loading = true;
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
					// son solo numeros
					$scope.query.searchby = 2;
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