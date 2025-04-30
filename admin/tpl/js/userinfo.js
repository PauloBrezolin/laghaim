    var lastForm = '';
    var lastVal = '';
    
    function getForm(uid, id, value, len, maxlen)
    {
        
        if(typeof(len)==='undefined') len = 20;
        if(typeof(maxlen)==='undefined') maxlen = 50;
        
        
        if(lastForm != '')
            setNormal(lastForm, lastVal);
        
        lastForm = id;
        lastVal = $('#' + id).html();
        
        $('#' + id).fadeOut(150, function()
        {
            $('#' + id).hide();
            $('#' + id).html('<input type="hidden" name="edituserdata" value="'+uid+'" /><input type="text" name="'+ lastForm + '" id="input_'+lastForm+'" value="'+ lastVal +'" size="'+len+'" maxlength="'+maxlen+'" /> <input type="submit" value="Save" />');
            $('#' + id).fadeIn(150);
        });
    }
    
    function setNormal(id, value)
    {
        $('#' + id).fadeOut(150, function()
        {
            $('#' + id).hide();
            $('#' + id).html(value);
            $('#' + id).fadeIn(150);
        });  
        
        lastForm = '';
        lastVal = '';
    }
    
    
    $('#edituserinfo').unbind();
    $('#edituserinfo').bind('submit', function(event)
    {
        event.preventDefault();
        
        
        $.post("worker.php", $("#edituserinfo").serialize(),function(data) 
        { 
            setNormal(lastForm, data);
        });        
        
        
        
        
    });
