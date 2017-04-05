angular.module('app.config')
	.config(function($qProvider) {
		$qProvider.errorOnUnhandledRejections(false);
	})
	.config(function($authProvider) {
		'ngInject';
		$authProvider.httpInterceptor = function() {
			return true;
		}
		$authProvider.loginUrl = '/api/auth/login';
		$authProvider.signupUrl = '/api/auth/register';
		$authProvider.tokenRoot = 'data';//compensates success response macro
	})
	.config(function($routeProvider, $locationProvider) {
		$locationProvider.hashPrefix('');
		$routeProvider
			.when('/', {
				templateUrl: 'angular/views/home.html',
				controller: 'MainCtrl',
				middleware: 'resize'
			})
			.when('/about', {
				templateUrl: 'angular/views/about.html',
				controller: 'AboutCtrl',
				middleware: 'resize'
			})
			.when('/login', {
				templateUrl: 'angular/views/login.html',
				controller: 'LoginCtrl',
				middleware: 'resize'
			})
			.when('/register', {
				templateUrl: 'angular/views/register.html',
				controller: 'RegisterCtrl',
				middleware: 'resize'
			})
			.when('/inventario', {
				templateUrl: 'angular/views/inventario.html',
				controller: 'InventarioCtrl',
				middleware: 'AuthenticatedOnly'
			})
			.when('/resguardo', {
				templateUrl: 'angular/views/resguardo.html',
				controller: 'ResguardoCtrl',
				middleware: 'AuthenticatedOnly'
			})
			.when('/agregar', {
				templateUrl: 'angular/views/agregar.html',
				controller: 'AgregarCtrl',
				middleware: 'AuthenticatedOnly'
			})
			.when('/baja', {
				templateUrl: 'angular/views/main.html',
				controller: 'MainCtrl',
				middleware: 'AuthenticatedOnly'
			})
			.when('/panel', {
				templateUrl: 'angular/views/panel.html',
				controller: 'PanelCtrl',
				middleware: 'AuthenticatedOnly'
			})
			.otherwise({
				redirectTo: '/'
			});
	})
	.config(function($middlewareProvider) {
		$middlewareProvider.map({
			/* Redirect if not authenticated // validate token structure */
			'AuthenticatedOnly': function isAuthenticated($window) {
				document.body.style.height = 100 + "%";
				var token = localStorage.satellizer_token;
				var pass = false;
				if (token) {
					// Token with a valid JWT format XXX.YYY.ZZZ
					if (token.split('.').length === 3) {
						// Could be a valid JWT or an access token with the same format
						try {
						var base64Url = token.split('.')[1];
						var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
						var exp = JSON.parse($window.atob(base64)).exp;
						// JWT with an optonal expiration claims
						if (exp) {
							var isExpired = Math.round(new Date().getTime() / 1000) >= exp;
							if (isExpired) {
							// FAIL: Expired token
								pass = false;
							} else {
								// PASS: Non-expired token
									pass = true;
								}
							}
						} catch(e) {
						// PASS: Non-JWT token that looks like JWT
							pass = false;
						}
					}
					else
					{
						pass = false;
						// PASS: All other tokens
						// pass = true;
					}
				}
				else
				{
					// FAIL: No token at all
					pass = false;
				}
				if(pass)
					this.next();
				else
				{
					if(token)
						localStorage.removeItem('satellizer_token');
					this.redirectTo('/');
				}
			},
			'resize': function res() {
				document.body.style.height = 100 + "%";
				this.next();
			}
		});
	}).config(function($mdThemingProvider) {

	}).directive('ngEnter', function () {
		return function (scope, element, attrs) {
			element.bind("keydown keypress", function (event) {
				if(event.which === 13) {
					scope.$apply(function (){
						scope.$eval(attrs.ngEnter);
					});
	 
					event.preventDefault();
				}
			});
		};
	}).filter('num', function() {
		return function(input) {
			return parseInt(input, 10);
		}
	});