angular.module('callTrendApp').service('ChartService', function(ColorService) {
  this.doughNutChart = function(objArray, elem, column, val) {
    if (doughNutChart) {
      doughNutChart.destroy();
    } else {

      var uniqueGroups = [];
      var set = {
        labels: [],
        values: [],
        colors: []
      };
      var sets = [];


      for(var i = 0;i<objArray.length;i++){
        if(uniqueGroups.indexOf(objArray[i][group]) === -1){
          uniqueGroups.push(objArray[i][group]);
        }
      }
      for(var j = 0;j<uniqueGroups.length;j++){
        for (var t = 0; t < objArray.length; t++) {
          if (objArray[t][group] === uniqueGroups[j]) {
            set.labels.push(objArray[t][column]);
            set.values.push(objArray[t][val]);
            set.colors.push(ColorService.random());
            sets.push(set);
            set = {
              labels : [],
              values : [],
              colors : []
            };
          }
        }
      }
      //Pie/Doughnut Chart data structure

      var data = {
        labels: labels,
        datasets: sets
      };
      var ctx = document.getElementById(elem);
      var doughNutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options:{
          responsive: true
        }
      });
    }
  }

  this.lineChart = function(objArray, elem, column, val,group) {
    if(lineChart){
      lineChart.destroy();

    }else{
          var labels = [
            '6 AM',
            '7 AM',
            '8 AM',
            '9 AM',
            '10 AM',
            '11 AM',
            '12 PM',
            '1 PM',
            '2 PM',
            '3 PM',
            '4 PM',
            '5 PM',
            '6 PM',
            '7 PM'
          ];
          var uniqueGroups = [];
          var set = {
            label: '',
            values: [],


            data:[]
          };
          var sets = [];


          for(var i = 0;i<objArray.length;i++){
            if(uniqueGroups.indexOf(objArray[i][group]) === -1){
              uniqueGroups.push(objArray[i][group]);
            }
          }
          for(var j = 0;j<uniqueGroups.length;j++){
            for (var t = 0; t < objArray.length; t++) {
              if (objArray[t][group] === uniqueGroups[j]) {
                if(!objArray[t][group]){
                  set.label = 'Avg';

                }else{
                  set.label = objArray[t][group];

                }
                set.data.push(objArray[t][val]);

              }
            }
            set.borderColor = ColorService.get(j);
            set.backgroundColor = 'rgba(255, 255, 255, 0)';
            sets.push(set);
            set = {
              data : [],
              borderColor: ''
            };
          }

    var data = {
      labels: labels,
      datasets: sets
    };
    var ctx = document.getElementById(elem);
    var lineChart = new Chart(ctx, {
      type: 'line',
      data: data,
      options:{
        responsive: true
      }
    });

  }
}
});
