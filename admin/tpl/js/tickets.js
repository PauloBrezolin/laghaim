$('#addreply').unbind();
$('#addreply').bind('submit', function(event)
{
    event.preventDefault();

    var url = $("#addreply").attr('action');

    $('#msg').val(fullEditor.getHTML());

    $.post(url, $("#addreply").serialize(),function(data) 
    { 
        $("#cblock").html(data);
    });        
});

