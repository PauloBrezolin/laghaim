$(function()
{
    
    var dialog;        
    $("#dialog-form").hide();
         
    function SaveEdit()
    {
        $("#newcatform").submit();
    }

    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Save": SaveEdit,
            Cancel: function() {
                dialog.dialog("close");
            }
        },
        close: function() {
        }        
    });

    
    $(".netcat").unbind();
    $(".newcat").bind("click", function(event) 
    {
        event.preventDefault();
        dialog.dialog('open');
    });
});