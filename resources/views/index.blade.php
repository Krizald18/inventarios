<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Sistema de Inventario - Registro Civil</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<!-- build:css(.) styles/vendor.css -->
	<!-- bower:css -->
	<link rel="stylesheet" href="css/fonts.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/sidebar.min.css">
	<link rel="stylesheet" href="css/angular-material.min.css" />
	<link rel="stylesheet" href="css/md-data-table.min.css" />
	<link rel="stylesheet" href="css/select.min.css" />
	<link rel="stylesheet" href="css/lf-ng-md-file-input.min.css" />
	<!-- endbower -->
	<!-- endbuild -->
	<!-- build:css(.tmp) styles/main.css -->
	<link rel="stylesheet" href="angular/styles/main.css">
	<!-- endbuild -->
	<style type="text/css">
		.label {
			color: rgba(0, 0, 0, .54);
		}

		#contdiv {
			margin-left: -350px;
			font-family: 'Raleway', sans-serif;
			font-weight: 500;
		}

		#wrapper {
			font-family: 'Raleway', sans-serif;
			font-weight: 600;
			/*height: 100%;*/
			margin: 0 auto -30px;
			min-height: 94%;
			height: auto !important;
		}

		#bottom, #push {
			height: 30px;
		}

		#footer {
			margin-top: 30px;
			height: 50px;
		}

		.mt100 {
			font-family: 'Raleway', sans-serif;
			font-weight: 500;
		}

		span.ui-select-match-text.pull-left {
			font-family: 'Raleway', sans-serif;
			font-weight: 500;
		}

		div.ui-select-match.ng-scope {
			border-bottom-width: 1px;
			border-bottom-style: solid;
			color: rgba(0, 0, 0, 0.12);
			margin-right: -2px;
			margin-top: -5px;
		}

		div.lf-ng-md-file-input-drag-text-container
		layout-align-center-center.layout-row {
			height: 120px;
		}

		#ftrtxt {
			float: right;
			margin-right: 30px;
		}
	</style>
