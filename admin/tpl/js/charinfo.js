    var lastForm = '';
    var lastVal = '';
    
    function getForm(cid, id, value, len, maxlen)
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
            $('#' + id).html('<input type="hidden" name="editcharrdata" value="'+cid+'" /><input type="text" name="'+ lastForm + '" id="input_'+lastForm+'" value="'+ lastVal +'" size="'+len+'" maxlength="'+maxlen+'" /> <input type="submit" value="Save" />');
            $('#' + id).fadeIn(150);
        });
    }
    
    function getForm2(cid, id, value, len, maxlen)
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
            $('#' + id).html('<input type="hidden" name="editcharrdata" value="'+cid+'" /><select name="'+ lastForm + '" id="input_'+lastForm+'"><option value="0:0">Titan</option><option value="0:2">- Warmaster</option><option value="0:1">- Highlander</option><option value="1:0">Knight</option><option value="1:1">- Royal Knight</option><option value="1:2">- Templar</option><option value="2:0">Healer</option><option value="2:1">- Archer</option><option value="2:2">- Cleric</option><option value="3:0">Mage</option><option value="3:1">- Wizard</option><option value="3:2">- Witch</option><option value="4:0">Rogue</option><option value="4:2">- Ranger</option><option value="4:1">- Assassin</option><option value="5:0">Sorcerer</option><option value="5:2">- Specialist</option><option value="5:1">- Elementalist</option><option value="6:0">NightShadow</option><option value="7:0">Ex-Rogue</option><option value="7:2">- Ex-Ranger</option><option value="7:1">- Ex-Assassin</option><option value="8:0">Arch-Mage</option><option value="8:1">- Arch-Wizard</option><option value="8:2">- Arch-Witch</option></select><input type="submit" value="Save" />');
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
