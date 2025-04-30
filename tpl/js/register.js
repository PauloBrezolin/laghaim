$("#stdform").unbind();
$("#stdform").bind('submit', function(event)
{
    var url = $(this).attr("action");
    event.preventDefault();
    
    $.post(url, $(this).serialize(),function(data) 
    { 
        $("#main_content").html(data).hide().fadeIn(300); 
    });
    
    window.scrollTo(0, 350);
});


$("#regform").unbind();
$("#regform").bind('submit', function(event)
{
    var url = $(this).attr("action");
    event.preventDefault();

    var username = $("input[name='reg_uname']").val();
    var pass1 = $("input[name='reg_pw1']").val();
    var pass2 = $("input[name='reg_pw2']").val();
    var email = $("input[name='reg_email']").val();
    var email2 = $("input[name='reg_email2']").val();
    var scode = $("input[name='reg_scode']").val();
    var myRegxp = /^([a-zA-Z0-9_-]+)$/;
    var codeRegxp = /^([0-9]{4})$/;
    
    var badcode = new Array();
    badcode[0] = '1234';
    badcode[2] = '9876';
    badcode[3] = '8765';
    badcode[4] = '0000';
    badcode[5] = '1111';
    badcode[6] = '2222';
    badcode[7] = '3333';
    badcode[8] = '4444';
    badcode[9] = '5555';
    badcode[10] = '6666';
    badcode[11] = '7777';
    badcode[12] = '8888';
    badcode[13] = '9999';
    badcode[14] = '0123'; 

    if(username.length < 5 || username.length > 15)
        showError("namecheck", "Username must be between 5 and 15 characters long");
    else if(!myRegxp.test(username))
        showError("namecheck", "Username can only contain a-Z and 0-9");
    else if(pass1.length < 5 || pass1.length > 32)
        showError("pw1check", "Your password needs to be between 4 and 32 characters long");
    else if(pass1 != pass2)
        showError("pw2check", "The password u entered does not match the other");
    else if(!isValidEmailAddress(email))
        showError("mailcheck", "Please enter a valid email addres");
    else if(email != email2)
        showError("mailcheck2", "The email addresses you entered are not the same");
    else if(!codeRegxp.test(scode))
        showError("scodecheck", "Your code has to be ONLY numbers and has to be exactley 8 numbers long!");
    else if(contains(badcode, scode))
       showError("scodecheck", "This code is too simple");
    else if( available() == 1  )
        showError("namecheck", "This username already exists");
    else if( checkflood() == 1 )
        alert("U can only register 1 account every 10 minutes");
    else
    {
        $.post(url, $(this).serialize(),function(data) 
        { 
            $("#main_content").html(data).hide().fadeIn(300); 
        });
    }
   
});

function nameCheck()
{    
    var username = $("input[name='reg_uname']").val();
    var myRegxp = /^([a-zA-Z0-9_-]+)$/;
    
    if(username.length == 0)
        $('#namecheck').html('5-15 characters, letters / numbers only');
    else if(username.length >= 5 && username.length <= 15 && myRegxp.test(username))
    {
        if(available(username) == 0)
            $('#namecheck').html('<img src="tpl/images/ok.png" title="Username is available"/>');
        else
            $('#namecheck').html('<img src="tpl/images/nok.png" /> Username already in use');
    }
    else
       $('#namecheck').html('<img src="tpl/images/nok.png" /> Username is not valid, must be between 5 and 15 characters long and can only contain a-Z and 0-9'); 
    
}

function pw1Check()
{
    var pass1 = $("input[name='reg_pw1']").val();
    
    if(pass1.length == 0)
        $('#pw1check').html('5-15 characters long');
    else if(pass1.length < 5 || pass1.length > 32)
        $('#pw1check').html('<img src="tpl/images/nok.png" /> Password have to be between 5 and 32 characters long');
    else
        $('#pw1check').html('<img src="tpl/images/ok.png" />');
        
}

function pw2Check()
{
    var pass1 = $("input[name='reg_pw1']").val();
    var pass2 = $("input[name='reg_pw2']").val();
    
    if(pass2.length == 0)
        $('#pw2check').html('Again for verification');
    else if(pass1 != pass2)
        $('#pw2check').html('<img src="tpl/images/nok.png" /> The passwords dont match');
    else
        $('#pw2check').html('<img src="tpl/images/ok.png" />');        
}

function mailCheck()
{
    var email = $("input[name='reg_email']").val();
    
    if(email.length == 0)
        $('#mailcheck').html('A valid E-Mail address is required for account activation');
    else if(!isValidEmailAddress(email))
        $('#mailcheck').html('<img src="tpl/images/nok.png" /> Please enter a valid email address');
    else
        $('#mailcheck').html('<img src="tpl/images/ok.png" />');        
}

function mailCheck2()
{
    var email1 = $("input[name='reg_email']").val();
    var email2 = $("input[name='reg_email2']").val();
    
    if(email2.length == 0)
        $('#mailcheck2').html('Again for verification');
    else if(email1 != email2)
        $('#mailcheck2').html('<img src="tpl/images/nok.png" /> Email addresses are not the same');
    else
        $('#mailcheck2').html('<img src="tpl/images/ok.png" />');        
}


function scodeCheck()
{
    var scode = $("input[name='reg_scode']").val();
    var codeRegxp = /^([0-9]{4})$/;    
    var badcode = new Array();
    
    badcode[0] = '1234';
    badcode[2] = '9876';
    badcode[3] = '8765';
    badcode[4] = '0000';
    badcode[5] = '1111';
    badcode[6] = '2222';
    badcode[7] = '3333';
    badcode[8] = '4444';
    badcode[9] = '5555';
    badcode[10] = '6666';
    badcode[11] = '7777';
    badcode[12] = '8888';
    badcode[13] = '9999';
    badcode[14] = '0123';     
    
    
    if(scode.length == 0)
        $('#scodecheck').html('4 digits (numbers only)');
    else 
    if(!codeRegxp.test(scode))
        $('#scodecheck').html('<img src="tpl/images/nok.png" /> Your code has to be ONLY numbers and has to be exactley 8 numbers long!');
    else if(contains(badcode, scode))
        $('#scodecheck').html('<img src="tpl/images/nok.png" /> This code is too simple, please use a more difficult code');
    else
        $('#scodecheck').html('<img src="tpl/images/ok.png" />');    
}

function contains(a, obj) {
    for (var i = 0; i < a.length; i++) {
        if (a[i] === obj) {
            return true;
        }
    }
    return false;
}


function showError(type, msg)
{
    $('#' + type).hide();
    //$('#' + type).css("font-weight", "bold");
    $('#' + type).html('<span style="color:red;">' + msg + '</span>');
    $('#' + type).fadeIn(250);
}

function available(username) 
{
    
	return $.ajax({
      url: "check.php?check=userexist&username=" + username,
      async: false
    }).responseText
		
}

function checkflood()
{  
	return $.ajax({
      url: "check.php?check=regflood",
      async: false
    }).responseText  
}





function isValidEmailAddress(emailAddress) 
{
	var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	return pattern.test(emailAddress);
}

