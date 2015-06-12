/**
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */

$(function(){
    
   $("#TicketRegistarId,#TicketProcessId,#TicketCategoryId").on("change", function (event) {
        $("#TicketFilterChange").val('1');
        $(this).closest("form").submit();
        return false;
    });
    
    $("#setTodayOriginDate").click(function() {
        var myDate = new Date();
        var month = myDate.getMonth()+1;
        //alert(("0" + month).slice(-2));
        $("#TicketOriginDateYear").val(myDate.getFullYear());
        $("#TicketOriginDateMonth").val(("0" + month).slice(-2));
        $("#TicketOriginDateDay").val(("0" + myDate.getDate()).slice(-2));
        return false;
    });

    $("#setTodayCloseDate").click(function() {
        var myDate = new Date();
        var month = myDate.getMonth()+1;
        //alert(("0" + month).slice(-2));
        $("#TicketCloseDateYear").val(myDate.getFullYear());
        $("#TicketCloseDateMonth").val(("0" + month).slice(-2));
        $("#TicketCloseDateDay").val(("0" + myDate.getDate()).slice(-2));
        return false;
    });

});

