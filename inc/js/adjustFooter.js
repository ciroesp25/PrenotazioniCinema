$(document).ready(function() {
    
    var screenHeight = $(window).height();
    var mainHeight = $("main").height();
    var actualHeight = screenHeight - mainHeight - 327.6;
    console.log(screenHeight);

    $("main").css("min-height", actualHeight.toString() + "px");
});