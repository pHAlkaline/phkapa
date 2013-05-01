

$(function(){
    $("#UserEdpassword").click(function(){
        
        if ($("#UserEdpassword").is(':checked')){
           $("#UserPassword").removeAttr("disabled"); 
        } else {
           $("#UserPassword").attr("disabled",true);
           $("#UserPassword").val('')
        }
        
        
       
    });
    

});







