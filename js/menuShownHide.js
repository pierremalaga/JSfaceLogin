/**
 * Created by pierremalaga on 2/3/16.
 */
var menuToogle = document.getElementById("menuToogle");
var menu = document.getElementById("menu");

menuToogle.addEventListener("onClick", function (){
    if(menu.style.display == "none"){
        menu.style.display = "block";
    }else{
        menu.style.display = "none";
    }
});

$("#menuToogle").click(function(){
    $("#menu").toggleClass( "hideMenu" );
});