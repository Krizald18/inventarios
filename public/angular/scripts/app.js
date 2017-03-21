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
    'satellizer',
    'app.config',
    'ui.bootstrap',
    'ui.select',
    'md.data.table',
    'material.svgAssetsCache',
    'lfNgMdFileInput',
    'angularFileUpload'
  ]);
  /*.filter('moment', function() {
    return function(dateString, format) {
        return moment(dateString).format(format);
    };
})*/

angular.module('app.config', []);