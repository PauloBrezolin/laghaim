	var lastForm = '';
    var lastVal = '';
    
    function getNoteEdit(noteid, id, value, len, maxlen)
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
            $('#' + id).html('<input type="hidden" name="id" value="'+noteid+'" /><textarea name="msg" id="input_'+lastForm+'" style="width:535px;" rows="5">' + lastVal + '</textarea><br /><input type="submit" value="Save" />');
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
