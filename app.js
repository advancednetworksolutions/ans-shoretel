angular.module('callTrendApp', ['ui.grid','ngSanitize', 'ngCsv','ngRoute'])

.config(function($routeProvider, $locationProvider,$httpProvider) {
  console.log('App Loaded');
  $routeProvider
    .otherwise({
      redirectTo: '/'
    });

  $locationProvider.html5Mode(true);

});
