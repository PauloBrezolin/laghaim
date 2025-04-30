$("#cmform").unbind();
$("#cmform").bind('submit', function(event)
{
    event.preventDefault();

    var oldmail = $("input[name='cm_oldemail']").val();
    var newmail1 = $("input[name='cm_email1']").val();
    var newmail2 = $("input[name='cm_email2']").val();
    var scode = $("input[name='cm_scode']").val();

    var codeRegxp = /^([0-9]{4})$/;

    if(!isValidEmailAddress(oldmail))
        showError("oldemailcheck", "Please enter a valid email address");
    else if(!isValidEmailAddress(newmail1))
        showError("email1check", "Please enter a valid email address");
    else if(newmail1 != newmail2)
        showError("email2check", "The email addresses don't match");
    else if(!codeRegxp.test(scode))
        showError("scodecheck", "Your code have to be ONLY numbers and have to be exactley 8 numbers long!");

    else
    {
        $.post("changeemail.php", $("#cmform").serialize(),function(data) 
        { 
            $("#main_content").html(data).hide().fadeIn(300); 
        });
    }
   
});

function chk_cm_oldemail()
{
    var email = $("input[name='cm_oldemail']").val();
   
    if(isValidEmailAddress(email))
       $('#oldemailcheck').html('<img src="tpl/images/ok.png" />');
    else
       $('#oldemailcheck').html('<img src="tpl/images/nok.png" /> Please enter a valid e-mail address'); 
}




function chk_cm_scode()
{
    var scode = $("input[name='cm_scode']").val();
    var codeRegxp = /^([0-9]{4})$/;    
    
    if(!codeRegxp.test(scode))
        $('#scodecheck').html('<img src="tpl/images/nok.png" /> Please enter a valid security code');
    else
        $('#scodecheck').html('<img src="tpl/images/ok.png" />');    
}

function chk_cm_email1()
{
    var email1 = $("input[name='cm_email1']").val();
   
    if(!isValidEmailAddress(email1))
        $('#email1check').html('<img src="tpl/images/nok.png" /> Please enter a valid e-mail address');
    else
        $('#email1check').html('<img src="tpl/images/ok.png" />');
        
}

function chk_cm_email2()
{
    var email1 = $("input[name='cm_email1']").val();
    var email2 = $("input[name='cm_email2']").val();
    
    if(email1 != email2)
        $('#email2check').html('<img src="tpl/images/nok.png" /> The email addresses dont match');
    else
        $('#email2check').html('<img src="tpl/images/ok.png" />');        
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