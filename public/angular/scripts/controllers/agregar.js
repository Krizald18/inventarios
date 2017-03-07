'use strict';
angular.module('App').controller('AgregarCtrl', function (API, $scope, AlertService, ToastService) {	
	$scope.selected = [];
	$scope.localidades =  [];
	$scope.loading = true;
	$scope.project = {};
	$scope.project.fecha_baja = new Date();
	$scope.project.keefForm = true;
  	$scope.isOpen = false;
  	$scope.saveOrder = "";
  	$scope.next = 0;

  	$scope.$watch('project.nuevo_tipo', function(val){
  		if(val != undefined && val.toUpperCase() == "ZZZ")
  		{
  			$scope.project.tipo_id = null;
  			$scope.project.nuevo_tipo = "";
  		}
  	});
  	$scope.$watch('project.descripcion_nueva', function(val){
  		if(val != undefined && val.toUpperCase() == "ZZZ")
  		{
  			$scope.project.descripcion_id = null;
  			$scope.project.descripcion_nueva = "";
  		}
  	});
  	$scope.$watch('project.caracteristica_nueva', function(val){
  		if(val != undefined && val.toUpperCase() == "ZZZ")
  		{
  			$scope.project.caracteristica_id = null;
  			$scope.project.caracteristica_nueva = "";
  		}
  	});
  	$scope.$watch('project.marca', function(val){
  		if(val != undefined && val.toUpperCase() == "ZZZ")
  		{
  			$scope.project.marca_id = null;
  			$scope.project.marca = "";
  		}
  	});
  	$scope.$watch('project.modelo', function(val){
  		if(val != undefined && val.toUpperCase() == "ZZZ")
  		{
  			$scope.project.modelo_id = null;
  			$scope.project.modelo = "";
  		}
  	});
  	$scope.$watch('project.nueva_area', function(val){
  		if(val != undefined && val.toUpperCase() == "ZZZ")
  		{
  			$scope.project.area_id = null;
  			$scope.project.nueva_area = "";
  		}
  	});
  	$scope.$watch('project.nuevo_responsable', function(val){
  		if(val != undefined && val.toUpperCase() == "ZZZ")
  		{
  			$scope.project.responsable_id = null;
  			$scope.project.nuevo_responsable = "";
  		}
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

	$scope.serie_o_numeronventario = function(){
		if(($scope.project.numero_inventario != undefined && $scope.project.numero_inventario.length > 0) || ($scope.project.numero_serie != undefined && $scope.project.numero_serie.length > 0))
			$scope.project.cantidad = 1;
		else
			delete($scope.project.cantidad);
	}
	$scope.refreshbodyheight();
	
	setTimeout(function(){
		$scope.refreshbodyheight();
	}, 550);

	setTimeout(function(){
		$scope.refreshbodyheight();
	}, 700);
	
	setTimeout(function(){
		$scope.refreshbodyheight();
	}, 900);

	API.all("grupo").getList().then(grp => {
		$scope.grupos = grp.plain();
		if($scope.grupos.length == 1)
			$scope.project.grupo_id = $scope.grupos[0].id;
	});

	$scope.tipos = API.all("tipo").getList().$object;
	$scope.marcas = API.all("marca").getList().$object;
	$scope.modelos = API.all("modelo").getList().$object;
	$scope.descripciones = API.all("descripcion").getList().$object;
	$scope.caracteristicas = API.all("caracteristica").getList().$object;
	$scope.oficialias = API.all("oficialia").getList().$object;
	$scope.municipios = API.all("municipio").getList().$object;
	$scope.areas = API.all("area").getList().$object;
	$scope.responsables = API.all("responsable").getList().$object;

 	var rs = function(response){
		$scope.localidades = response.data.data;
	}

	$scope.buscarLocalidades = function(sr){
		if(sr == undefined || (sr != undefined && (sr.search == undefined || sr.length == 0)) )
			return;
		var loc = sr.search;
		if($scope.project.municipio_fisico_id != undefined && loc.length > 0)		
			API.all("localidad?municipio="+$scope.project.municipio_fisico_id+"&search="+loc).getList().then(rs).catch(rs);		
		else
			$scope.localidades =  [];
	}
	$scope.guardar = function(){
		//console.log();
		var frmObj = $scope.project;
		var obj = {};
		
		$scope.saveOrder = "";
		$scope.next = 0;

		if(frmObj.numero_inventario != undefined && frmObj.numero_inventario.length > 0)
			obj.numero_inventario = frmObj.numero_inventario;	
		else
		{
			obj.numero_inventario = null;
			obj.cantidad = 1;
		}
		
		if(frmObj.numero_serie != undefined && frmObj.numero_serie.length > 0)
			obj.numero_serie = frmObj.numero_serie			
		else
		{
			obj.numero_serie = null;
			obj.cantidad = 1;
		}

		if(obj.numero_inventario == null && obj.numero_serie == null)
		{
			if(frmObj.cantidad != undefined)
				obj.cantidad = parseInt(frmObj.cantidad);
			else
			{
				AlertService.error("El campo Cantidad es requerido");
				return;
			}
		}
		
		if(frmObj.tipo_id != undefined) // 0
		{
			if(frmObj.tipo_id == 0)
			{
				$scope.saveOrder += "0";
				obj.fecha_baja = null;
			}
			else
			{
				obj.tipo_id = parseInt(frmObj.tipo_id);
				if(obj.tipo_id == 2)
					obj.fecha_baja = frmObj.fecha_baja;
				else
					obj.fecha_baja = null;
				$scope.saveOrder += "x";
			}
		}
		else
		{
			$scope.saveOrder += "x";
			obj.tipo_id = null;
			obj.fecha_baja = null;
		}
		if(frmObj.descripcion_id == undefined) // 1
		{
			AlertService.error("El campo Descripción es requerido");
			return;	
		}
		else
		{
			if(frmObj.descripcion_id == 0)
				$scope.saveOrder += "0";
			else
			{
				obj.descripcion_id = parseInt(frmObj.descripcion_id);
				$scope.saveOrder += "x";
			}
		}
		if(frmObj.caracteristica_id != undefined) // 2
		{
			if(frmObj.caracteristica_id == 0)
				$scope.saveOrder += "0";
			else
			{
				obj.caracteristica_id = parseInt(frmObj.caracteristica_id);
				$scope.saveOrder += "x";
			}
		}
		else
		{
			$scope.saveOrder += "x";
			obj.caracteristica_id = null;
		}

		if(frmObj.marca_id != undefined) // 3
		{
			if(frmObj.marca_id == 0)
				$scope.saveOrder += "0";
			else
			{
				obj.marca_id = parseInt(frmObj.marca_id);
				$scope.saveOrder += "x";
			}
		}
		else
		{
			$scope.saveOrder += "x";
			obj.marca_id = null;
		}

		if(frmObj.modelo_id != undefined) // 4
		{
			if(frmObj.modelo_id == 0)
				$scope.saveOrder += "0";
			else
			{
				obj.modelo_id = parseInt(frmObj.modelo_id);
				$scope.saveOrder += "x";
			}
		}
		else
		{
			$scope.saveOrder += "x";
			obj.modelo_id = null;
		}

		if(frmObj.oficialia_id != undefined)
			obj.oficialia_id = frmObj.oficialia_id;
		if(frmObj.municipio_id != undefined)
			obj.municipio_id = parseInt(frmObj.municipio_id);
		if(frmObj.municipio_fisico_id != undefined)
			obj.municipio_fisico_id = parseInt(frmObj.municipio_fisico_id);
		if(frmObj.localidad_fisica_id != undefined && frmObj.localidad_fisica_id.id != undefined)
			obj.localidad_fisica_id = parseInt(frmObj.localidad_fisica_id.id);
		if(frmObj.grupo_id != undefined)
			obj.grupo_id = parseInt(frmObj.grupo_id);
		
		if(frmObj.area_id != undefined) // 5
		{
			if(frmObj.area_id == 0)
				$scope.saveOrder += "0";
			else
			{
				obj.area_id = parseInt(frmObj.area_id);
				$scope.saveOrder += "x";
			}
		}
		else
		{
			$scope.saveOrder += "x";
			obj.area_id = null;
		}

		if(frmObj.responsable_id != undefined) // 6
		{
			if(frmObj.responsable_id == 0)
				$scope.saveOrder += "0";
			else
			{
				obj.responsable_id = parseInt(frmObj.responsable_id);
				$scope.saveOrder += "x";
			}
		}
		else
		{
			$scope.saveOrder += "x";
			obj.responsable_id = null;
		}
		saver(obj);
	}

	var saver = function(obj)
	{
		switch($scope.next) {
			case 0: // tipo
				if ($scope.saveOrder.charAt(0) == '0' && $scope.project.nuevo_tipo != undefined && $scope.project.nuevo_tipo.length > 0)
				{
					$scope.project.nuevo_tipo = $scope.project.nuevo_tipo.toUpperCase();
					let matches = $.grep($scope.tipos, function(tp){
						return tp.tipo.toUpperCase() == $scope.project.nuevo_tipo;
					});
					if(matches.length == 0)
					{
						API.all('tipo').post({data:{"tipo":$scope.project.nuevo_tipo}}).then(ad => {
							ToastService.show("Se ha guardado un Tipo nuevo");
							$scope.tipos = ad.plain();
							$scope.project.tipo_id = $.grep($scope.tipos, function(ob) {
								return ob.tipo.toUpperCase() == $scope.project.nuevo_tipo;
							})[0].id;
							obj.tipo_id = $scope.project.tipo_id;
							$scope.next++;
							saver(obj);
						});
					}
					else
					{
						AlertService.error('No se puede guardar el Tipo ingresado por que ya existe, seleccione un Tipo');
						delete($scope.project.tipo_id);
						delete($scope.project.nuevo_tipo);
						return
					}
				}
				else
				{
					if($scope.project.tipo_id == 0)
					{
						$scope.project.tipo_id = null;
						obj.tipo_id = null;
					}
					$scope.next++;
					saver(obj);
				}
			break
			case 1: // descripcion
				if ($scope.saveOrder.charAt(1) == '0' && $scope.project.descripcion_nueva != undefined && $scope.project.descripcion_nueva.length > 0)
				{
					$scope.project.descripcion_nueva = $scope.project.descripcion_nueva.toUpperCase();
					let matches = $.grep($scope.descripciones, function(tp){
						return tp.descripcion.toUpperCase() == $scope.project.descripcion_nueva;
					});
					if(matches.length == 0)
					{
						API.all('descripcion').post({data:{"descripcion":$scope.project.descripcion_nueva}}).then(ad => {
							ToastService.show("Se ha guardado una Descripción nueva");
							$scope.descripciones = ad.plain();
							$scope.project.descripcion_id = $.grep($scope.descripciones, function(ob) {
								return ob.descripcion.toUpperCase() == $scope.project.descripcion_nueva;
							})[0].id;
							obj.descripcion_id = $scope.project.descripcion_id;
							$scope.next++;
							saver(obj);
						});
					}
					else
					{
						AlertService.error('No se puede guardar la Descripción ingresada por que ya existe, seleccione una Descripción');
						delete($scope.project.descripcion_id);
						delete($scope.project.descripcion_nueva);
						return
					}
				}
				else
				{
					if($scope.project.descripcion_id == 0)
					{
						$scope.project.descripcion_id = null;
						obj.descripcion_id = null;
					}
					$scope.next++;
					saver(obj);
				}
			break;
			case 2: // caracteristica
				if ($scope.saveOrder.charAt(2) == '0' && $scope.project.caracteristica_nueva!= undefined && $scope.project.caracteristica_nueva.length > 0)
				{
					$scope.project.caracteristica_nueva = $scope.project.caracteristica_nueva.toUpperCase();
					let matches = $.grep($scope.caracteristicas, function(tp){
						return tp.caracteristica.toUpperCase() == $scope.project.caracteristica_nueva;
					});
					if(matches.length == 0)
					{
						API.all('caracteristica').post({data:{"caracteristica":$scope.project.caracteristica_nueva}}).then(ad => {
							ToastService.show("Se ha guardado una Caracteristica nueva");
							$scope.caracteristicas = ad.plain();
							$scope.project.caracteristica_id = $.grep($scope.caracteristicas, function(ob) {
								return ob.caracteristica.toUpperCase() == $scope.project.caracteristica_nueva;
							})[0].id;
							obj.caracteristica_id = $scope.project.caracteristica_id;
							$scope.next++;
							saver(obj);
						});
					}
					else
					{
						AlertService.error('No se puede guardar la Caracteristica ingresada por que ya existe, seleccione una Caracteristica');
						delete($scope.project.caracteristica_id);
						delete($scope.project.caracteristica_nueva);
						return
					}
				}
				else
				{
					if($scope.project.caracteristica_id == 0)
					{
						$scope.project.caracteristica_id = null;
						obj.caracteristica_id = null;
					}
					$scope.next++;
					saver(obj);
				}
			break;
			case 3: // marca
				if ($scope.saveOrder.charAt(3) == '0' && $scope.project.marca != undefined && $scope.project.marca.length > 0)
				{
					$scope.project.marca = $scope.project.marca.toUpperCase();
					let matches = $.grep($scope.marcas, function(tp){
						return tp.marca.toUpperCase() == $scope.project.marca;
					});
					if(matches.length == 0)
					{
						API.all('marca').post({data:{"marca":$scope.project.marca}}).then(ad => {
							ToastService.show("Se ha guardado una Marca nueva");
							$scope.marcas = ad.plain();
							$scope.project.marca_id = $.grep($scope.marcas, function(ob) {
								return ob.marca.toUpperCase() == $scope.project.marca;
							})[0].id;
							obj.marca_id = $scope.project.marca_id;
							$scope.next++;
							saver(obj);
						});
					}
					else
					{
						AlertService.error('No se puede guardar la Marca ingresada por que ya existe, seleccione una Marca');
						delete($scope.project.marca_id);
						delete($scope.project.marca);
						return
					}
				}
				else
				{
					if($scope.project.marca_id == 0)
					{
						$scope.project.marca_id = null;
						obj.marca_id = null;
					}
					$scope.next++;
					saver(obj);
				}
			break;
			case 4: // modelo
				if ($scope.saveOrder.charAt(4) == '0' && $scope.project.modelo !=undefined && $scope.project.modelo.length > 0)
				{
					$scope.project.modelo = $scope.project.modelo.toUpperCase();
					let matches = $.grep($scope.modelos, function(tp){
						return tp.modelo.toUpperCase() == $scope.project.modelo;
					});
					if(matches.length == 0)
					{
						API.all('modelo').post({data:{"modelo":$scope.project.modelo}}).then(ad => {
							ToastService.show("Se ha guardado una Modelo nueva");
							$scope.modelos = ad.plain();
							$scope.project.modelo_id = $.grep($scope.modelos, function(ob) {
								return ob.modelo.toUpperCase() == $scope.project.modelo;
							})[0].id;
							obj.modelo_id = $scope.project.modelo_id;
							$scope.next++;
							saver(obj);
						});
					}
					else
					{
						AlertService.error('No se puede guardar el Modelo ingresado por que ya existe, seleccione un Modelo');
						delete($scope.project.modelo_id);
						delete($scope.project.modelo);
						return
					}
				}
				else
				{
					if($scope.project.modelo_id == 0)
					{
						$scope.project.modelo_id = null;
						obj.modelo_id = null;
					}
					$scope.next++;
					saver(obj);
				}
			break;
			case 5: // area
				if ($scope.saveOrder.charAt(5) == '0' && $scope.project.nueva_area != undefined && $scope.project.nueva_area.length > 0)
				{
					$scope.project.nueva_area = $scope.project.nueva_area.toUpperCase();
					let matches = $.grep($scope.areas, function(tp){
						return tp.area.toUpperCase() == $scope.project.nueva_area;
					});
					if(matches.length == 0)
					{
						API.all('area').post({data:{"area":$scope.project.nueva_area}}).then(ad => {
							ToastService.show("Se ha guardado una Área nueva");
							$scope.areas = ad.plain();
							$scope.project.area_id = $.grep($scope.areas, function(ob) {
								return ob.area.toUpperCase() == $scope.project.nueva_area;
							})[0].id;
							obj.area_id = $scope.project.area_id;
							$scope.next++;
							saver(obj);
						});
					}
					else
					{						
						AlertService.error('No se puede guardar el Área ingresada por que ya existe, seleccione una Área');
						delete($scope.project.area_id);
						delete($scope.project.nueva_area);
						return
					}
				}
				else
				{
					if($scope.project.area_id == 0)
					{
						$scope.project.area_id = null;
						obj.area_id = null;
					}
					$scope.next++;
					saver(obj);
				}
			break;
			case 6: // responsable
				if ($scope.saveOrder.charAt(6) == '0' && $scope.project.nuevo_responsable != undefined && $scope.project.nuevo_responsable.length > 0)
				{
					$scope.project.nuevo_responsable = $scope.project.nuevo_responsable.toUpperCase();
					let matches = $.grep($scope.responsables, function(tp){
						return tp.responsable.toUpperCase() == $scope.project.nuevo_responsable;
					});
					if(matches.length == 0)
					{
						API.all('responsable').post({data:{"responsable":$scope.project.nuevo_responsable}}).then(ad => {
							ToastService.show("Se ha guardado un Responsable nuevo");
							$scope.responsables = ad.plain();
							$scope.project.responsable_id = $.grep($scope.responsables, function(ob) {
								return ob.responsable.toUpperCase() == $scope.project.nuevo_responsable;
							})[0].id;
							obj.responsable_id = $scope.project.responsable_id;
							$scope.next++;
							saver(obj);
						});
					}
					else
					{
						AlertService.error('No se puede guardar el Responsable ingresado por que ya existe, seleccione un Responsable');
						delete($scope.project.responsable_id);
						delete($scope.project.nuevo_responsable);
						return
					}
				}
				else
				{
					if($scope.project.responsable_id == 0)
					{
						$scope.project.responsable_id = null;
						obj.responsable_id = null;
					}
					$scope.next++;
					saver(obj);
				}
			break
			default:
			// verifica numero de serie y numero de inventario

				let getUrl = window.location;
				let baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
				let urlval = baseUrl;
				
				urlval += "api/inventario?numero_inventario=" + obj.numero_inventario;
				urlval += "&numero_serie=" + obj.numero_serie;

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
							if(! $scope.project.keefForm)
							{
								//limpiar formulario
								$scope.project.area_id = null;
								$scope.project.cantidad = null;
								$scope.project.caracteristica_id = null;
								$scope.project.descripcion_id = null;
								$scope.project.fecha_baja = null;
								$scope.project.grupo_id = null;
								$scope.project.marca_id = null;
								$scope.project.modelo_id = null;
								$scope.project.municipio_fisico_id = null;
								$scope.project.municipio_id = null;
								$scope.project.localidad_fisica_id = null;
								$scope.project.numero_inventario = null;
								$scope.project.numero_serie = null;
								$scope.project.oficialia_id = null;
								$scope.project.responsable_id = null;
								$scope.project.tipo_id = null;
							}
							$scope.projectForm.$setPristine();
							$scope.projectForm.$setUntouched();
						});
					}
					else if(x == 1)
						AlertService.error("El Número de inventario ya existe en el sistema, ingrese otro número");
					else if(x == 2)
						AlertService.error("El Número de serie ya existe en el sistema, ingrese otro número");
					else
						AlertService.error("El Número de inventario y El Número de serie proporcionados ya existen en el sistema, ingrese otros números");
				});
			break;
		}
	}
});