/**
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://phalkaline.net
 */

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
        var pHKapaurl='';
	if (href.lastIndexOf("register")!=-1){
            pHKapaurl = href.slice(0, href.lastIndexOf("register"));
        }
        if (href.lastIndexOf("review")!=-1){
            pHKapaurl = href.slice(0, href.lastIndexOf("review"));
        }
        
        //alert(document.baseURI);
        //alert(pHKapaurl+"/phkapa/register/update_by_process");
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
            url:pHKapaurl+"register/update_by_process"
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



   

});
