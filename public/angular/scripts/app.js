'use strict';
angular
  .module('App', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngMaterial',
    'ngMessages',
    'ngResource',
    'ngRoute',
    'ngRoute.middleware',
    'ngSanitize',
    'restangular',
    'ui.router',
    'satellizer',
    'app.config',
    'ui.bootstrap',
    'ui.select'
  ]);
  angular.module('app.config', []);