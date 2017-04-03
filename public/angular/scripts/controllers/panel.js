'use strict';
angular.module('App')
	.controller('PanelCtrl', function ($scope, $mdDialog) {
		var COLORS = ["#f44336", "#ff1744", "#d50000", "#ff4081", "#ba68c8", "#d1c4e9", "#7c4dff", "#5c6bc0", "#8c9eff", "#536dfe", "#64b5f6", "#1e88e5", "#b3e5fc", "#4fc3f7", "#00b0ff", "#4dd0e1", "#84ffff", "#80cbc4", "#1de9b6", "#00bfa5", "#66bb6a", "#69f0ae", "#00e676", "#c5e1a5", "#b2ff59", "#e6ee9c", "#f4ff81", "#fff59d", "#fdd835", "#fbc02d", "#f57f17", "#ffea00", "#ff6f00", "#ffab91", "#ff8a65", "#ff5722", "#bcaaa4", "#bcaaa4", "#cfd8dc", "#b0bec5", "#90a4ae", "#78909c"];
		$scope.colorTiles = (function() {
			var tiles = [];
			var options = ['Grupos', 'Subgrupos', 'Marcas', 'Modelos', 'Caracteristicas', 'Responsables', 'Áreas', 'Usuarios']
			for (var i = 0; i < options.length; i++) {
			  tiles.push({
			  	id: i,
			    color: randomColor(tiles),
			    option: options[i],
			  });
			}
			return tiles;
		})();

		function randomColor(tiles) {
			var c = COLORS[Math.floor(Math.random() * COLORS.length)];
			if(tiles && tiles.length > 0)
			{
				$.each(tiles, (i,o) =>{
					if(o.color == c)
					{
						c = randomColor(tiles);
						return false;
					}
				});
				return c;
			}
			else
				return c;
		}

		function randomSpan() {
			return 1;
		}
		$scope.open = opt => {
			var controller = null, html_file = '';
			switch(opt){
				case 0:
					controller = GruposController;
					html_file = 'grupos';
					break;
				case 1:
					controller = SubgruposController;
					html_file = 'subgrupos';
					break;
				case 2:
					controller = MarcasController;
					html_file = 'marcas';
					break;
				case 3:
					controller = ModelosController;
					html_file = 'mdoelos';
					break;
				case 4:
					controller = CaracteristicasController;
					html_file = 'caracteristicas';
					break;
				case 5:
					controller = ResponsablesController;
					html_file = 'responsables';
					break;
				case 6:
					controller = AreasController;
					html_file = 'areas';
					break;
				case 7:
					controller = UsuariosController;
					html_file = 'usuarios';
					break;
			}
			dialog(controller, html_file);
		}
		var dialog = (controller, html_file) => {
			if(!controller || !html_file)
				return;
			$mdDialog.show({
				controller: controller,
				templateUrl: 'angular/modals/catalogos/' + html_file + '.html',
				parent: angular.element(document.body),
				clickOutsideToClose: true,
				fullscreen: true // Only for -xs, -sm breakpoints.
		    }).then(rs => {
		    	// handle confirm from mdDialog (confirmar)
		    	
		    }, res => {
		    	// handle cancel from mdDialog (cancelar)
		    	
		    });
		}
		var GruposController = ($scope, $mdDialog, API, ToastService) => {
			$scope.addmode = false;
			$scope.nuevo_grupo = {};
			if(localStorage.admin_token)
    			$scope.admin = true;
			API.all('grupo').getList().then(gr =>{
				$scope.grupos = gr.plain();
			})
			$scope.millisec = date_str => new Date(date_str).getTime();
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.changemode = () => {
				$scope.addmode = !$scope.addmode;
				$scope.nuevo_grupo.grupo = "";
		    }
		    $scope.add = () => {
		    	if(!$scope.nuevo_grupo.grupo)
					return;
				let newgroup = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token,
			    		'grupo': $scope.nuevo_grupo.grupo
			    	}
				API.all('grupo').post(newgroup).then(rs => {
					$scope.grupos = rs.plain();
		    		ToastService.show('Se ha agregado el grupo "'+ $scope.nuevo_grupo.grupo + '"');
					$scope.changemode();
				});
		    }

		    $scope.delete = (grupo) => {
		    	if(grupo && grupo.id)
		    	{
			    	let prot = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token
			    	}
			    	API.one('grupo', grupo.id).remove(prot)
			    	.then(res => {
			    		$scope.grupos = res.plain();
		    			ToastService.show('Se ha eliminado el grupo "'+ grupo.grupo + '"');
			    	});
			    }
		    }
		}, SubgruposController = ($scope, $mdDialog) => {
			console.log('SubgruposController funciona bien');
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.confirm = () => {

		    }
		}, MarcasController = ($scope, $mdDialog) => {
			console.log('MarcasController funciona bien');
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.confirm = () => {

		    }
		}, ModelosController = ($scope, $mdDialog) => {
			console.log('ModelosController funciona bien');
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.confirm = () => {

		    }
		}, CaracteristicasController = ($scope, $mdDialog, API, ToastService) => {
			$scope.addmode = false;
			$scope.nueva_caracteristica = {};
			if(localStorage.admin_token)
    			$scope.admin = true;
			API.all('caracteristica').getList().then(gr =>{
				$scope.caracteristicas = gr.plain();
			})
			$scope.millisec = date_str => new Date(date_str).getTime();
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.changemode = () => {
				$scope.addmode = !$scope.addmode;
				$scope.nueva_caracteristica.caracteristica = "";
		    }
		    $scope.cambioCaracteristica = () => {
				if($scope.nueva_caracteristica.caracteristica && $scope.nueva_caracteristica.caracteristica.length > 0)
					$scope.nueva_caracteristica.caracteristica = $scope.nueva_caracteristica.caracteristica.charAt(0).toUpperCase() + $scope.nueva_caracteristica.caracteristica.slice(1);
			};
		    $scope.add = () => {
		    	if(!$scope.nueva_caracteristica.caracteristica)
					return;
				let newgroup = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token,
			    		'caracteristica': $scope.nueva_caracteristica.caracteristica
			    	}
				API.all('caracteristica').post(newgroup).then(rs => {
					$scope.caracteristicas = rs.plain();
		    		ToastService.show('Se ha agregado la caracteristica "'+ $scope.nueva_caracteristica.caracteristica + '"');
					$scope.changemode();
				});
		    }

		    $scope.delete = (caracteristica) => {
		    	if(caracteristica && caracteristica.id)
		    	{
			    	let prot = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token
			    	}
			    	API.one('caracteristica', caracteristica.id).remove(prot)
			    	.then(res => {
			    		$scope.caracteristicas = res.plain();
		    			ToastService.show('Se ha eliminado la caracteristica "'+ caracteristica.caracteristica + '"');
			    	});
			    }
		    }
		}, ResponsablesController = ($scope, $mdDialog) => {
			console.log('ResponsablesController funciona bien');
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.confirm = () => {

		    }
		}, AreasController = ($scope, $mdDialog, API, ToastService) => {
			$scope.addmode = false;
			$scope.nueva_area = {};
			if(localStorage.admin_token)
    			$scope.admin = true;
			API.all('area').getList().then(gr =>{
				$scope.areas = gr.plain();
			})
			$scope.millisec = date_str => new Date(date_str).getTime();
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.changemode = () => {
				$scope.addmode = !$scope.addmode;
				$scope.nueva_area.area = "";
		    }
		    $scope.cambioArea = () => {
				if($scope.nueva_area.area && $scope.nueva_area.area.length > 0)
					$scope.nueva_area.area = $scope.nueva_area.area.toUpperCase();
			};
		    $scope.add = () => {
		    	if(!$scope.nueva_area.area)
					return;
				let newgroup = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token,
			    		'area': $scope.nueva_area.area.toUpperCase()
			    	}
				API.all('area').post(newgroup).then(rs => {
					$scope.areas = rs.plain();
		    		ToastService.show('Se ha agregado el area "'+ $scope.nueva_area.area + '"');
					$scope.changemode();
				});
		    }

		    $scope.delete = (area) => {
		    	if(area && area.id)
		    	{
			    	let prot = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token
			    	}
			    	API.one('area', area.id).remove(prot)
			    	.then(res => {
			    		$scope.areas = res.plain();
		    			ToastService.show('Se ha eliminado el area "'+ area.area + '"');
			    	});
			    }
		    }
		}, UsuariosController = ($scope, $mdDialog) => {
			console.log('UsuariosController funciona bien');
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.confirm = () => {

		    }
		};
	});