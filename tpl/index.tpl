<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Laghaim Genericname01</title>
        <link rel="stylesheet" href="tpl/css/style.css" type="text/css" />
        <link rel="icon" href="tpl/images/favicon.ico" type="image/x-icon" /> 
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="tpl/js/jquery-1.9.0.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="tpl/js/skdslider.min.js"></script>
        <link href="tpl/css/skdslider.css" rel="stylesheet" />
        <script type="text/javascript" src="tpl/js/news.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#lhgn01').skdslider({delay:5000, animationSpeed: 1000,showNextPrev:true,showPlayButton:false,autoSlide:true,animationType:'sliding'});
            });

            function clock() {
                document.write('<span id="clock"></span>');

                var server = new Date({servertime}).getTime();
                var client = new Date().getTime();
                tick(client - server);
            }

            function tick(diff) {
                var d = new Date(new Date().getTime() - diff);
                var i = d.getMinutes();
                if (i < 10)
                    i = '0' + i;
                var s = d.getSeconds();
                if (s < 10)
                    s = '0' + s;
                var clock = document.getElementById("clock");
                if (clock) {
                    clock.innerHTML = '' +
                            d.getHours() + ':' + i + ':' + s;
                    setTimeout('tick(' + diff + ');', 1000);
                }
            }
        </script>
        <script type="text/javascript" src="tpl/js/home.js"></script>
        {page}
    </head>
    <body>
        <!-- Warpper -->
        <div id="warpper_bottom">
            <div id="warpper_top">
                <!-- Fluid Width -->
                <div id="fluid">
                    <!-- One Side -->
                    <div id="top-area">
                        <!-- She Move Like Star -->
                        <div id="she-move">
                            <!-- Right Top Modules -->
                            <div id="we-not">
                                <!-- Login Panel -->

                                <div id="login-panel">
                                    <!-- START BLOCK : loginbuttons -->
                                    <input type="image" id="login_btn" value="" src="tpl/images/login.jpg" />
                                    <div id="middle" style="margin-left:10px;">
                                        <a href="lostpw.php" id="lost" class="menuitem">Lost Password ?</a>
                                    </div>
                                    <!-- END BLOCK : loginbuttons -->

                                    <!-- START BLOCK : userbox -->
                                    <table id="userbox">
                                        <tr>
                                            <td width="250">Signed in as {username} <span>[<a href="index.php?do=logout">Logout</a>]<br />[<a href="changepass.php" class="menuitem">Change Password</a>] [<a href="changeemail.php" class="menuitem">Change E-Mail</a>] [<a href="#" class="unstucklink">Unstuck</a>]</span></td>
                                            <td><img src="tpl/images/coins-icon.png" alt="Cash" /> <span id="g_cash">{cash}</span></td>
                                        </tr>
                                    </table>
                                    <!-- END BLOCK : userbox -->
                                </div>
                                <!-- Game Navigation -->
                                <div>
                                    <div align="center" class="nav"> 
                                        <a href="register.php" class="menuitem">Account Registration</a> 
                                        <a href="download.php" class="menuitem">Downloads</a>       
                                        <a href="donate.php" class="menuitem">Donations</a>       
                                        <a href="http://forum.lhgenericname01.lc" target="_blank">Forums</a> 											
                                        <a href="tickets.php" class="menuitem">Contact Us</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content">
                        <!-- Content Side -->
                        <div id="content_left">
                            <!-- Server Informations -->
                            <div id="addon-3">
                                <!-- Server Informations -->
                                <div id="server-info"></div>
                                <div>
                                    <div id="line-space"></div>
                                    <div id="server-information-block">
                                        <div id="left-block">Experience</div>
                                        <div id="right-block">x25</div> 
                                    </div>
                                    <div id="server-information-block">
                                        <div id="left-block">Drop Rate</div>
                                        <div id="right-block">x10</div> 
                                    </div>
                                    <div id="server-information-block">
                                        <div id="left-block">Laim Rate</div>
                                        <div id="right-block">x10</div> 
                                    </div>
                                    <div id="line-space"></div>
                                        <div id="server-information-block">Shilon</div>
                                        <div id="server-information-block">
                                            <div id="left-block">{shilon_guild}</div>
                                            <div id="right-block">{shilon_time}</div> 
                                        </div>
                                        <div id="server-information-block">White Horn</div>
                                        <div id="server-information-block">
                                            <div id="left-block">{whitehorn_guild}</div>
                                            <div id="right-block">{whitehorn_time}</div> 
                                        </div>
                                        <div id="server-information-block">Mobius</div>
                                        <div id="server-information-block">
                                            <div id="left-block">Mobius Event</div>
                                            <div id="right-block">{mobius}</div> 
                                        </div>
                                </div>
                                <!-- Quick Links -->
                                <div id="quick_links"></div>
                                <div id="line-space"></div>
                                <div id="links"><a href="ranking.php" class="menuitem">Player Ranking</a></div>
                                <div id="links"><a href="tickets.php" class="menuitem">Report Bugs / Players</a></div>
                                <div id="links"><a href="rules.php" class="menuitem">Ingame Rules</a></div>
                                <div id="links"><a href="tos.php" class="menuitem">Terms of Service</a></div>
                                <div id="links"><a href="tmp_valiant.php" class="menuitem">Claim Rewards - Level Event Valiant</a></div>
                                <!-- Top 10 Characters -->
                                <div id="rank-mod">
                                    <div id="rank-title"></div>
                                    <div id="rank-bg">
                                        <table width="180" border="0" align="center" cellpadding="0" cellspacing="1" id="table_mod">
                                            <tbody>
                                                <!-- START BLOCK : rank -->
                                                <tr>
                                                    <td width="37" height="29"><div align="center">{num}</div></td>
                                                    <td width="139" height="29"><div style=" padding-left:10px;"><b>{name}</b></div></td>
                                                    <td width="48" height="29"><div align="center">{level}</div></td>
                                                </tr>
                                                <!-- END BLOCK : rank -->
                                            </tbody>
                                        </table>
                                        <a href="ranking.php" class="menuitem"><div id="classic-rank">Classic Ranking</div></a> 
                                        <a href="petranking.php" class="menuitem"><div id="classic-rank">Pet Ranking</div></a>
                                    </div>
                                    <div id="rank-bottom"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Side Right -->
                        <div id="content_fluid">
                            <div id="addon-1">
                                <div style="margin:0 auto;">
                                    <ul id="lhgn01">
                                        <li><img src="tpl/images/slide1.jpg" /></li>
                                        <li><img src="tpl/images/slide2.jpg" /></li>
                                        <li><img src="tpl/images/slide3.jpg" /></li>
                                    </ul>
                                </div>
                                <div id="news_center">
                                    <div id="main_content">

                                        <!-- START BLOCK : announcements -->
                                        <div class="news_title" {open}>
                                            <div id="news_t">{title}</div>
                                        </div>
                                        <div class="news_content"  style="width: 100% !important;">
                                            <div id="news_board">
                                                <div id="on_content">{content}</div>
                                                <div id="news_info">Posted at {date} by <i>{poster}</i></div>
                                            </div>
                                        </div>
                                        <!-- END BLOCK : announcements -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom -->
                <div id="bottom">
                    <div id="lhGN-footer-bottom">
                        <div id="addon-2"></div>
                        <h2>GENERICNAME GAMES - MMOPRG Online Games</h2>
                        <div id="category">                
                            <h3>MMORPG GAMES</h3>                
                            <ul>                    
                                <li>
                                    <a href="http://www.lcgenericname02.lc" target="_blank">LastChaos Episode 4 - Newest Updates</a> 
                                    <span>Official Website !</span>
                                </li>
                                <li>
                                    <a href="http://www.lcgenericname02.lc" rel="">Laghaim Online</a> 
                                    <span>You already are here !</span>
                                </li>  
                            </ul>            
                        </div>
                        <div id="category">                
                            <h3>SUPPORT</h3>                
                            <ul>                    
                                <li>
                                    <a href="http://forum.lhgenericname01.lc/" target="_blank">News & Announcements</a> 
                                </li>
                                <li>
                                    <a href="tickets.php" class="menuitem">Contact Us</a> 
                                </li> 
                            </ul>            
                        </div>
                        <div id="category">                

                        </div>
                        <h1></h1>
                    </div>
                </div>
            </div>
        </div>






        <!-- CloudFlare Jquery All -->


        <!-- Flex Slider JavaScript Code -->
        <span style="position:absolute; left:10px; top:10px;">LHGN Server Time [ <script type="text/javascript">clock();</script> ]</span>
<div id="logindialog" title="Login to LHGenericName01"></div>        
    </body>
</html>