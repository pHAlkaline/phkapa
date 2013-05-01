/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
    $("#AroForeignKey").live("change", function (event) {
        setAroAlias()  
    });
    setAroAlias();
    

});

function setAroAlias(){
    if ($("#AroForeignKey").val()!=''){
        var str = "";
        str=$("select#AroForeignKey option:selected").text();
        $("#AroAlias").val(str);
        $('#AroAlias').attr("disabled", "disabled").fadeTo('slow',0.5);
    } else {
        //$("#AroAlias").val('');
        $('#AroAlias').fadeTo('slow',1).removeAttr("disabled");
            
    }
}





