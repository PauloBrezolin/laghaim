$(document).ready(function ()
{
    $('.menuitem').unbind();
    $('.menuitem').bind('click', function (event)
    {
        event.preventDefault();

        var url = this.href;

        $('#main_content').fadeOut(300, function ()
        {
            $('#main_content').html('<div style="width:100px; margin:25px auto;"><img src="tpl/images/loading.gif" /></div>');

            $.get(url, {}, function (response)
            {
                $('#main_content').hide();
                $('#main_content').html(response);
                $('#main_content').fadeIn(300);

            });
        });

    });


    $("#stdform").unbind();
    $("#stdform").bind('submit', function (event)
    {
        var url = $(this).attr("action");
        event.preventDefault();

        $.post(url, $(this).serialize(), function (data)
        {
            $("#main_content").html(data).hide().fadeIn(300);
        });

        window.scrollTo(0, 350);
    });
    
    $('.unstucklink').unbind();
    $('.unstucklink').bind('click', function (event)
    {
        alert('Unstuck function is currently unavailable. Please write a ticket if your account is stuck longer then 30 minutes');
        /*
        if(confirm("Are you sure that you want to unstuck your account?"))
        {
            var result = $.ajax({ url: "worker.php?action=unstuck", async: false }).responseText;
            if(result == '1')
                alert("Your account was added to the list and will be unstuck in the next 5 minutes");
            else
                alert('Failed to add your account to the list, please try again later');
        }
        */
    });
    
    $("#login_btn").unbind();
    $("#login_btn").bind('click', function(event){
        event.preventDefault();
        $("#logindialog").load('login.php').dialog({modal:true}); 
    });    

});
