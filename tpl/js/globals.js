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

function setCash(cash)
{
    $('#g_cash').html(cash);
}