/*
 ___http://superdit.com/2011/06/11/hover-image-zoom-with-jquery/___ 
*/
$(document).ready(function() {
    $("#zoomContainer").each(function(index){
        var cont_left = $("#zoomContainer").position().left;
        $(".zoom img").hover(function() {
            // hover in
            //alert('hover');
            $(this).parent().parent().css("z-index", 1);
            $(this).animate({
               height: "202",
               width: "160",
               left: "-=50",
               top: "-=50"
            }, "fast");
        }, function() {
            // hover out
            //alert('out');
            $(this).parent().parent().css("z-index", 0);
            $(this).animate({
                height: "192",
                width: "149",
                left: "+=50",
               top: "+=50"
            }, "fast");
        });
    })
        

        $(".img").each(function(index) {
            //alert(index);
            var left = (index * 160) + cont_left;
            $(this).css("left", left + "px");
        });
    });


