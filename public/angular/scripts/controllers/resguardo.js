'use strict';
angular.module('App')
	.controller('ResguardoCtrl', function ($scope, $timeout, $q, API, AlertService, $mdDialog, FileUploader, $window) {
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
	    $scope.generatePDF = function(resguardo){
	    	var dt = new Date();
    		var gd = dt.getDate();
    		var gm = dt.getMonth() + 1;
			let dy = gd < 10? '0' + gd : gd;
			let mn = gm < 10? '0' + gm : gm;
			var name = 'RE-' + dt.getFullYear() + (resguardo.id < 100? (resguardo.id < 10? '00' + resguardo.id: '0' + resguardo.id) : resguardo.id) + '.pdf';
	    	let articulos = resguardo.articulos.map(function(o) {
	    		let obj = {};
	    		obj.id = o.id;
	    		obj.numero_inventario = o.numero_inventario;
	    		obj.numero_serie = o.numero_serie;
	    		obj.articulo = o.modelo.subgrupo.subgrupo + ' ' + o.modelo.marca.marca + ' ' + o.modelo.modelo;
	    		return obj;
	    	});
    		let pdf_data = {};
    		pdf_data.id = resguardo.id;
    		pdf_data.oficial = $scope.showing.responsable;
    		pdf_data.num_oficialia = $scope.showing.oficialia && $scope.showing.oficialia.id? $scope.showing.oficialia.id: null;
    		pdf_data.oficialia = $scope.showing.oficialia && $scope.showing.oficialia.oficialia? $scope.showing.oficialia.oficialia: null;
    		pdf_data.municipio = $scope.showing.oficialia && $scope.showing.oficialia.municipio? $scope.showing.oficialia.municipio.municipio: null;
    		pdf_data.articulos = articulos;
    		API.all('resguardo').post({pdf_data}).then(pdfEncoded =>{
				downloadURI("data:application/pdf;base64," + pdfEncoded, name);
				API.one('resguardo', resguardo.id).get()
				.then( res => {
					let resguardo = $.grep($scope.showing.resguardos, function(r){
						return r.id == res.id;
					})[0];
					resguardo.pdf_generado = res.pdf_generado;
					resguardo.pdf_firmado = res.pdf_firmado;
				});
    		});

	    }
	    $scope.uploadPDF = function(ev, id){
	    	if(!id)
	    		return;
		    $mdDialog.show({
		      controller: DialogController,
		      templateUrl: 'subir_resguardo.html',
		      parent: angular.element(document.body),
		      targetEvent: ev,
		      clickOutsideToClose:true,
		      fullscreen: true // Only for -xs, -sm breakpoints.
		    })
		    .then(function(files) {
		    	var token = $window.localStorage.satellizer_token;
		    	$scope.uploader = new FileUploader({
		            headers: {
		                'Authorization': "Bearer " + token
		            },
		            url: 'api/uploader/' + id,
		            alias: 'file'
		        });
		        $scope.uploader.filters.push({
		            name: 'imageFilter',
		            fn: function(item, options) {
		                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
		                return '|pdf|'.indexOf(type) !== -1;
		            }
		        });
		       	if(files && files.length > 0)
		       	{
		       		$.each(files, function(i, o){
		       			var pdf = new FileUploader.FileItem($scope.uploader, o.lfFile);
						pdf.progress = 100;
						pdf.isUploaded = true;
						pdf.isSuccess = true;
						$scope.uploader.queue.push(pdf);
		       		});
		       		$scope.uploader.queue.forEach(function(item, i) {
		                item.formData.push({
		                    'folder': 'resguardos_firmados'
		                });
		                item.upload();
		                setTimeout(function(){
							if(item.isUploading)
							{
								setTimeout(function(){
									if(item.isUploading)
									{
										setTimeout(function(){
											if(item.isUploading)
											{
												setTimeout(function(){
													if(item.isUploading)
													{
														setTimeout(function(){
															if(item.isUploading)
															{
																setTimeout(function(){
																	if(item.isUploading)
																	{
																		setTimeout(function(){
																			if(item.isUploading)
																			{
																				setTimeout(function(){
																					if(item.isUploading)
																					{
																						setTimeout(function(){
																							if(item.isUploading)
																							{
																								if(item.isUploading)
																									AlertService.error('Error al cargar archivo, se ha exedido el tiempo de espera, 5 seg.');
																								else if (i == $scope.uploader.queue.length - 1)
																									done(id);
																							}
																							else if (i == $scope.uploader.queue.length - 1)
																								done(id);
																						}, 4500);
																					}
																					else if (i == $scope.uploader.queue.length - 1)
																						done(id);
																				}, 3500);
																			}
																			else if (i == $scope.uploader.queue.length - 1)
																				done(id);
																		}, 2500);
																	}
																	else if (i == $scope.uploader.queue.length - 1)
																		done(id);
																}, 1500);
															}
															else if (i == $scope.uploader.queue.length - 1)
																done(id);
														}, 1000);
													}
													else if (i == $scope.uploader.queue.length - 1)
														done(id);
												}, 800);
											}
											else if (i == $scope.uploader.queue.length - 1)
												done(id);
										}, 600);
									}
									else if (i == $scope.uploader.queue.length - 1)
										done(id);
								}, 400);
							}
							else if (i == $scope.uploader.queue.length - 1)
								done(id);
						}, 200);
		            });
		       	}
		       	else
		       		console.log('no subir');
		    }, function() {
		      	console.log('no subir');
		    });
	    }
	    $scope.downloadSigned = function(resguardo){
	    	let data = {
	    		'folder': 'resguardos_firmados'
	    	};
	    	API.one('downloader', resguardo.id).get(data).then(pdfEncoded =>{
	    		let dt = new Date();
	    		let rid = resguardo.id < 100? (resguardo.id < 10? '00' + resguardo.id: '0' + resguardo.id) : resguardo.id;
				downloadURI("data:application/pdf;base64," + pdfEncoded, 'RE-' + dt.getFullYear() + rid + '.pdf');
    		});
	    }
	    var done = function(id){
	    	API.one('resguardo', id).get()
	    	.then(res =>{
	    		let resguardo = $.grep($scope.showing.resguardos, function(r){
					return r.id == res.id;
				})[0];
				resguardo.pdf_firmado = res.pdf_firmado;
				resguardo.updated_at = res.updated_at;
				AlertService.show("Listo!", "Se ha cargado el documento");
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

		function DialogController($scope, $mdDialog) {
		    $scope.hide = function() {
		      	$mdDialog.hide();
		    };

		    $scope.cancel = function() {
		      	$mdDialog.cancel();
		    };

		    $scope.answer = function() {
		      	$mdDialog.hide($scope.files01);
		    };
		}
	});