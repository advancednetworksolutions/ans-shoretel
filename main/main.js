'use strict';

angular.module('callTrendApp')
  .config(function ($routeProvider) {
    console.log('Main router loaded');
    $routeProvider
      .when('/', {
        templateUrl: 'main/main.html',
        controller: 'MainCtrl'
      });
  });
