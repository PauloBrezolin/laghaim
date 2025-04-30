$(document).ready(function ()
{
    $('.menulink').unbind();
    $('.menulink').bind('click', function (event)
    {
        event.preventDefault();

        var url = this.href;

        $('#cblock').html('&nbsp;<div style="width:100%; margin:25px auto; text-align:center;"><img src="tpl/img/loading2.gif" /></div>');
        $.get(url, {}, function (response)
        {
            $('#cblock').html(response);
        });
    });


    $('#ticketnum').hide();
    checktickets();

    function checktickets()
    {
        var num = $.ajax({
            url: "ticketcheck.php",
            async: false
        }).responseText

        $('#ticketnum').html(num);

        if (num == '0' && $('#ticketnum').is(':visible'))
            $('#ticketnum').fadeOut(300);

        if (num != '0' && !$('#ticketnum').is(':visible'))
            $('#ticketnum').fadeIn(300);

    }

    $('#tgo').unbind();
    $('#tgo').bind('click', function (event)
    {
        event.preventDefault();

        var num = $('#tid').val();
        var url = 'ticket_view.php?tid=' + num;

        $('#cblock').html('&nbsp;<div style="width:100%; margin:25px auto; text-align:center;"><img src="tpl/img/loading2.gif" /></div>');

        $.get(url, {}, function (response)
        {
            $('#cblock').html(response);
        });
    });

    $('.stdform').unbind();
    $('.stdform').bind('submit', function (event)
    {
        event.preventDefault();
        var url = $(this).attr('action');

        $.post(url, $(this).serialize(), function (data)
        {
            $("#cblock").html(data);
        });
    });


    $('.styleswitch').click(function ()
    {
        switchStylestyle(this.getAttribute("rel"));
        return false;
    });

    var c = readCookie('style');
    if (c)
        switchStylestyle(c);

    function switchStylestyle(styleName)
    {
        $('link[rel*=style][title]').each(function (i)
        {
            this.disabled = true;
            if (this.getAttribute('title') == styleName)
                this.disabled = false;
        });
        createCookie('style', styleName, 365);
    }

    function createCookie(name, value, days)
    {
        if (days)
        {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else
            var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    }
    function readCookie(name)
    {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++)
        {
            var c = ca[i];
            while (c.charAt(0) == ' ')
                c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0)
                return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    function eraseCookie(name)
    {
        createCookie(name, "", -1);
    }

    $('#userbutton').toolbar({
        content: '#toolbaru',
        position: 'right'
    });

    $('.showreason').unbind();
    $('.showreason').bind('click', function (event) {

        event.preventDefault();

        var num = $(this).attr('href');
        $('.reason' + num).toggle('slow');
    });

});