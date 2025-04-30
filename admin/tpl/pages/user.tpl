<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">

    <head>
        <title>{servername}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="tpl/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="tpl/css/theme_brown.css" title="theme_brown"/>
        <link rel="alternate stylesheet" type="text/css" href="tpl/css/theme_blue.css" title="theme_blue" />
        <link rel="alternate stylesheet" type="text/css" href="tpl/css/theme_red.css" title="theme_red"/>
        <link rel="alternate stylesheet" type="text/css" href="tpl/css/theme_purple.css" title="theme_purple"/>
        <link rel="alternate stylesheet" type="text/css" href="tpl/css/theme_green.css" title="theme_green"/>
        <link rel="alternate stylesheet" type="text/css" href="tpl/css/theme_gray.css" title="theme_gray"/>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="tpl/css/jquery.toolbar.css" />
        <link rel="stylesheet" type="text/css" href="tpl/css/quill.snow.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script language="javascript" src="tpl/js/jquery.toolbar.min.js"></script>
        <script type="text/javascript" src="tpl/js/quill.min.js"></script>
        <script language="javascript" src="tpl/js/acpv2.js"></script>           
        <script language="javascript">

            var url = '{redirurl}';
            $('#cblock').html('&nbsp;<div style="width:100%; margin:25px auto; text-align:center;"><img src="tpl/img/loading2.gif" /></div>');

            $.get(url, '', function (response)
            {
                $('#cblock').html(response);
                $('#cblock').fadeIn(300);
            });

        </script>
    </head>


    <body>
        <div id="header"><span>{servername}</span> Signed in as {adminname} <span style="font-size:10px; color:#bbbbbb;">[<a style="color:#bbbbbb;" href="login.php?logout">Logout</a>]</span>
            <a href="" rel="theme_red" class="styleswitch" title="Switch to red"><img src="tpl/img/theme_red.jpg" /></a>
            <a href="" rel="theme_blue" class="styleswitch" title="Switch to blue"><img src="tpl/img/theme_blue.jpg" /></a>
            <a href="" rel="theme_green" class="styleswitch" title="Switch to green"><img src="tpl/img/theme_green.jpg" /></a>
            <a href="" rel="theme_brown" class="styleswitch" title="Switch to brown"><img src="tpl/img/theme_brown.jpg" /></a>
            <a href="" rel="theme_purple" class="styleswitch" title="Switch to purple"><img src="tpl/img/theme_purple.jpg" /></a>
            <a href="" rel="theme_gray" class="styleswitch" title="Switch to gray"><img src="tpl/img/theme_gray.jpg" /></a>
            <span id="debugdata" style="font-size:10px; color:#cccccc; margin-left:20px;"></span>
        </div>
        <!-- START BLOCK : error -->
        {msg}
        <!-- END BLOCK : error -->
        <table id="wraptable">
            <tr>
                <td class="menua">
                    <ul>
                        <li><a href="index.php"><i class="material-icons">&#xE8B6;</i><br />Search</a></li>                            
                        <li><a href="{lastuser_url}"  id="userbutton" class="active"><i class="material-icons">&#xE7FD;</i><br />Player</a></li>    
                        <li><a href="settings.php"><i class="material-icons">&#xE8B8;</i><br />Settings</a></li>                            
                        <li><a href="tickets.php"><i class="material-icons">&#xE151;</i><br />Tickets</a></li>                            
                        <li><a href="func.php"><i class="material-icons">&#xE5C3;</i><br />Functions</a></li>                            
                    </ul>                              
                </td>
                <td class="menub">
                    <dl>
                        <dt>User</dt>
                        <dd>
                            <ul>
                                {m_userinfo}
                                {m_lastlogin}
                                {m_emailchanges}
                                {m_notes}
                                {m_donations}
                                {m_bans}
                                {m_unstuck}
                                {m_logs}
                                {m_fish}
                                {m_reset}
                            </ul>
                        </dd>
                    </dl>

                    <dl>
                        <dt>Characters</dt>
                        <dd>
                            <ul>
                                <!-- START BLOCK : charlist -->
                                <li><a href="{url}" class="menulink">{name}</a></li>
                                <!-- END BLOCK : charlist -->
                            </ul>
                        </dd>
                    </dl>                          
                </td>
                <td class="contentblock">
                    <div id="cblock">
                        <div class="contentheader">
                            User<br /><br /><br />
                            <span>User</span><br /><br />
                        </div>                        
                    </div>
                    &nbsp;
                </td>
            </tr>                
        </table>
        <div id="ticketnum">35</div>
        <!-- START BLOCK : lastusers -->
        <div id="toolbaru" class="hidden">
           <!-- START BLOCK : lastuserslist -->
           <a href="{url}">{name}</a>
           <!-- END BLOCK : lastuserslist -->
        </div>
        <!-- END BLOCK : lastusers -->   
    </body>

</html>
