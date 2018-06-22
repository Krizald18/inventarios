'use strict';

angular.module('App')
	.service('API', ['Restangular', 'ToastService', '$window', function (Restangular, ToastService, $window) {
		let headers = {
			'Content-Type': 'application/json',
			'Accept': 'application/x.laravel.v1+json'
		};
		return Restangular.withConfig(function(RestangularConfigurer) {
			RestangularConfigurer
				.setBaseUrl('/index.php/api/')
				.setDefaultHeaders(headers)
				.setErrorInterceptor(function(response) {
				    switch(response.status) {
						case 401:
							$window.localStorage.clear();
							$window.sessionStorage.clear();
							window.location.replace('#/login');
							break;
						case 422:
							if(response.data.errors == undefined)
								return ToastService.error(response.data.error);
							else
								for (let error in response.data.errors)
									return ToastService.error(response.data.errors[error][0]);
							break;
						case 503:
							location.reload();
							break;
						case 504:
				        case 500:
							return ToastService.error(response.statusText);
					}
				})
				.addFullRequestInterceptor(function(element, operation, what, url, headers) {
					let token = $window.localStorage.satellizer_token;
					if (token) {
						headers.Authorization = 'Bearer ' + token;
					}
				});
		});
}]);