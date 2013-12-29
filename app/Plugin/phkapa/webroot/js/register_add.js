$(function(){
    
    $("#TicketProcessId").on("change", function (event) {
        //$("#TicketProcessChange").val('1');
        $("#LoadProcessData").css('display', 'inline');
        $('#TicketActivityId').children().filter(function() {
            return this.value !== "";
        }).remove();
        $('#TicketCategoryId').children().filter(function() {
            return this.value !== "";
        }).remove();
        //$('#TicketActivityId').attr("disabled", "disabled");
        //$('#TicketCategoryId').attr("disabled", "disabled");
        var href = $(location).attr('href');
	    var PHKAPAurl = href.slice(0, href.lastIndexOf("register"));
        //alert(document.baseURI);
        //alert(PHKAPAurl+"/phkapa/register/update_by_process");
        //console.log(x);
                
        $.ajax({
            data:$("#TicketProcessId").closest("form").serialize(),
            dataType:"html",
            success:function (data, textStatus) {
                $("#LoadProcessData").css('display', 'none');
                $("#ProcessData").html(data);
            },
            error:function(data, textStatus, error){
                //console.log(data.responseText);
                //console.log(textStatus);
                //console.log(error);
                alert('Error loading data!!');
                $("#LoadProcessData").css('display', 'none');
            },
            type:"post",
            url:PHKAPAurl+"register/update_by_process"
        });
        return false;
    });
    
    $("#setTodaysDate").click(function() {
        var myDate = new Date();
        var month = myDate.getMonth()+1;
        //alert(("0" + month).slice(-2));
        $("#TicketOriginDateYear").val(myDate.getFullYear());
        $("#TicketOriginDateMonth").val(("0" + month).slice(-2));
        $("#TicketOriginDateDay").val(("0" + myDate.getDate()).slice(-2));
        return false;
    });

/* $("#dialog-message").dialog({
        modal: true,
        height: 530,
        width: 500,
        autoOpen: false,
        buttons: {
            Ok: function() {
                $( this ).dialog( "close" );
            }
        }
    }); */

   

});
