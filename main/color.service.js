angular.module('callTrendApp').service('ColorService', function() {
  this.Colors = {};
  this.Colors.names = {
      orang: "#00ffff",
      azure: "#f0ffff",
      beige: "#f5f5dc",
      black: "#000000",
      blue: "#0000ff",
      brown: "#a52a2a",
      cyan: "#00ffff",
      darkblue: "#00008b",
      darkcyan: "#008b8b",
      darkgrey: "#a9a9a9",
      darkgreen: "#006400",
      darkkhaki: "#bdb76b",
      darkmagenta: "#8b008b",
      darkolivegreen: "#556b2f",
      darkorange: "#ff8c00",
      darkorchid: "#9932cc",
      darkred: "#8b0000",
      darksalmon: "#e9967a",
      darkviolet: "#9400d3",
      fuchsia: "#ff00ff",
      gold: "#ffd700",
      green: "#008000",
      indigo: "#4b0082",
      khaki: "#f0e68c",
      lime: "#00ff00",
      magenta: "#ff00ff",
      maroon: "#800000",
      navy: "#000080",
      olive: "#808000",
      orange: "#ffa500",
      pink: "#ffc0cb",
      purple: "#800080",
      violet: "#800080",
      red: "#ff0000"
    };
    this.Colors.standard = [
      "#F68D20",
      "#414141",
      "#BCBDC0",
      "#708090",
      "#FF6347",
      "#2F4F4F",
      "#FF7F50",
      "#808080"
    ];

    this.Colors.get = function(i){
      if(this.standard[i]){
        return this.standard[i];
      }else{
        return this.random();
      }
    }
    this.Colors.random = function() {
      var result;
      var count = 0;
      for (var prop in this.names)
          if (Math.random() < 1/++count)
             result = prop;
      return result;
  };

  return this.Colors;


});
