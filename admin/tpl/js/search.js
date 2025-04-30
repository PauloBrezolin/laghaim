$('#searchform').unbind();
$('#searchform').bind('submit', function(event)
{
    var url = 'search_worker.php';

    $('#searchresult').html('&nbsp;<div style="width:100%; margin:25px auto; text-align:center;"><img src="tpl/img/loading2.gif" /></div>');
    
    $.post(url, $(this).serialize(),function(result) 
    { 
        $('#searchresult').html(result);
    });        

    return false;
});

$('#searchitemform').unbind();
$('#searchitemform').bind('submit', function(event)
    {
        event.preventDefault();
        
        $('#searchresult').html('&nbsp;<div style="width:100%; margin:25px auto; text-align:center;"><img src="tpl/img/loading2.gif" /></div>');
        $.post("search_item.php", $("#searchitemform").serialize(),function(data) 
        { 
            $("#cblock").html(data);
        });        
        
        
});    
