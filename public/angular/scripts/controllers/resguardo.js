'use strict';
angular.module('App')
	.controller('ResguardoCtrl', ['$scope', '$mdDialog', '$timeout', '$window', '$q', 'API', 'FileUploader', 'AlertService', 
		function($scope, $mdDialog, $timeout, $window, $q, API, FileUploader, AlertService) {
	    // list of `state` value/display objects
	    if (localStorage.admin_token)
    		$scope.admin = true;
	    $scope.selected2 = [];
	    $scope.selectedItem  = null;
	    $scope.searchText    = null;
	    $scope.querySearch   = querySearch;
	    $scope.showing = null;
	    $scope.myStyle = {
	    	'height': '650px',
	    	'min-height': '650px'
	    }
	    if (localStorage.admin_token)
	    	$scope.admin = true;

	    $scope.millisec = date_str => new Date(date_str).getTime();
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
		$scope.conResguardo = () => {
			return $scope.showing && $scope.showing.articulos && $scope.showing.articulos.filter(a => a.resguardo).length || 0;
		}
		$scope.crearResguardo =  () => {
			var obj = angular.copy($scope.selected2);
			if (!obj || (obj && obj.length == 0))
				return;
			let articulos = $scope.selected2.map(obj => obj.id);
			let data = {};
			data.articulos = articulos;
			data.responsable_id = $scope.showing.id;
			API.all('resguardo').post({data}).then(ad => {
				$scope.showing.articulos_asignados = $scope.showing.articulos_asignados.filter(o => $.grep($scope.selected2, p => o.id == p.id).length == 0);
				$scope.selected2 = [];
				$scope.showing = ad.plain();
		
				$scope.showing.articulos = $scope.showing.articulos_asignados.map(a => {
					a.resguardo = articuloConResguardo(a);
					return a;
				});

				AlertService.show("Guardado","Resguardo creado");
				API.all("responsable").getList().then(res => $scope.responsables = res.plain());
			});
		}
		var articuloConResguardo = a => {
			var b = false;
			let x = $scope.showing.resguardos;
			$.each(x, (j, r) => {
				$.each(r.articulos, (i,articulo) => {
					if (a.id == articulo.id)
					{
						b = true;
						return false;
					}
				});
				if (b)
					return false;
			});			
			return b;
		}
	    $scope.$watch('selectedItem', s => {
	    	if (s)
	    	{
					$scope.showing = angular.copy(s);

					$scope.showing.articulos = $scope.showing.articulos_asignados.map(a => {
						a.resguardo = articuloConResguardo(a);
						return a;
					});

						var heightCl = s.articulos_asignados.length > s.resguardos.length? s.articulos_asignados.length * 105: s.resguardos.length * 105;
					$scope.myStyle = {
							'height': heightCl + 'px',
							'min-height': heightCl + 'px'
					};
					if ($scope.selectedItem)
							$scope.selectedItem = null;
						
						var activeElement = document.getElementById('fl-input-1');

					if (activeElement) {
						activeElement.blur();
					}

	    		$scope.refreshbodyheight();
	    	}
	    })
	    API.all("responsable").getList().then(res => {
				$scope.responsables = res.plain();
	    	var re = sessionStorage.getItem('responsable_id');
			if (re)
			{
				$scope.showing = $.grep($scope.responsables, r => r.id == re)[0];

				$scope.showing.articulos = $scope.showing.articulos_asignados.map(a => {
					a.resguardo = articuloConResguardo(a);
					return a;
				});
				sessionStorage.removeItem('responsable_id');
			}
	    });
	    function querySearch(query) {
	      var results = query ? $scope.responsables.filter( createFilterFor(query) ) : $scope.responsables;
	      var deferred = $q.defer();
	      $timeout(() => { deferred.resolve( results ); }, Math.random() * 1000, false);
	      $scope.itemsfound = results;
	      return deferred.promise;
	    }
	    var createFilterFor = query => {
	      var lowercaseQuery = angular.uppercase(query);
	      return resp => resp.responsable.indexOf(lowercaseQuery) === 0 || (resp.oficialia_id && resp.oficialia_id.indexOf(lowercaseQuery) != -1);
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
	    		obj.caracteristicas = o.modelo.caracteristica.caracteristica;
	    		return obj;
	    	});
    		let pdf_data = {};
    		pdf_data.id = resguardo.id;
    		pdf_data.nota = resguardo.observaciones;
    		pdf_data.oficial = $scope.showing.responsable;
    		pdf_data.num_oficialia = $scope.showing.oficialia && $scope.showing.oficialia.id? $scope.showing.oficialia.id: null;
    		pdf_data.oficialia = $scope.showing.oficialia && $scope.showing.oficialia.oficialia? $scope.showing.oficialia.oficialia: null;
    		pdf_data.municipio = $scope.showing.oficialia && $scope.showing.oficialia.municipio? $scope.showing.oficialia.municipio.municipio: null;
    		pdf_data.articulos = articulos;
    		API.all('resguardo').post({pdf_data}).then(pdfEncoded => {
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
	    	if (!resguardo)
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
		       	if (files && files.length > 0)
		       	{
		       		$.each(files, (i, o) => {
		       			if (o.lfFile.type == "application/pdf")
		       			{
			       			var pdf = new FileUploader.FileItem($scope.uploader, o.lfFile);
							pdf.progress = 100;
							pdf.isUploaded = true;
							pdf.isSuccess = true;
							$scope.uploader.queue.push(pdf);
						}
		       		});
		       		if ($scope.uploader.queue.length > 1)
		       			localStorage.multiple_upload = true;
					$scope.uploader.queue.forEach((item, i) => {
		                item.formData.push({
		                    'uri': uri,
		                    'name': item.file.name,
		                    'tipo_archivo':'resguardo_firmado'
		                });
		                item.upload();
		                setTimeout(() => {
							if (item.isUploading)
							{
								setTimeout(() => {
									if (item.isUploading)
									{
										setTimeout(() => {
											if (item.isUploading)
											{
												setTimeout(() => {
													if (item.isUploading)
													{
														setTimeout(() => {
															if (item.isUploading)
															{
																setTimeout(() => {
																	if (item.isUploading)
																	{
																		setTimeout(() => {
																			if (item.isUploading)
																			{
																				setTimeout(() => {
																					if (item.isUploading)
																					{
																						setTimeout(() => {
																							if (item.isUploading)
																							{
																								if (item.isUploading)
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
	    	if (!resg)
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
		    	if (res)
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
				if (m)
					AlertService.show("Listo!", "Se han cargado los documentos");
				else
					AlertService.show("Listo!", "Se ha cargado el documento");
				if (localStorage.multiple_upload != undefined)
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
		$scope.transferirArticulos = () => {
			localStorage.articulos = JSON.stringify($scope.showing.articulos_asignados);
			$mdDialog.show({
		      controller: TransferirController,
		      templateUrl: 'angular/modals/transferis_articulos.html',
		      parent: angular.element(document.body),
		      clickOutsideToClose:true,
		      fullscreen: true // Only for -xs, -sm breakpoints.
		    })
		    .then(files_length => {
				API.all("responsable").getList().then(res => {
					$scope.responsables = res.plain();
					$scope.showing = $.grep($scope.responsables, rsp => rsp.id == $scope.showing.id)[0];
					$scope.showing.articulos = $scope.showing.articulos_asignados.map(a => {
						a.resguardo = articuloConResguardo(a);
						return a;
					});
					let s = angular.copy($scope.showing);
		    		var heightCl = s.articulos_asignados.length > s.resguardos.length? s.articulos_asignados.length * 105: s.resguardos.length * 105;
					$scope.myStyle = {
				    	'height': heightCl + 'px',
				    	'min-height': heightCl + 'px'
					};
		    		// $scope.selectedItem = null;
		    		$scope.refreshbodyheight();
		    		if (files_length)
		    		{
		    			if (files_length > 1)
		    				AlertService.show("Transferencia completa", "Se completó la transferencia de " + files_length + " artículos.");
		    			else if (files_length == 1)
		    				AlertService.show("Transferencia completa", "Se completó la transferencia del artículo.");
		    		}
				});
		    });
		}
		$scope.ponerNota = function(ev, resguardo) {
	    // Appending dialog to document.body to cover sidenav in docs app
	    	var obs_orig = resguardo.observaciones;
		    var confirm = $mdDialog.prompt()
		      .title('Nota')
		      .placeholder('Nota')
		      .ariaLabel('Nota')
		      .initialValue(resguardo.observaciones)
		      .clickOutsideToClose(true)
		      .targetEvent(null)
		      .parent(angular.element(document.body))
		      .ok('Guardar')
		      .cancel('Cancelar');

		    $mdDialog.show(confirm).then(function(result) {
		    	let data = {
		    		'id': resguardo.id,
		    		'set_note': true,
		    		'nota': result
		    	}
		    	resguardo.observaciones = result;
		      	API.all('resguardo').post({data:data})
		      		.then(response => resguardo = response);
		    }, function() {
		    	if (resguardo.observaciones != obs_orig)
		    		resguardo.observaciones = obs_orig;
		    });
		 };

		var DialogController = ($scope, $mdDialog) => {
			$scope.changed = () => $scope.files01 = $scope.files01.filter(file => file.lfFile.type == "application/pdf");
		    $scope.hide = () => $mdDialog.hide();
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.answer = () => $mdDialog.hide($scope.files01);
		}
		var TransferirController = ($scope, $mdDialog, API) => {
			if (localStorage.admin_token)
	    		$scope.admin = true;
			$scope.disableConfirm = false;
			API.all("responsable").getList().then(res => $scope.allresp = res.plain());
			$scope.confirmado = false;
			$scope.seleccionados = [];
			$scope.articulos = JSON.parse(localStorage.articulos);
			if (localStorage.articulos)
				localStorage.removeItem('articulos');
			$scope.back = () => {
				$scope.confirmado = false;
				$scope.disableConfirm = false;
			};
		    $scope.cancel = () => $mdDialog.cancel();
		    $scope.confirmar = () => {
		    	if (!$scope.confirmado)
		    	{
		    		$scope.responsables = $scope.allresp.filter(r => r.id != $scope.seleccionados[0].responsable_id);
					API.all("area").getList().then(res => $scope.areas_all = res.plain());
		    		$scope.confirmado = true;
		    		if ($scope.nuevo_responsable)
		    		{
		    			if ($scope.areas.length > 0)
		    			{
		    				if ($scope.area_id)
		    					$scope.disableConfirm = false;
		    				else
		    					$scope.disableConfirm = true;
		    			}
		    			else
		    				$scope.disableConfirm = false;
		    		}
		    		else
		    			$scope.disableConfirm = true;
		    	}
		    	else
		    	{
		    		$scope.frmTrans.$setSubmitted();
		    		if ($scope.nuevo_responsable && (($scope.areas.length > 0 && $scope.area_id) || $scope.areas.length == 0))
		    		{
		    			let data = {
		    				'articulos': $scope.seleccionados.map(s => s.id),
		    				'nuevo_responsable': $scope.nuevo_responsable,
		    				'area_id': $scope.area_id,
		    				'command': 'transfer'
		    			};
		    			API.all('responsable').post(data).then(ad => {
		    				if (localStorage.tiene_oficialia)
								localStorage.removeItem('tiene_oficialia');
	    					$mdDialog.hide($scope.seleccionados.length);
		    			});
		    		}
		    	}
		    }
		    $scope.$watch('nuevo_responsable', a => {
		    	if (a)
		    	{
		    		$scope.disableConfirm = false;
		    		let r = $.grep($scope.responsables, re => re.id == a)[0];
		    		if (r.oficialia_id)
		    		{
		    			localStorage.tiene_oficialia = true;
		    			$scope.areas = angular.copy($scope.areas_all);
		    		}
		    		else
		    		{
		    			if (localStorage.tiene_oficialia)
							localStorage.removeItem('tiene_oficialia');
		    			$scope.areas = [];	
		    		}
		    		$scope.area_id = null;
		    	}
		    	else
		    		$scope.areas = [];
		    });
		    $scope.$watch('area_id', a => {
		    	if ($scope.nuevo_responsable)
		    	{
		    		if (a)
		    			$scope.disableConfirm = false;
		    		else
		    		{
			    		if (localStorage.tiene_oficialia)
			    			$scope.disableConfirm = true;
			    		else
			    			$scope.disableConfirm = false;
			    	}
		    	}
		    });
		}
		var BajarEvidenciasController = ($scope, $mdDialog, API) => {
			$scope.millisec = date_str => new Date(date_str).getTime();
			if (localStorage.admin_token)
	    		$scope.admin = true;
			let id = localStorage.resguardo_id;
			if (localStorage.resguardo_id)
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
		    	if (!evidencia)
		    		return;
		    	$scope.seleccionados = [];
		    	let prot = {
		    		'user': localStorage.user,
		    		'admin_token' : localStorage.admin_token
		    	}
		    	API.one('uploader', evidencia.id).remove(prot)
		    	.then(res => {
		    		var resguardo = res.plain();
		    		$scope.evidencias = resguardo.evidencias;
		    		if (resguardo.evidencias.length == 0)
		    		{
		    			AlertService.show("Sin archivos", "Se han eliminado todos los archivos");
		    			$mdDialog.cancel(resguardo);
		    		}
	    		}).catch(err => {
	    			AlertService.show("Error interno", "Se ha producido un error de autenticación, es necesario volver a iniciar sesión");
	    			setTimeout(()=> {
	    				localStorage.removeItem('satellizer_token');
						localStorage.removeItem('admin_token');
						localStorage.removeItem('user');
						window.location = '#/login';
	    			}, 2000)
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
		DialogController.$inject = ['$scope', '$mdDialog'];
		TransferirController.$inject = ['$scope', '$mdDialog', 'API'];
		BajarEvidenciasController.$inject = ['$scope', '$mdDialog', 'API'];
	}]);