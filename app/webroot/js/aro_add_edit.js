/**
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
$(function(){
    $("#AroForeignKey").on("change", function (event) {
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





