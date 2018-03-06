"use strict";

$(document).ready(function(){
    
    var difficulty = document.getElementById("difficulty").innerHTML;
    
    var whereChar = difficulty.indexOf(":")+2;
    
    var difficulty = difficulty.slice(whereChar,difficulty.length);
    
    var barWidth = 100/4;
    
    switch(difficulty){
        case "laik":
            barWidth *= 1;
            break;
        case "podstawowy":
            barWidth *= 2;
            break;
        case "koszmar":
            barWidth *= 3;
            break;
        case "piekło":
            barWidth *= 4;
            break;
        default:
            console.log("default");
            break;
    }
    
    var difficultyProgress = document.getElementById("difficultyBar");
    difficultyProgress.style.width = barWidth+"%";
    
});