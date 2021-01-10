/**
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */

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







