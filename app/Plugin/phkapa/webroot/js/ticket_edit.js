$(function(){
    
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



