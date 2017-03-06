'use strict';
angular.module('App').controller('AgregarCtrl', function (API, $scope) {	
	$scope.selected = [];
	$scope.localidades =  [];
	$scope.loading = true;
	$scope.project = {};
	$scope.project.fecha_baja = new Date();
	$scope.project.keefForm = true;
  	$scope.isOpen = false;

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
		console.log($scope.project);
	}
});