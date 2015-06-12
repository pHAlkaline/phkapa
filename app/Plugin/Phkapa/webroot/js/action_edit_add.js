/**
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */

$(function(){
    
    $("#setTodayCloseDate").click(function() {
        var myDate = new Date();
        var month = myDate.getMonth()+1;
        //alert(("0" + month).slice(-2));
        $("#ActionCloseDateYear").val(myDate.getFullYear());
        $("#ActionCloseDateMonth").val(("0" + month).slice(-2));
        $("#ActionCloseDateDay").val(("0" + myDate.getDate()).slice(-2));
        return false;
    });

   

});



