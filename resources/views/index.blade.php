<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- build:css(.) styles/vendor.css -->
    <!-- bower:css -->
    <link rel="stylesheet" href="css/fonts.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/angular-material.css" />
    <link rel="stylesheet" href="css/md-data-table.min.css" />
    <link rel="stylesheet" href="css/select.css" />
    <!-- endbower -->
    <!-- endbuild -->
    <!-- build:css(.tmp) styles/main.css -->
    <link rel="stylesheet" href="angular/styles/main.css">
    <!-- endbuild -->
    <style type="text/css">
      #contdiv
      {
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
      #sidebar-wrapper{
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
      }
      #bottom, #push { height:30px;}
      #footer { margin-top: 30px; height:50px;}
      .mt100{
        font-family: 'Raleway', sans-serif;
        font-weight: 500;
      }
    </style>
  </head>
  <body ng-app="App">    
    <!--[if lte IE 8]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
    <div id="wrapper">
    <div class="header" ng-controller="SidebarCtrl">
      <nav class="navbar navbar-inverse bg-inverse navbar-fixed-top" style="width: 100%;">
        <div class="container" style="margin-left: 150px;">
          <div class="navbar-header">            
            <a class="navbar-brand" href="/#/"></a>
          </div>
          <div class="collapse navbar-collapse" id="js-navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/#/">Home</a></li>
              <li><a ng-href="/#/about">About</a></li>
              <li><a ng-href="/#/" ng-click ="$event.preventDefault();">Contact</a></li>
            </ul>
            <ul id="ulauth" class="nav navbar-nav" style="position: fixed; right: 10%;" hidden>
              <li ng-if="!autenticado"><a ng-href="/#/register">Registrarse</a></li>
              <li ng-if="!autenticado"><a ng-href="/#/login">Entrar</a></li>
              <li ng-if="autenticado"><a ng-href="/#/" ng-click ="$event.preventDefault(); logout();">Salir</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
 <!-- Sidebar -->
    <div ng-controller="SidebarCtrl">
      <div id="sidebar-wrapper" ng-if="autenticado" hidden>
        <ul class="sidebar-nav">
          <li class="sidebar-brand">
            <a href="">Inventarios</a>
          </li>
          <li>
            <a href="/#/xx">xx</a> <!--MATRIZ A EVALUAR-->
          </li>
          <li>
            <a href="/#/xx">xx</a> <!--EDITAR INDICADORES DE MATRIZ ESTRUCTURA-->
          </li>
          <li>
            <a href="/#/xx">xx</a> <!--AGREAR METRICAS A INDICADORES DE MATRIZ ESTRUCTURA-->
          </li>
          <li>
            <a href="/#/xx">xx</a> <!--ADMIN ZONE-->
          </li>
        </ul>
    </div>
  </div>
<!-- /#sidebar-wrapper -->
  <div id="push"></div>
    <div class="container" style="margin-top: 15px; margin-left: 2%;">
      <div id="contdiv" ng-view="" style="width: 900px"></div>
    </div>
  </div>
    <div id="footer">
      <div class="footer" style="margin-left:250px">
          <p>FOOTER</p>
      </div>
    </div>
    <!-- build:js(.) scripts/vendor.js -->
    <!-- bower:js -->
    <script src="js/jquery.js"></script>
    <script src="js/angular.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/angular-animate.js"></script>
    <script src="js/angular-aria.js"></script>
    <script src="js/angular-cookies.js"></script>
    <script src="js/angular-material.js"></script>
    <script src="js/angular-messages.js"></script>
    <script src="js/angular-middleware.js"></script>
    <script src="js/angular-resource.js"></script>
    <script src="js/angular-route.js"></script>
    <script src="js/angular-sanitize.js"></script>
    <script src="js/angular-ui-router.js"></script> 
    <script src="js/md-data-table.min.js"></script>
    <script src="js/satellizer.js"></script>    
    <script src="js/select.js"></script>    
    <script src="js/ui-bootstrap-tpls-2.5.0.js"></script>    

    <!--<script src="bower_components/angular-touch/angular-touch.js"></script>--><!-- conflict with material-->
    <!-- required by restangular-->
    <script src="js/lodash.js"></script>
    <!-- required by restangular-->

    <script src="js/restangular.js"></script>
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:js({.tmp,app}) scripts/scripts.js -->
    <script src="angular/scripts/app.js"></script>
    <script src="angular/scripts/config/app_config.js"></script>
    <script src="angular/scripts/controllers/sidebar.js"></script>
    <script src="angular/scripts/controllers/main.js"></script>
    <script src="angular/scripts/controllers/inventario.js"></script>
    <script src="angular/scripts/controllers/login.js"></script>
    <script src="angular/scripts/controllers/register.js"></script>
    <script src="angular/scripts/controllers/about.js"></script>
    <script src="angular/scripts/services/api.js"></script>
    <script src="angular/scripts/services/toastservice.js"></script>
    <!-- endbuild -->
</body>
<script type="text/javascript">
  $( document ).ready(function() {
    if(document.getElementById("sidebar-wrapper") != undefined)
      document.getElementById("sidebar-wrapper").removeAttribute("hidden");
    if(document.getElementById("ulauth") != undefined)
      document.getElementById("ulauth").removeAttribute("hidden");
  });
</script>
</html>