</head>
<body ng-app="App">
	<!-- [if lte IE 8]>
		<p class="browsehappy">
			You are using an <strong>outdated</strong> browser. Please
			<a href="http://browsehappy.com/">upgrade your browser</a>
			to improve your experience.
		</p>
	<![endif] -->
	<!-- Add your site or application content here -->
	<div id="wrapper">
		<div class="header" ng-controller="SidebarCtrl">
			<nav class="navbar navbar-inverse navbar-fixed-top" style="width: 100%;">
				<div class="container" style="margin-left: 150px;">
					<div class="navbar-header">
						<a class="navbar-brand" href="/#/"></a>
					</div>
					<div class="collapse navbar-collapse" id="js-navbar-collapse">
						<ul class="nav navbar-nav">
							<li>
								<a href="/#/">
									Inicio
								</a>
							</li>
						</ul>
						<ul id="ulauth" class="nav navbar-nav"
							style="position: fixed; right: 10%;" hidden>
							<li ng-if="!autenticado">
								<a ng-href="/#/login">
									Entrar
								</a>
							</li>
							@include('nombre');
							<li ng-if="autenticado">
								<a ng-href="/#/" ng-click="$event.preventDefault(); logout();">
									Salir
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="area"></div>
		<nav class="main-menu" ng-controller="SidebarCtrl">
			<ul style="margin-top: 75px">
				<li>
					<a href="#">
						<i class="fa fa-home fa-2x"></i>
						<span class="nav-text">
							Inicio
						</span>
					</a>
				</li>
				<li id="liauth" ng-if="autenticado" hidden>
					<a href="#/inventario">
						<i class="fa fa-book fa-2x"></i>
							<span class="nav-text">
								Inventario
							</span>
					</a>
				</li>
				<li id="liauth" ng-if="autenticado" hidden>
					<a href="#/resguardo">
						<i class="fa fa-file-text"></i>
						<span class="nav-text">
							Resguardos
						</span>
					</a>
				</li>
				<li id="liauth" ng-if="autenticado" hidden>
					<a href="#/agregar">
						<i class="fa fa-plus fa-2x"></i>
						<span class="nav-text">
							Agregar Articulos
						</span>
					</a>
				</li>
				<!-- <li id="liauth" ng-if="autenticado" hidden>
					<a href="#/eliminar">
						<i class="fa fa-remove fa-2x"></i>
						<span class="nav-text">
							Eliminar Articulos
						</span>
					</a>
				</li>
				<li id="liauth" ng-if="autenticado" hidden>
					<a href="#/baja">
						<i class="fa fa-minus fa-2x"></i>
						<span class="nav-text">
							Baja de Articulos
						</span>
					</a>
				</li> -->
			</ul>
			<ul class="logout" ng-if="autenticado">
				<li id="liauth" ng-if="autenticado && admin" hidden>
					<a href="#/panel">
						<i class="fa fa-bolt fa-2x"></i>
						<span class="nav-text">
							Panel admin
						</span>
					</a>
				</li>
				<li>
					<a href="#" ng-click="$event.preventDefault(); logout();">
						<i class="fa fa-power-off fa-2x"></i>
						<span class="nav-text">
							Salir
						</span>
					</a>
				</li>
			</ul>
		</nav>
		<div id="push"></div>
		<div class="container" style="margin-top: 15px;">
			<div id="contdiv" ng-view="" style="width: 1200px"></div>
		</div>
	</div>
	<div id="footer">
		<div class="footer">
			<?php
				function auto_copyright($year = 'auto') {
					if (intval($year) == 'auto')
						$year = date('Y');
					if (intval($year) == date('Y'))
						echo intval($year);
					if (intval($year) < date('Y'))
						echo intval($year) . ' - ' . date('Y');
					if (intval($year) > date('Y'))
						echo date('Y');
				}
			?>
			<div id="ftrtxt">
				USE/Inventarios &copy;<?php auto_copyright("2017");?>
			</div>
		</div>
	</div>
	<!-- build:js(.) scripts/vendor.js -->
	<!-- bower:js -->
	<script src="js/jquery.min.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/angular-animate.min.js"></script>
	<script src="js/angular-aria.min.js"></script>
	<script src="js/angular-cookies.min.js"></script>
	<script src="js/angular-material.min.js"></script>
	<script src="js/angular-messages.min.js"></script>
	<script src="js/angular-middleware.min.js"></script>
	<script src="js/angular-resource.min.js"></script>
	<script src="js/angular-route.min.js"></script>
	<script src="js/angular-sanitize.min.js"></script>
	<script src="js/fusioncharts.js"></script>
	<script src="js/fusioncharts.charts.js"></script>
	<script src="js/angular-fusioncharts.min.js"></script>
	<!--<script src="js/angular-ui-router.min.js"></script>-->
	<script src="js/md-data-table.min.js"></script>
	<script src="js/satellizer.min.js"></script>
	<script src="js/select.min.js"></script>
	<script src="js/ui-bootstrap-2.5.0.min.js"></script>
	<script src="js/svg-assets-cache.js"></script>
	<script src="js/lf-ng-md-file-input.min.js"></script>
	<script src="js/angular-file-upload.min.js"></script>
	<!-- conflict with material-->
	<!--<script src="js/moment.min.js"></script>-->
	<!-- <script src="bower_components/angular-touch/angular-touch.js">
	</script> -->
	<!-- required by restangular-->
	<script src="js/lodash.min.js"></script>
	<!-- required by restangular-->
	<script src="js/restangular.min.js"></script>
	<!-- endbower -->
	<!-- endbuild -->

	<!-- build:js({.tmp,app}) scripts/scripts.js -->
	<script src="angular/scripts/app.js"></script>
	<script src="angular/scripts/config/app_config.js"></script>
	<script src="angular/scripts/controllers/sidebar.js"></script>
	<script src="angular/scripts/controllers/main.js"></script>
	<script src="angular/scripts/controllers/inventario.js"></script>
	<script src="angular/scripts/controllers/resguardo.js"></script>
	<script src="angular/scripts/controllers/agregar.js"></script>
	<script src="angular/scripts/controllers/login.js"></script>
	<script src="angular/scripts/controllers/register.js"></script>
	<script src="angular/scripts/controllers/panel.js"></script>
	<script src="angular/scripts/controllers/about.js"></script>
	<script src="angular/scripts/services/api.js"></script>
	<script src="angular/scripts/services/toastservice.js"></script>
	<script src="angular/scripts/services/alertservice.js"></script>
	<!-- endbuild -->
</body>
<script type="text/javascript">
	$( document ).ready(function() {
		// Firefox 1.0+
		let isFirefox = typeof InstallTrigger !== 'undefined';
		let isChrome = !!window.chrome && !!window.chrome.webstore;
		// if (!isChrome && !isFirefox)
		// 	window.location.replace('/unsupported-browser');
		if (document.getElementById("ulauth") != undefined)
			document.getElementById("ulauth").removeAttribute("hidden");
		if (document.getElementById("liauth") != undefined)
			document.getElementById("liauth").removeAttribute("hidden");
		var body = document.body;
		body.style.height = 100 + "%";
	});
</script>
</html>
