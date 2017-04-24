'use strict';
angular.module('App').controller('AgregarCtrl', ['API', '$scope', 'AlertService', 'ToastService', function (API, $scope, AlertService, ToastService) {	
	$scope.selected = [];
	$scope.editOnly = false;
	$scope.loading = true;
	$scope.project = {};
	$scope.project.status = true;
	$scope.project.keefForm = true;
  	$scope.isOpen = false;
  	$scope.firstTime = true;
  	$scope.ttimes = 0;
  	$scope.saveOrder = "";
	
	API.all("grupo?full=true").getList().then(grp => {
		$scope.grupos = grp.plain();
		if(sessionStorage.articulo)
		{
			$scope.editOnly = true;
			$scope.project = JSON.parse(sessionStorage.articulo);
			$scope.project.subgrupo_id = $scope.project.modelo.subgrupo_id;
			$scope.project.modelo_id = $scope.project.modelo.id;
			$scope.project.marca_id = $scope.project.modelo.marca_id;
			$scope.project.caracteristica_id = $scope.project.modelo.caracteristica_id;
			$scope.project.area_id = $scope.project.area? $scope.project.area.id : null;
			$scope.project.oficialia_id = $scope.project.oficialia? $scope.project.oficialia.id: null;
			for (let grupo of $scope.grupos) {
				for (let subgrupo of grupo.subgrupos) {
					if(subgrupo.id == $scope.project.subgrupo_id)
					{
						$scope.project.grupo_id = grupo.id;
						break;
					}
				}
				if($scope.project.grupo_id)
					break;
			}
			setTimeout(()=> {
				$scope.cambioModelo();				
			}, 1000);
			setTimeout(()=> {
				$scope.cambioModelo();
			}, 2000);
			sessionStorage.clear();
		}
		if($scope.grupos.length == 1)
			$scope.project.grupo_id = $scope.grupos[0].id;
	});
	$scope.oficialias = API.all("oficialia").getList().then(response => {
		$scope.oficialias = response.plain();
		$scope.oficialias_bk = angular.copy($scope.oficialias);
	});
	API.all("municipio").getList().then(m=>{
		$scope.municipios = m.plain();
		if($scope.project.oficialia)
			$scope.project.municipio = JSON.stringify($.grep($scope.municipios, m => m.id == $scope.project.oficialia.municipio_id)[0]);
	});
	$scope.areas = API.all("area").getList().$object;
	$scope.responsables = API.all("responsable").getList().$object;

	$scope.$watch('project.numero_inventario', val => {
		if(val && val.length > 0)
			$scope.project.numero_inventario = val.replace(/\D/g,'');
  	});

	$scope.$watch('project.numero_serie', val => {
		if(val && val.length > 0)
  			$scope.project.numero_serie = val.toUpperCase();
  	});
	
	$scope.$watch('project.grupo_id', val => {
		if(!val) return;

		delete($scope.subgrupos);
		delete($scope.marcas);
		delete($scope.modelos);

		$scope.grupo = $.grep($scope.grupos, g => g.id == val )[0]; // encuentra el grupo
		$scope.subgrupos = $scope.grupo.subgrupos.filter( sgr => sgr.marcas && sgr.marcas.length > 0 && tienenModelos(sgr.marcas) ); // saca todos los subgrupos

		setMarcas();
		refreshCaracteristicas();
		// mostrar solo marcas sin msodelos o marcas con modelos de ese GRUPO
		// y solo mostrar los modelos de ese GRUPO
		if(!$scope.caracteristicas)
			$scope.caracteristicas = [];

		$scope.projectForm.$setPristine();
		$scope.projectForm.$setUntouched();
  	});
	
	var tienenModelos = marcas => {
		var tiene = false;
		$.each(marcas, (i,o) => {
			if(o.modelos && o.modelos.length > 0)
			{
				tiene = true;
				return false;
			}
		});
		return tiene;
	};
	var buscaMarca = (modelo, marca) => {
		// regresa true si la marca contiene a ese modelo
		if(!marca || marca.modelos && marca.modelos.length == 0)
			return false;
		let x = $.grep(marca.modelos, mod => mod.id == modelo);
		return x.length != 0;
	};
	var refreshCaracteristicas = () => {
		delete($scope.caracteristicas);
		if($scope.modelos && $scope.modelos.length > 0)
		{
			let cr = $scope.modelos.map(modelo => modelo.caracteristica);
			$scope.caracteristicas = [];
			$.each(cr, (i, o) =>{
				var caract = $.grep($scope.caracteristicas, c => c.id == o.id);
				if(caract.length == 0)
					$scope.caracteristicas.push(o);
				else
					caract[0].multiple = true;
			});		
		}
	};
  	$scope.cambioSubgrupo = val => {
  		var val = $scope.project.subgrupo_id;
		// y solo mostrar los modelos de ese subgrupo
		if(val)
		{
			delete($scope.project.modelo);
			delete($scope.project.modelo_id);
			delete($scope.project.caracteristica_id);
		}
		else 
			return;

		$scope.subgrupo = $.grep($scope.subgrupos, s => s.id == $scope.project.subgrupo_id)[0];

		if($scope.project.marca_id)
		{
			$scope.marca = $.grep($scope.subgrupo.marcas, mr => mr.id == $scope.project.marca_id)[0];

			if($scope.marca) // si encuentra la marca en las marcas de este subgrupo
				$scope.modelos = $scope.marca.modelos.filter(mod => mod.subgrupo_id == val);
			else
				$scope.modelos = [];
		}
		if($scope.modelos.length == 0)
		{
			delete($scope.project.marca_id);
			// buscar marcas y modelos
			$scope.marcas = [];
			if($scope.subgrupo.marcas && $scope.subgrupo.marcas.length > 0)
			{
				$.each($scope.subgrupo.marcas, (j, o)  => {
					var ob = {};
					ob.id = o.id;
					ob.marca = o.marca;
					ob.modelos = o.modelos.filter(modf => modf.subgrupo_id == $scope.project.subgrupo_id);

					if($scope.marcas.length == 0)
					{
						if(ob.modelos.length > 0)
							$scope.marcas.push(ob);
					}
					else {
						let c = $.grep($scope.marcas, mx => mx.marca == ob.marca); // buscar que no exista
						if(c.length == 0)
							if(ob.modelos.length > 0)
								$scope.marcas.push(ob);
					}
				});
				$scope.modelos = [];
				if($scope.marcas && $scope.marcas.length > 0)
				{
					if($scope.marcas.length == 1)
						$scope.project.marca_id = $scope.marcas[0].id;
					$.each($scope.marcas, (i, marca) => {
						// buscar todos los modelos de todas las marcas, solo para este subgrupo
						if(marca.modelos && marca.modelos.length > 0)
							$.each(marca.modelos, (l, modelo) => {
								if(modelo.subgrupo_id == $scope.subgrupo.id)
									$scope.modelos.push(modelo);
							});
					});
				}
			}
			else
				$scope.modelos = [];
		}
		else
		{
			$scope.marcas = [];
			$.each($scope.subgrupo.marcas, (j, o) => {
				var ob = {};
				ob.id = o.id;
				ob.marca = o.marca;
				ob.modelos = o.modelos.filter(modf => modf.subgrupo_id == $scope.project.subgrupo_id);

				if($scope.marcas.length == 0)
				{
					if(ob.modelos.length > 0)
						$scope.marcas.push(ob);
				}
				else {
					let c = $.grep($scope.marcas, mx => mx.marca == ob.marca); // buscar que no exista
					if(c.length == 0)
						if(ob.modelos.length > 0)
							$scope.marcas.push(ob);
				}
			});
			$scope.modelos = [];
			if($scope.marcas && $scope.marcas.length > 0)
			$.each($scope.marcas, (i, marca) => {
				// buscar todos los modelos de todas las marcas, solo para este subgrupo, o de la marca seleccionada y de ese grupo
				if($scope.project.marca_id)
				{
					if(marca.id == $scope.project.marca_id && marca.modelos && marca.modelos.length > 0)
						$.each(marca.modelos, (l, modelo) => {
							if(modelo.subgrupo_id == $scope.subgrupo.id)
								$scope.modelos.push(modelo);
						});
				}
				else
				{
					$.each(marca.modelos, (l, modelo) => {
						if(modelo.subgrupo_id == $scope.subgrupo.id)
							$scope.modelos.push(modelo);
					});
				}
			});
		}

		refreshCaracteristicas();

		if($scope.marcas.length == 1)
			$scope.project.marca_id = $scope.marcas[0].id
		if($scope.modelos.length == 1)
		{
			$scope.project.modelo = JSON.stringify($scope.modelos[0]);
			$scope.project.modelo_id = $scope.modelos[0].id;
			$scope.project.caracteristica_id = $scope.modelos[0].caracteristica.id;
		}
		
		if($scope.ttimes < 2)
		{
			$scope.ttimes++;
			if($scope.ttimes > 1)
				$scope.firstTime = false;
		}
		$scope.projectForm.$setPristine();
		$scope.projectForm.$setUntouched();
  	};
  	var setMarcas = (subgrupo, marca) => {
  		// si tiene subgrupo pone solo marcas con modelos de ese subgrupo
  		// si tiene subgrupo filtra los modelos
  		// si no tiene subgrupo le pone todos los modelos de la marca
  		// actualiza modelos
  		// refesh caracteristicas;
  		// si tiene marca filtrar solo modelos de esa marcaa
  		if(subgrupo || marca)
  		{
  			// tiene subgrupo o marca
  			if(!$scope.project.subgrupo || ($scope.project.subgrupo && $scope.project.subgrupo.id != subgrupo))
  			{
  			// tenia puesto el subgrupo
  				$scope.project.subgrupo_id = subgrupo;
  				$scope.subgrupo = $.grep($scope.subgrupos, s => s.id == subgrupo)[0];
				subgrupo = $scope.subgrupo;

				$scope.marcas = [];
  				$scope.modelos = [];
  				if(subgrupo)
  				{
  					// tiene subgrupo
  					if(subgrupo.marcas && subgrupo.marcas.length > 0)
						$.each(subgrupo.marcas, (j, o) => {
							var ob = {};
							ob.id = o.id;
							ob.marca = o.marca;
							
							if(marca)
							{
								// tiene subgrupo y marca
								if(o.id == marca)
								{
									ob.modelos = o.modelos.filter(modf => (modf.subgrupo_id == subgrupo.id) && (modf.marca_id == marca));
									if(ob.modelos && ob.modelos.length > 0)
										$.each(ob.modelos, (k,oo) => $scope.modelos.push(oo));
								}						
								if($scope.marcas.length == 0)				
									$scope.marcas.push(ob);
								else {
									let c = $.grep($scope.marcas, mx => mx.marca == ob.marca); // buscar que no exista
									if(c.length == 0)
										$scope.marcas.push(ob);
								}
							}
							else
							{
								// tiene solo subgrupo
								ob.modelos = o.modelos.filter(mdl => mdl.subgrupo_id == subgrupo.id);

								if(o.modelos && o.modelos.length > 0)
									$.each(o.modelos, (l, modelo) => $scope.modelos.push(modelo));

								if($scope.marcas.length == 0)
								{
									if(o.modelos.length > 0)
										$scope.marcas.push(ob);
								}
								else {
									let c = $.grep($scope.marcas, mx => mx.marca == ob.marca);
									if(c.length == 0)
										if(o.modelos.length > 0)
											$scope.marcas.push(ob);
								}
							}
						});
  				}
  				else
  				{
  					// tiene solo marca
					$.each($scope.subgrupos, (i, subgrupo) => {
						if(subgrupo.marcas && subgrupo.marcas.length > 0)
						$.each(subgrupo.marcas, (j, o) => {
							var ob = {};
							ob.id = o.id;
							ob.marca = o.marca;
							
							if(marca)
							{
								if(o.id == marca)
								{
									ob.modelos = o.modelos.filter(modf => modf.marca_id == marca);
									if(ob.modelos && ob.modelos.length > 0)
									{
										$.each(ob.modelos, (k,oo) => {
											$scope.modelos.push(oo);
										});
									}
								}						
								if($scope.marcas.length == 0)				
									$scope.marcas.push(ob);
								else {
									let c = $.grep($scope.marcas, mx => mx.marca == ob.marca); // buscar que no exista
									if(c.length == 0)
										$scope.marcas.push(ob);
								}
							}
						});
					});
				}
  			}
  			else
  			{
  				// si tenia puesto el subgrupo
				$scope.marcas = [];
  				$scope.modelos = [];
				if(subgrupo.marcas && subgrupo.marcas.length > 0)
				{
					$.each(subgrupo.marcas, (j, o) => {
						var ob = {};
						ob.id = o.id;
						ob.marca = o.marca;
						
						if(marca)
						{
							// tiene subgrupo y marca
							if(o.id == marca)
							{
								ob.modelos = o.modelos.filter(modf => (modf.subgrupo_id == subgrupo) && (modf.marca_id == marca));
								if(ob.modelos && ob.modelos.length > 0)
									$.each(ob.modelos, (k,oo) => $scope.modelos.push(oo));
							}						
							if($scope.marcas.length == 0)				
								$scope.marcas.push(ob);
							else {
								let c = $.grep($scope.marcas, mx => mx.marca == ob.marca); // buscar que no exista
								if(c.length == 0)
									$scope.marcas.push(ob);
							}
						}
						else
						{
							// tiene solo subgrupo
							ob.modelos = o.modelos.filter(mdl => mdl.subgrupo_id == subgrupo);

							if(o.modelos && o.modelos.length > 0)
								$.each(o.modelos, (l, modelo) => $scope.modelos.push(modelo));

							if($scope.marcas.length == 0)
							{
								if(o.modelos.length > 0)
									$scope.marcas.push(ob);
							}
							else {
								let c = $.grep($scope.marcas, mx => mx.marca == ob.marca);
								if(c.length == 0)
									if(o.modelos.length > 0)
										$scope.marcas.push(ob);
							}
						}
					});
				}
			}
  		}
  		else
		{
			// ni subgrupo ni marca
			$scope.marcas = [];
			$scope.modelos = [];
			$.each($scope.subgrupos, (i, subgrupo) => {
				if(subgrupo.marcas && subgrupo.marcas.length > 0)
					$.each(subgrupo.marcas, (j, o) => {
						var ob = {};
						ob.id = o.id;
						ob.marca = o.marca;
						ob.modelos = o.modelos;

						if(o.modelos && o.modelos.length > 0)
							$.each(o.modelos, (l, modelo) => $scope.modelos.push(modelo));

						if($scope.marcas.length == 0)
						{
							if(o.modelos.length > 0)
								$scope.marcas.push(ob);
						}
						else {
							let c = $.grep($scope.marcas, mx => mx.marca == ob.marca);
							if(c.length == 0)
								if(o.modelos.length > 0)
									$scope.marcas.push(ob);
						}
					});
			});
		}
  		refreshCaracteristicas();
  	}
  	$scope.cambioMarca = () => {
  		// mostrar solo modelos de esta marca
  		// modelos de este subgrupo
  		// mostrar solo caracteristicas de modelos de esta marca y subgrupo
  		// delete($scope.project.subgrupo_id);// filtrar modelos para ese subgrupo
		delete($scope.project.modelo);
		delete($scope.project.modelo_id);
		delete($scope.project.caracteristica_id);
		if($scope.project.marca_id)
		{
			setMarcas($scope.project.subgrupo_id, $scope.project.marca_id);
			if($scope.modelos.length == 1)
			{
				if($scope.ttimes < 2)
				{
					$scope.ttimes++;
					if($scope.ttimes > 1)
						$scope.firstTime = false;
				}
				$scope.project.modelo = JSON.stringify($scope.modelos[0]);
				$scope.project.modelo_id = $scope.modelos[0].id;
				$scope.project.caracteristica_id = $scope.modelos[0].caracteristica.id;
				if(!$scope.project.subgrupo_id)
					$scope.project.subgrupo_id = $scope.modelos[0].subgrupo_id;
				setMarcas($scope.project.subgrupo_id, $scope.project.marca_id);
			}
		}
		else
			return;

		$scope.projectForm.$setPristine();
		$scope.projectForm.$setUntouched();
	};
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

	$scope.refreshbodyheight();
	
	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 550);

	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 700);
	
	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 900);

	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 1500);

	$scope.cambioMunicipio = () => {
		if(!$scope.project.municipio)
			return;
		$scope.project.municipio_id = JSON.parse($scope.project.municipio).id;
		if(!$scope.project.municipio_id)
			return;
		delete($scope.project.oficialia_id);
		delete($scope.project.responsable_id);
		var strSearch = $scope.project.municipio_id < 10 ? "0" + $scope.project.municipio_id: $scope.project.municipio_id;
		$scope.oficialias = $scope.oficialias_bk.filter(ofs => ofs.id.substr(0,2) == strSearch);
		$scope.projectForm.$setPristine();
		$scope.projectForm.$setUntouched();
	};
	$scope.cambioOficialia = () => {
		if(!$scope.project.oficialia_id)
			return;
		if($scope.project.municipio)
			var mun = JSON.parse($scope.project.municipio);
		var oficialia = $.grep($scope.oficialias_bk, o => o.id == $scope.project.oficialia_id)[0];

		if(oficialia.responsable && oficialia.responsable.id)
			$scope.project.responsable_id = oficialia.responsable.id;

		var municipio = $.grep($scope.municipios, mn => mn.id == oficialia.municipio_id)[0];
		if(!mun)
		{
			$scope.oficialias = $scope.oficialias_bk.filter(ofi => ofi.id.substr(0,2) == oficialia.id.substr(0,2));
			$scope.project.municipio = JSON.stringify(municipio);
			$scope.project.municipio_id = municipio.id;
		}
		else
			if(mun.id != municipio.id)
			{
				$scope.project.municipio = JSON.stringify(municipio);
				$scope.project.municipio_id = municipio.id;
			}
		$scope.projectForm.$setPristine();
		$scope.projectForm.$setUntouched();
	};
	$scope.cambioCaracteristica = () => {
		if(!$scope.project.caracteristica_id)
			return;
		
		var caract = $.grep($scope.caracteristicas, c => c.id == $scope.project.caracteristica_id)[0];
		if(!caract.multiple)
			var modelo = $.grep($scope.modelos, md => md.caracteristica_id == $scope.project.caracteristica_id)[0];
		else
		{
			

			{
				var mod = $.grep($scope.modelos, md => md.id == $scope.project.modelo_id)[0];
				var marca =  $.grep($scope.marcas, m => m.id == mod.marca_id)[0];
				if(mod.caracteristica_id != $scope.project.caracteristica_id)
				{
					$scope.project.modelo = null;
					$scope.project.modelo_id = null;
					$scope.projectForm.$setPristine();
					$scope.projectForm.$setUntouched();
				}
			}
			setMarcas($scope.project.subgrupo_id, $scope.project.marca_id);
		}


		if(modelo)
		{
			if($scope.project.modelo_id)
			{
				if($scope.project.modelo_id != modelo.id)
				{
					if($scope.firstTime)
					{
						$scope.project.modelo = JSON.stringify(modelo);
						$scope.project.modelo_id = modelo.id;
					}
					else
						$scope.project.modelo_id = modelo.id;
				}
			}
			var marca =  $.grep($scope.marcas, m => m.id == modelo.marca_id)[0];

			if($scope.project.marca_id)
			{
				if($scope.project.marca_id != marca.id)
					$scope.project.marca_id = marca.id;
			}
			else
				$scope.project.marca_id = marca.id;

			if($scope.project.subgrupo_id)
			{
				if($scope.project.subgrupo_id != modelo.subgrupo_id)
					$scope.project.subgrupo_id = modelo.subgrupo_id;
			}
			else
				$scope.project.subgrupo_id = modelo.subgrupo_id;
			setMarcas($scope.project.subgrupo_id, $scope.project.marca_id);
			// poner modelos que tengan el subgrupo de esta caracteristica
			$scope.project.modelo = JSON.stringify(modelo);
			$scope.project.modelo_id = modelo.id;
		}
	};
	$scope.cambioModelo = () => {
		if(!$scope.project.modelo_id && !$scope.project.modelo)
			return;
		if($scope.firstTime)
			$scope.project.modelo = JSON.stringify($.grep($scope.modelos, m => m.id == $scope.project.modelo_id)[0]);
		
		$scope.project.modelo_id =  JSON.parse($scope.project.modelo).id;
		if(!$scope.project.subgrupo_id)
			$scope.project.subgrupo_id = JSON.parse($scope.project.modelo).subgrupo_id;
		$scope.project.caracteristica_id = JSON.parse($scope.project.modelo).caracteristica.id;
		if(!$scope.project.marca_id)
		{
			let md = $.grep($scope.modelos, md => md.caracteristica_id == $scope.project.caracteristica_id)[0];
			$scope.project.marca_id = md.marca_id;
		}
		setMarcas($scope.project.subgrupo_id, $scope.project.marca_id);
	};

	$scope.guardar = () => {
		var frmObj = $scope.project;
		var obj = {};
		
		$scope.saveOrder = "";
		$scope.next = 0;

		if(!$scope.projectForm.$valid)
			return;

		if(frmObj.numero_inventario && frmObj.numero_inventario.length > 0)
			obj.numero_inventario = parseInt(frmObj.numero_inventario);
		else
			obj.numero_inventario = null;
		
		if(frmObj.numero_serie && frmObj.numero_serie.length > 0)
			obj.numero_serie = frmObj.numero_serie;
		else
			obj.numero_serie = null;

		if(frmObj.modelo_id)
			obj.modelo_id = parseInt(frmObj.modelo_id);

		if(frmObj.oficialia_id)
			obj.oficialia_id = frmObj.oficialia_id;
		
		if(frmObj.area_id)
			obj.area_id = parseInt(frmObj.area_id);

		if(frmObj.responsable_id != undefined) // 6
			obj.responsable_id = parseInt(frmObj.responsable_id);

		if($scope.editOnly)
			obj.id = JSON.parse(sessionStorage.articulo).id;

		obj.status = frmObj.status? frmObj.status : false;
		obj.fecha_baja = null;
		saver(obj);
	}

	var saver = obj => {
		let getUrl = window.location;
		let baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
		let urlval = baseUrl;
		
		urlval += "api/inventario?numero_inventario=" + obj.numero_inventario;
		urlval += "&numero_serie=" + obj.numero_serie;
		if($scope.editOnly)
			urlval += "&id=" + obj.id;

		API.oneUrl('validador', urlval).get()
		.then(tn =>{
			let a = tn.plain();
			let x = a.response;
			if(x == 0)
			{
				let data = angular.copy(obj);
				API.all('inventario').post({data}).then(ad => {
					AlertService.show("Listo!","El Artículo se ha guardado en inventario");
					
					$scope.project.numero_serie = null;
					$scope.project.numero_inventario = null;
					if(!$scope.project.keefForm)
					{
						//limpiar formulario
						$scope.project.area_id = null;						
						$scope.project.caracteristica_id = null;
						$scope.project.descripcion_id = null;
						$scope.project.fecha_baja = null;
						$scope.project.grupo_id = null;
						$scope.project.subgrupo_id = null;
						$scope.project.municipio = null;
						$scope.project.municipio_id = null;
						$scope.project.marca_id = null;
						$scope.project.modelo_id = null;
						$scope.project.modelo = null;
						$scope.project.municipio_id = null;
						$scope.project.oficialia_id = null;
						$scope.project.responsable_id = null;
						delete($scope.subgrupos);
						delete($scope.modelos);
						delete($scope.marcas);
						delete($scope.caracteristicas);
					}
					$scope.projectForm.$setPristine();
					$scope.projectForm.$setUntouched();
					if(sessionStorage.getItem('articulo'))
					{
						sessionStorage.removeItem('articulo');
						window.location = "#/inventario";
					}
				});
			}
			else if(x == 1)
				AlertService.error("El Número de inventario ya existe en el sistema, ingrese otro número");
			else if(x == 2)
				AlertService.error("El Número de serie ya existe en el sistema, ingrese otro número");
			else
				AlertService.error("El Número de inventario y El Número de serie proporcionados ya existen en el sistema, ingrese otros números");
		});
	};
}]);