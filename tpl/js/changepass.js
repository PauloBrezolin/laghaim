$("#cpform").unbind();
$("#cpform").bind('submit', function(event)
{
    event.preventDefault();

    var oldpass = $("input[name='cp_pw1']").val();
    var pass1 = $("input[name='cp_pw1']").val();
    var pass2 = $("input[name='cp_pw2']").val();
    var scode = $("input[name='cp_scode']").val();

    var codeRegxp = /^([0-9]{4})$/;

    if(oldpass.length < 5 || oldpass.length > 32)
        showError("oldpwcheck", "Your password needs to be between 4 and 32 characters long");
    else if(pass1.length < 5 || pass1.length > 32)
        showError("pw1check", "Your password needs to be between 4 and 32 characters long");
    else if(pass1 != pass2)
        showError("pw2check", "The password u entered does not match the other");
    else if(!codeRegxp.test(scode))
        showError("scodecheck", "Your code have to be ONLY numbers and have to be exactley 4 numbers long!");
    else
    {
        $.post("changepass.php", $("#cpform").serialize(),function(data) 
        { 
            $("#main_content").html(data).hide().fadeIn(300); 
        });
    }
   
});

function chk_cp_oldpw()
{
    var pass1 = $("input[name='cp_oldpw']").val();
    
    if(pass1.length < 2 || pass1.length > 32)
        $('#oldpwcheck').html('<img src="tpl/images/nok.png" /> Password have to be between 5 and 32 characters long');
    else
        $('#oldpwcheck').html('<img src="tpl/images/ok.png" />');
}


function chk_cp_scode()
{
    var scode = $("input[name='cp_scode']").val();
    var codeRegxp = /^([0-9]{4})$/;    
    
    if(!codeRegxp.test(scode))
        $('#scodecheck').html('<img src="tpl/images/nok.png" />');
    else
        $('#scodecheck').html('<img src="tpl/images/ok.png" />');    
}

function chk_cp_pw1()
{
    var pass1 = $("input[name='cp_pw1']").val();
    
    if(pass1.length < 5 || pass1.length > 32)
        $('#pw1check').html('<img src="tpl/images/nok.png" /> Password have to be between 5 and 32 characters long');
    else
        $('#pw1check').html('<img src="tpl/images/ok.png" />');
        
}

function chk_cp_pw2()
{
    var pass1 = $("input[name='cp_pw1']").val();
    var pass2 = $("input[name='cp_pw2']").val();
    
    if(pass1 != pass2)
        $('#pw2check').html('<img src="tpl/images/nok.png" /> The passwords dont match');
    else
        $('#pw2check').html('<img src="tpl/images/ok.png" />');        
}



function showError(type, msg)
{
    $('#' + type).hide();
    //$('#' + type).css("font-weight", "bold");
    $('#' + type).html('<span style="color:red;">' + msg + '</span>');
    $('#' + type).fadeIn(250);
}

function isValidEmailAddress(emailAddress) 
{
	var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	return pattern.test(emailAddress);
}