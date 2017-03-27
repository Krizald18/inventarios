'use strict';
angular.module('App')
	.controller('ResguardoCtrl', function ($scope, $mdDialog, $timeout, $window, $q, API, FileUploader, AlertService) {
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
	    $scope.$watch('showing', val => {
	    	if(val && val.id == 244)
	    		$scope.sinResguardo = false;
	    	else
	    	{
	    		$scope.selected2 = [];
	    		setTimeout(() => {
					$scope.sinResguardo = (!($scope.showing && $scope.showing.sin_resguardo && $scope.showing.sin_resguardo.length > 0));
	    		}, 600);
	    	}
	    })
	    $scope.millisec = (date_str) => new Date(date_str).getTime();
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
		$scope.crearResguardo =  () => {
			var obj = angular.copy($scope.selected2);
			if(!obj || (obj && obj.length == 0))
				return;
			let articulos = $scope.selected2.map(obj => obj.id);
			let data = {};
			data.articulos = articulos;
			data.responsable_id = $scope.showing.id;
			API.all('resguardo').post({data}).then(ad => {
				$scope.showing.articulos_asignados = $scope.showing.articulos_asignados.filter(o => $.grep($scope.selected2, p => o.id == p.id).length == 0);
				$scope.selected2 = [];
				$scope.showing = ad.plain();
				if($scope.showing.resguardos.length == 0)
				{
					$scope.showing.con_resguardo = [];
					$scope.showing.sin_resguardo = $scope.showing.articulos_asignados;
				}
				else	
				{
					$scope.showing.sin_resguardo = $scope.showing.articulos_asignados.filter(a => !articuloConResguardo(a));
					$scope.showing.con_resguardo = $scope.showing.articulos_asignados.filter(a => articuloConResguardo(a));
				}
				
				$scope.sinResguardo = ($scope.showing.sin_resguardo.length == 0);
				AlertService.show("Guardado","Resguardo creado");
				API.all("responsable").getList().then(res => $scope.responsables = res.plain());
			});
		}
		var articuloConResguardo = a => {
			var b = false;
			let x = $scope.showing.resguardos;
			$.each(x, (j, r) => {
				$.each(r.articulos, (i,articulo) => {
					if(a.id == articulo.id)
					{
						b = true;
						return false;
					}
				});
				if(b)
					return false;
			});			
			return b;
		}
	    $scope.$watch('selectedItem', s => {
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
					$scope.showing.sin_resguardo = $scope.showing.articulos_asignados.filter(a => !articuloConResguardo(a));
					$scope.showing.con_resguardo = $scope.showing.articulos_asignados.filter(a => articuloConResguardo(a));
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
	    API.all("responsable").getList().then(res => $scope.responsables = res.plain());
	    function querySearch(query) {
	      var results = query ? $scope.responsables.filter( createFilterFor(query) ) : $scope.responsables;
	      var deferred = $q.defer();
	      $timeout(() => { deferred.resolve( results ); }, Math.random() * 1000, false);
	      $scope.itemsfound = results;
	      return deferred.promise;
	    }
	    var createFilterFor = query =>{
	      var lowercaseQuery = angular.uppercase(query);
	      return resp => resp.responsable.indexOf(lowercaseQuery) === 0;
	    }
	    $scope.generatePDF = resguardo => {
	    	let dt = new Date();
			var name = 'RE-' + dt.getFullYear() + (resguardo.id < 100? (resguardo.id < 10? '00' + resguardo.id: '0' + resguardo.id) : resguardo.id) + '.pdf';
	    	let articulos = resguardo.articulos.map(o => {
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
					let resguardo = $.grep($scope.showing.resguardos, r => r.id == res.id)[0];
					resguardo.pdf_generado = res.pdf_generado;
					resguardo.pdf_firmado = res.pdf_firmado;
				});
    		});

	    }
	    $scope.uploadPDF = (ev, resguardo) => {
	    	if(!resguardo)
	    		return;
	    	var id  = resguardo.id;
		    $mdDialog.show({
		      controller: DialogController,
		      templateUrl: 'angular/modals/subir_resguardo.html',
		      parent: angular.element(document.body),
		      targetEvent: ev,
		      clickOutsideToClose:true,
		      fullscreen: true // Only for -xs, -sm breakpoints.
		    })
		    .then(files => {
	    		var dt = new Date();
				var uri = 'resguardos_firmados/RE-' + dt.getFullYear() + (id < 100? (id < 10? '00' + id: '0' + id) : id);
		    	var token = $window.localStorage.satellizer_token;
		    	$scope.uploader = new FileUploader({
		            headers: {
		                'Authorization': "Bearer " + token
		            },
		            url: 'api/uploader/' + id,
		            alias: 'file'
		        });
		       	if(files && files.length > 0)
		       	{
		       		$.each(files, (i, o) => {
		       			if(o.lfFile.type == "application/pdf")
		       			{
			       			var pdf = new FileUploader.FileItem($scope.uploader, o.lfFile);
							pdf.progress = 100;
							pdf.isUploaded = true;
							pdf.isSuccess = true;
							$scope.uploader.queue.push(pdf);
						}
		       		});
		       		if($scope.uploader.queue.length > 1)
		       			localStorage.multiple_upload = true;
					$scope.uploader.queue.forEach((item, i) => {
		                item.formData.push({
		                    'uri': uri,
		                    'name': item.file.name,
		                    'tipo_archivo':'resguardo_firmado'
		                });
		                item.upload();
		                setTimeout(() => {
							if(item.isUploading)
							{
								setTimeout(() => {
									if(item.isUploading)
									{
										setTimeout(() => {
											if(item.isUploading)
											{
												setTimeout(() => {
													if(item.isUploading)
													{
														setTimeout(() => {
															if(item.isUploading)
															{
																setTimeout(() => {
																	if(item.isUploading)
																	{
																		setTimeout(() => {
																			if(item.isUploading)
																			{
																				setTimeout(() => {
																					if(item.isUploading)
																					{
																						setTimeout(() => {
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
		    });
	    }
	    $scope.downloadSigned = resg => {
	    	if(!resg)
	    		return;
	    	localStorage.resguardo_id = resg.id;
			$mdDialog.show({
				controller: BajarEvidenciasController,
				templateUrl: 'angular/modals/bajar_resguardo.html',
				parent: angular.element(document.body),
				clickOutsideToClose: true,
				fullscreen: true // Only for -xs, -sm breakpoints.
		    }).then(rs => {}, res => {
		    	// handle cancel from mdDialog (salir)
		    	if(res)
		    		resg.pdf_firmado = res.pdf_firmado;
		    });
	    }
	    var done = id => {
	    	API.one('resguardo', id).get()
	    	.then(res => {
	    		let resguardo = $.grep($scope.showing.resguardos, r => r.id == res.id)[0];
				resguardo.pdf_firmado = res.pdf_firmado;
				resguardo.updated_at = res.updated_at;
				resguardo.evidencias = res.evidencias;
				let m = localStorage.multiple_upload;
				if(m)
					AlertService.show("Listo!", "Se han cargado los documentos");
				else
					AlertService.show("Listo!", "Se ha cargado el documento");
				if(localStorage.multiple_upload != undefined)
					localStorage.removeItem('multiple_upload');
	    	});
	    }
	    var downloadURI = (uri, name) => {
		  var link = document.createElement("a");
		  link.download = name;
		  link.href = uri;
		  document.body.appendChild(link);
		  link.click();
		  document.body.removeChild(link);
		}
		$scope.transferirArticulos = () => AlertService.show("Función no implementada", "Esta funcón sera habilitada proximamente...");
		var DialogController = ($scope, $mdDialog) => {
			$scope.changed = () => $scope.files01 = $scope.files01.filter(file => file.lfFile.type == "application/pdf");
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.answer = () => $mdDialog.hide($scope.files01);
		}
		var BajarEvidenciasController = ($scope, $mdDialog, API) => {
			let id = localStorage.resguardo_id;
			if(localStorage.resguardo_id)
				localStorage.removeItem('resguardo_id');
			API.one('resguardo', id).get()
	    	.then(res => $scope.evidencias = res.evidencias, () => { /* catch error */ });

			$scope.evidencias = [];
			$scope.seleccionados = [];

		    $scope.download = evidencia => {
		    	let data = {
		    		'type': 'resguardo'
		    	};
		    	API.one('downloader', evidencia.id).get(data).then(pdfEncoded => downloadURI("data:application/pdf;base64," + pdfEncoded, evidencia.file));
		    };
		    $scope.delete = evidencia => {
		    	if(!evidencia)
		    		return;
		    	$scope.seleccionados = [];
		    	API.one('uploader', evidencia.id).remove().then(res => {
		    		var resguardo = res.plain();
		    		$scope.evidencias = resguardo.evidencias;
		    		if(resguardo.evidencias.length == 0)
		    		{
		    			AlertService.show("Sin archivos", "Se han eliminado todos los archivos");
		    			$mdDialog.cancel(resguardo);
		    		}
	    		});
		    };
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.descargar = () => $.each($scope.seleccionados, (i, e) => $scope.download(e)); // descargar todos los seleccionados
		    $scope.eliminar = () => $.each(angular.copy($scope.seleccionados), (i, e) => $scope.delete(e)); // eliminar todos los seleccionados
		    $scope.downloadURI = (uri, name) => {
				var link = document.createElement("a");
				link.download = name;
				link.href = uri;
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			}
		}
	});