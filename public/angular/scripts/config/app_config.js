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
				templateUrl: 'angular/views/main.html',
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
			/*.when('/matriz_estructura/metricas', {
				templateUrl: 'angular/views/metricas.html',
				controller: 'MetricasCtrl',
				middleware: 'AuthenticatedOnly'
			})*/
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
	});