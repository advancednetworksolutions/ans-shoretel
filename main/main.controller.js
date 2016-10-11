'use strict';

angular.module('callTrendApp').controller('MainCtrl', function($scope, $http, $location, ChartService, UtilService) {

  $scope.inboundByExtCalls = [];
  $scope.callsByHour = [];
  $scope.totalInboundCalls = 0;
  $scope.loading =true;
  $scope.avg = false;
  $scope.filter = {
    currentFilter: "this week",
    currentGrouping: "day",
    filterOptions: [{
      range: "today"
    }, {
      range: "yesterday"
    }, {
      range: "this week"
    }, {
      range: "this month"
    }, {
      range: "this quarter"
    }, {
      range: "last month"
    },{
      range: "last quarter"
    } ],
    groupOptions: [{
      grouping: "day"
    }, {
      grouping: "week"
    },{
      grouping: "month"
    }, {
      grouping: "quarter"
    }]
  };

  $scope.$watch('filter.currentFilter',function(oldVal,newVal){
    if(oldVal !== newVal){
      $scope.getData();
    }
  });

  $scope.$watch('filter.currentGrouping',function(oldVal,newVal){
    if(oldVal !== newVal){
      $scope.getData();
    }
  });
  $scope.$watch('avg',function(oldVal,newVal){
    if(oldVal !== newVal){
      $scope.getData();
    }
  });

  //TODO: Most of this function should be in standalone data service or call data service
  $scope.getData = function() {
    $scope.loading =true;

    //TODO: add this functionality in chart.service.js to clean up controller
    var chartArea = angular.element(document.querySelector('#chartSection'));
    chartArea.empty();
    chartArea.prepend('<canvas ng-if="!loading" id="byHour" width="200" height="50" click="onClick"></canvas>');
    
    $http.get('api/callsByHour.php?filter='+$scope.filter.currentFilter+'&grouping='+$scope.filter.currentGrouping+'&avg='+$scope.avg)
    .then(response => {
      $scope.callsByHour = response.data;
      $scope.callsByHour = UtilService.groupByHour($scope.callsByHour, 'hour', 'calls','grouping');
      console.log($scope.callsByHour);
      ChartService.lineChart($scope.callsByHour, 'byHour', 'column', 'val','grouping');
      if ($scope.avg) {
        $scope.totalInboundCalls = UtilService.avgVals($scope.callsByHour, 'val') + ' calls per hour on average ';
      }else{
        $scope.totalInboundCalls = UtilService.sumVals($scope.callsByHour, 'val') + ' total calls ';
      }
      $scope.loading = false;

    });
  }

  $scope.getData();


});
