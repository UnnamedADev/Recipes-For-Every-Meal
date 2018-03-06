"use strict";

$(document).ready(function(){
    
    //const
    const duration = 300;
    //vars
    
    //main
    var myImg = document.getElementById("recipeImg");

    myImg.addEventListener("click", function(){
        buildHolder(this);
    });
    
    //function
    function buildHolder(myObj){
        
        var page = document.getElementsByTagName("body")[0];
        
        var holder = document.createElement("div");
        holder.id = "zoomHolder";
        page.appendChild(holder);
        
        var mask = document.createElement("div");
        mask.id = "zoomMask";
        holder.appendChild(mask);
        
        var image = document.createElement("img");
        
        var objHref = myObj.getAttribute("src");
        image.setAttribute("src", objHref);
        holder.appendChild(image);
        
        $(holder).fadeIn(duration);
        
        addMaskEvent();
    }
    
    function addMaskEvent(){
        var myMask = document.getElementById("zoomMask");
        myMask.addEventListener("click",function(){
            closeAll();
        });
    }
    
    function closeAll(){
        var page = document.getElementsByTagName("body")[0];
        
        var holder = document.getElementById("zoomHolder");
        
        $(holder).fadeOut(duration, function(){
            page.removeChild(holder);
        });
    }
});