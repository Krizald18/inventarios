'use strict';
angular.module('App')
	.controller('ResguardoCtrl', function ($scope, $timeout, $q, API, AlertService, $http) {
	    // list of `state` value/display objects
	    $scope.selected2 = [];
	    $scope.sinResguardo = false;
	    $scope.selectedItem  = null;
	    $scope.searchText    = null;
	    $scope.querySearch   = querySearch;
	    $scope.showing = null;
	    $scope.myStyle = {
	    	'height': '650px',
	    	'min-height': '650px'
	    }
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
		$scope.crearResguardo =  function() {
			var obj = angular.copy($scope.selected2);
			if(!obj || (obj && obj.length == 0))
				return;
			console.log($scope.selected2);
			let articulos = $scope.selected2.map(function(obj){
				return obj.id;
			});
			let data = {};
			data.articulos = articulos;
			data.responsable_id = $scope.showing.id;
			console.log(data);
			API.all('resguardo').post({data}).then(ad => {
				$scope.showing.articulos_asignados = $scope.showing.articulos_asignados.filter(function(o){
					return $.grep($scope.selected2, function(p){
						return o.id == p.id;
					}).length == 0;
				});
				$scope.selected2 = [];
				$scope.showing = ad.plain();
				if($scope.showing.resguardos.length == 0)
				{
					$scope.showing.con_resguardo = [];
					$scope.showing.sin_resguardo = $scope.showing.articulos_asignados;
				}
				else	
				{
					$scope.showing.sin_resguardo = $scope.showing.articulos_asignados.filter(function(a){
						return !articuloConResguardo(a, $scope.showing.resguardos);
					});
					$scope.showing.con_resguardo = $scope.showing.articulos_asignados.filter(function(a){
						return articuloConResguardo(a, $scope.showing.resguardos);
					});
				}
				
				$scope.sinResguardo = ($scope.showing.sin_resguardo.length == 0);
				AlertService.show("Guardado","Resguardo creado");
				API.all("responsable").getList().then(res => {
			     	$scope.responsables = res.plain();
			    });
			});
		}
		var articuloConResguardo = function(a, x){
			var b = false;			
			$.each(x, function(j, r){
				$.each(r.articulos, function(i,articulo){
					if(a.id == articulo.id)
					{
						b = true;
						return false;
					}
				});
			});			
			return b;
		}
	    $scope.$watch('selectedItem', function(s){
	    	if(s)
	    	{
	    		$scope.showing = angular.copy(s);
	    		if($scope.showing.resguardos.length == 0)
				{
					$scope.showing.con_resguardo = [];
					$scope.showing.sin_resguardo = $scope.showing.articulos_asignados;
				}
				else	
				{
					$scope.showing.sin_resguardo = $scope.showing.articulos_asignados.filter(function(a){
						return !articuloConResguardo(a, $scope.showing.resguardos);
					});
					$scope.showing.con_resguardo = $scope.showing.articulos_asignados.filter(function(a){
						return articuloConResguardo(a, $scope.showing.resguardos);
					});
				}
				$scope.sinResguardo = ($scope.showing.sin_resguardo.length == 0);
	    		var heightCl = s.articulos_asignados.length > s.resguardos.length? s.articulos_asignados.length * 105: s.resguardos.length * 105;
				$scope.myStyle = {
			    	'height': heightCl + 'px',
			    	'min-height': heightCl + 'px'
				};
	    		$scope.selectedItem = null;
	    		$scope.refreshbodyheight();
	    	}
	    })
	    API.all("responsable").getList().then(res => {
	     	$scope.responsables = res.plain();
	    });
	    function querySearch (query) {
	      var results = query ? $scope.responsables.filter( createFilterFor(query) ) : $scope.responsables;
	      var deferred = $q.defer();
	      $timeout(function () { deferred.resolve( results ); }, Math.random() * 1000, false);
	      $scope.itemsfound = results;
	      return deferred.promise;
	    }
	    function createFilterFor(query) {
	      var lowercaseQuery = angular.uppercase(query);

	      return function filterFn(resp) {
	        return (resp.responsable.indexOf(lowercaseQuery) === 0);
	      };
	    }
	    $scope.generatePDF = function(respaldo){
	    	var dt = new Date();
    		var gd = dt.getDate();
    		var gm = dt.getMonth() + 1;
			let dy = gd < 10? '0' + gd : gd;
			let mn = gm < 10? '0' + gm : gm;
			var name = 'resguardo-' + (respaldo.id < 100? (respaldo.id < 10? '00' + respaldo.id: '0' + respaldo.id) : respaldo.id);
			name += dy + mn + dt.getFullYear() + '.pdf';
	    	let articulos = respaldo.articulos.map(function(o) {
	    		let obj = {};
	    		obj.numero_inventario = o.numero_inventario;
	    		obj.numero_serie = o.numero_serie;
	    		obj.articulo = o.modelo.subgrupo.subgrupo + ' ' + o.modelo.marca.marca + ' ' + o.modelo.modelo;
	    		return obj;
	    	});
    		let pdf_data = {};
    		pdf_data.id = respaldo.id;
    		pdf_data.oficial = $scope.showing.responsable;
    		pdf_data.oficialia = $scope.showing.oficialia && $scope.showing.oficialia.oficialia? $scope.showing.oficialia.oficialia: null;
    		pdf_data.municipio = $scope.showing.oficialia && $scope.showing.oficialia.municipio? $scope.showing.oficialia.municipio.municipio: null;
    		pdf_data.articulos = articulos;
    		API.all('resguardo').post({pdf_data}).then(pdfEncoded =>{
				downloadURI("data:application/pdf;base64," + pdfEncoded, name);
    		});

	    }
	    function downloadURI(uri, name) {
		  var link = document.createElement("a");
		  link.download = name;
		  link.href = uri;
		  document.body.appendChild(link);
		  link.click();
		  document.body.removeChild(link);
		}
	});