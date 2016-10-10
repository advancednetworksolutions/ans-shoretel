angular.module('callTrendApp').service('UtilService',function(){

  return {
    hours:[
      {value:0,textVal:'12 AM'},
      {value:1,textVal:'1 AM'},
      {value:2,textVal:'2 AM'},
      {value:3,textVal:'3 AM'},
      {value:4,textVal:'4 AM'},
      {value:5,textVal:'5 AM'},
      {value:6,textVal:'6 AM'},
      {value:7,textVal:'7 AM'},
      {value:8,textVal:'8 AM'},
      {value:9,textVal:'9 AM'},
      {value:10,textVal:'10 AM'},
      {value:11,textVal:'11 AM'},
      {value:12,textVal:'12 PM'},
      {value:13,textVal:'1 PM'},
      {value:14,textVal:'2 PM'},
      {value:15,textVal:'3 PM'},
      {value:16,textVal:'4 PM'},
      {value:17,textVal:'5 PM'},
      {value:18,textVal:'6 PM'},
      {value:19,textVal:'7 PM'},
      {value:20,textVal:'8 PM'},
      {value:21,textVal:'9 PM'},
      {value:22,textVal:'10 PM'},
      {value:23,textVal:'11 PM'}
  ],
    groupByHour:function(source,column,val,group){
      console.log(source);
      var newSource = [];
      var matches = 0;
      var uniqueGroups = [];

      for(var i = 0;i<source.length;i++){
        if(uniqueGroups.indexOf(source[i][group]) === -1){
          console.log(source[i][group]);
          uniqueGroups.push(source[i][group]);
        }
      }
        for(var i = 6;i < 19;i++){
            for(var j = 0;j<source.length;j++){
                if(source[j][column] == i.toString()){
                  matches++;
                  newSource.push({
                    numberVal:i,
                    column:this.hours[i].textVal,
                    val:source[j][val],
                    grouping:source[j][group]
                  });
                }
            }
          }

            if(matches < 1){
              newSource.push({
                numberVal:i,
                column:this.hours[i].textVal,
                val:'0',
                grouping:uniqueGroups[t]
              });
              matches = 0;
            }



          return newSource;
        },
      sumVals:function(objArray,valToSum){
        var total = 0;
          for(var i =0;i<objArray.length;i++){
            total = total + parseInt(objArray[i][valToSum]);
          }
        return total;
      },
      avgVals:function(objArray,valToSum){
        var total = 0;
        var avg = 0;
          for(var i =0;i<objArray.length;i++){
            total = total + parseInt(objArray[i][valToSum]);
          }

          avg = Math.ceil(total / objArray.length);

        return avg;
      }

    };

});
