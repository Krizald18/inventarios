'use strict';
angular.module('App')
	.controller('PanelCtrl', function ($scope, $mdDialog) {
		var COLORS = ["#f44336", "#ff1744", "#d50000", "#ff4081", "#ba68c8", "#d1c4e9", "#7c4dff", "#5c6bc0", "#8c9eff", "#536dfe", "#64b5f6", "#1e88e5", "#b3e5fc", "#4fc3f7", "#00b0ff", "#4dd0e1", "#84ffff", "#80cbc4", "#1de9b6", "#00bfa5", "#66bb6a", "#69f0ae", "#00e676", "#c5e1a5", "#b2ff59", "#e6ee9c", "#f4ff81", "#fff59d", "#fdd835", "#fbc02d", "#f57f17", "#ffea00", "#ff6f00", "#ffab91", "#ff8a65", "#ff5722", "#bcaaa4", "#bcaaa4", "#cfd8dc", "#b0bec5", "#90a4ae", "#78909c"];
		var randomColor = tiles => {
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
		$scope.colorTiles = (() => {
			var tiles = [];
			var options = ['Grupos', 'Subgrupos', 'Marcas', 'Modelos', 'Caracteristicas', 'Responsables', 'Áreas', 'Usuarios'];
			for (var i = 0; i < options.length; i++) {
			  tiles.push({
			  	id: i,
			    color: randomColor(tiles),
			    option: options[i],
			  });
			}
			return tiles;
		})();

		

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
					html_file = 'modelos';
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
				fullscreen: false // Only for -xs, -sm breakpoints.
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
		}, SubgruposController = ($scope, $mdDialog, API, ToastService) => {
			$scope.addmode = false;
			$scope.nuevo_subgrupo = {};
			if(localStorage.admin_token)
    			$scope.admin = true;
			API.all('subgrupo').getList().then(gr =>{
				$scope.subgrupos = gr.plain();
			});
			API.all('grupo').getList().then(gr =>{
				$scope.grupos = gr.plain();
			});
			$scope.millisec = date_str => new Date(date_str).getTime();
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.changemode = () => {
				$scope.addmode = !$scope.addmode;
				$scope.nuevo_subgrupo.subgrupo = "";
				$scope.nuevo_subgrupo.grupo_id = null;
		    }
		    $scope.cambioSubgrupo = () => {
				if($scope.nuevo_subgrupo.subgrupo && $scope.nuevo_subgrupo.subgrupo.length > 0)
					$scope.nuevo_subgrupo.subgrupo = $scope.nuevo_subgrupo.subgrupo.charAt(0).toUpperCase() + $scope.nuevo_subgrupo.subgrupo.slice(1);
			};
		    $scope.add = () => {
		    	if(!$scope.nuevo_subgrupo.subgrupo)
					return;
				let newsubgroup = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token,
			    		'subgrupo': $scope.nuevo_subgrupo.subgrupo,
			    		'grupo_id': $scope.nuevo_subgrupo.grupo_id
			    	}
				API.all('subgrupo').post(newsubgroup).then(rs => {
					$scope.subgrupos = rs.plain();
		    		ToastService.show('Se ha agregado el subgrupo "'+ $scope.nuevo_subgrupo.subgrupo + '"');
					$scope.changemode();
				});
		    }

		    $scope.delete = (subgrupo) => {
		    	if(subgrupo && subgrupo.id)
		    	{
			    	let prot = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token
			    	}
			    	API.one('subgrupo', subgrupo.id).remove(prot)
			    	.then(res => {
			    		$scope.subgrupos = res.plain();
		    			ToastService.show('Se ha eliminado el subgrupo "'+ subgrupo.subgrupo + '"');
			    	});
			    }
		    }
		}, MarcasController = ($scope, $mdDialog, API, ToastService) => {
			$scope.addmode = false;
			$scope.nueva_marca = {};
			if(localStorage.admin_token)
    			$scope.admin = true;
			API.all('marca').getList().then(gr =>{
				$scope.marcas = gr.plain();
			})
			$scope.millisec = date_str => new Date(date_str).getTime();
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.changemode = () => {
				$scope.addmode = !$scope.addmode;
				$scope.nueva_marca.marca = "";
		    }
		    $scope.cambioMarca = () => {
				if($scope.nueva_marca.marca && $scope.nueva_marca.marca.length > 0)
					$scope.nueva_marca.marca = $scope.nueva_marca.marca.toUpperCase();
			};
		    $scope.add = () => {
		    	if(!$scope.nueva_marca.marca)
					return;
				let newgroup = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token,
			    		'marca': $scope.nueva_marca.marca.toUpperCase()
			    	}
				API.all('marca').post(newgroup).then(rs => {
					$scope.marcas = rs.plain();
		    		ToastService.show('Se ha agregado el marca "'+ $scope.nueva_marca.marca + '"');
					$scope.changemode();
				});
		    }

		    $scope.delete = (marca) => {
		    	if(marca && marca.id)
		    	{
			    	let prot = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token
			    	}
			    	API.one('marca', marca.id).remove(prot)
			    	.then(res => {
			    		$scope.marcas = res.plain();
		    			ToastService.show('Se ha eliminado el marca "'+ marca.marca + '"');
			    	});
			    }
		    }
		}, ModelosController = ($scope, $mdDialog, API, ToastService) => {
			$scope.addmode = false;
			$scope.nuevo_modelo = {};
			if(localStorage.admin_token)
    			$scope.admin = true;
			API.all('modelo?articulos=true').getList().then(gr =>{
				$scope.modelos = gr.plain();
			});
			API.all('subgrupo').getList().then(gr =>{
				$scope.subgrupos = gr.plain();
			});
			API.all('marca').getList().then(gr =>{
				$scope.marcas = gr.plain();
			});
			API.all('caracteristica').getList().then(gr =>{
				$scope.caracteristicas_all = gr.plain();
				$scope.caracteristicas = angular.copy($scope.caracteristicas_all);
			});
			$scope.millisec = date_str => new Date(date_str).getTime();
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.changemode = () => {
				$scope.addmode = !$scope.addmode;
				$scope.nuevo_modelo.modelo = "";
				$scope.nuevo_modelo.subgrupo_id = null;
				$scope.nuevo_modelo.marca_id = null;
				$scope.nuevo_modelo.caracteristica_id = null;
		    }
		    $scope.cambioModelo = () => {
				if($scope.nuevo_modelo.modelo && $scope.nuevo_modelo.modelo.length > 0)
					$scope.nuevo_modelo.modelo = $scope.nuevo_modelo.modelo.charAt(0).toUpperCase() + $scope.nuevo_modelo.modelo.slice(1);
			};
			$scope.$watch('nuevo_modelo.caracteristica_id', cid => {
				if(cid && !$scope.nuevo_modelo.subgrupo_id)
				{
					let crct = $.grep($scope.caracteristicas, c=> c.id == cid)[0];
					if(crct.modelos.length > 0)
						$scope.nuevo_modelo.subgrupo_id = crct.modelos[0].subgrupo_id;
					else
						return;
					// $scope.caracteristicas = $scope.caracteristicas_all.filter(c => c.subgrupo_id == $scope.nuevo_modelo.subgrupo_id);
				}
			});
			$scope.$watch('nuevo_modelo.subgrupo_id', sid => {
				/*
				if(sid)
					$scope.caracteristicas = $scope.caracteristicas_all.filter(c => {
						if(c.modelos.length > 0)
						{
							// mostrar caracteristicas para articulos de ese subgrupo sid
							// no se pueden filtrar las caracteristicas por ahora por que no estan asociadas a un subgrupo
						}
					}
				*/
			});
		    $scope.add = () => {
		    	if(!$scope.nuevo_modelo.modelo)
					return;
				let newsubgroup = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token,
			    		'modelo': $scope.nuevo_modelo.modelo,
			    		'subgrupo_id': $scope.nuevo_modelo.subgrupo_id,
			    		'marca_id': $scope.nuevo_modelo.marca_id,
			    		'caracteristica_id': $scope.nuevo_modelo.caracteristica_id
			    	}
				API.all('modelo').post(newsubgroup).then(rs => {
					$scope.modelos = rs.plain();
		    		ToastService.show('Se ha agregado el modelo "'+ $scope.nuevo_modelo.modelo + '"');
					$scope.changemode();
				});
		    }

		    $scope.delete = (modelo) => {
		    	if(modelo && modelo.id)
		    	{
			    	let prot = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token
			    	}
			    	API.one('modelo', modelo.id).remove(prot)
			    	.then(res => {
			    		$scope.modelos = res.plain();
		    			ToastService.show('Se ha eliminado el modelo "'+ modelo.modelo + '"');
			    	});
			    }
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
		}, ResponsablesController = ($scope, $mdDialog, API, ToastService) => {
			$scope.addmode = false;
			$scope.nuevo_responsable = {};
			if(localStorage.admin_token)
    			$scope.admin = true;
			API.all('responsable').getList().then(gr =>{
				$scope.responsables = gr.plain();
			});
			API.all('oficialia').getList().then(gr =>{
				$scope.oficialias = gr.plain();
			});
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.changemode = () => {
				$scope.addmode = !$scope.addmode;
				$scope.nuevo_responsable.responsable = "";
				$scope.nuevo_responsable.oficialia_id = null;
		    }
		    $scope.cambioResponsable = () => {
				if($scope.nuevo_responsable.responsable && $scope.nuevo_responsable.responsable.length > 0)
					$scope.nuevo_responsable.responsable = $scope.nuevo_responsable.responsable.charAt(0).toUpperCase() + $scope.nuevo_responsable.responsable.slice(1);
			};
		    $scope.add = () => {
		    	if(!$scope.nuevo_responsable.responsable)
					return;
				let newsubgroup = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token,
			    		'responsable': $scope.nuevo_responsable.responsable,
			    		'oficialia_id': $scope.nuevo_responsable.oficialia_id
			    	}
				API.all('responsable').post(newsubgroup).then(rs => {
					$scope.responsables = rs.plain();
		    		ToastService.show('Se ha agregado el responsable "'+ $scope.nuevo_responsable.responsable + '"');
					$scope.changemode();
				});
		    }

		    $scope.delete = (responsable) => {
		    	if(responsable && responsable.id)
		    	{
			    	let prot = {
			    		'user': localStorage.user,
			    		'admin_token' : localStorage.admin_token
			    	}
			    	API.one('responsable', responsable.id).remove(prot)
			    	.then(res => {
			    		$scope.responsables = res.plain();
		    			ToastService.show('Se ha eliminado el responsable "'+ responsable.responsable + '"');
			    	});
			    }
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