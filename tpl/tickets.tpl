<script src="tpl/js/globals.js" type="text/javascript"></script>
<script src="tpl/js/tickets.js" type="text/javascript"></script>
<!-- START BLOCK : base -->
<div class="areaopac color3">
    <div id="padding">
        <div style="text-align: center; font-size:18px;"><a href="tickets.php?t=new" class="menuitem">Create new ticket</a> | <a href="tickets.php?t=view" class="menuitem">View my tickets</a></div>
    </div>
</div>
<!-- END BLOCK : base -->

<!-- START BLOCK : newticket -->
<form id="stdform" action="tickets.php?t=new" method="post">
<div class="areaopac color3">
    <div class="normal_title">Create a new support ticket</div>
    <div style="padding-left:20px;">
        <p>Please be sure to enter a valid email address and don't forget the code you enter<br />The reason is that you will be notified by email about your ticket.<br />You need to provide a code to make sure nobody besides you and the staff can read your ticket.<br />This code is also needed to view your tickets.<br />If you enter the same email and code as previous tickets, those tickets will show up together in your ticket list<br />If you want to access your tickets without code, just leave it empty.</p>
    </div>
</div>
<br />

<div class="areaopac color3">
    <div class="normal_title">Contact Information</div>
    <div style="padding-left:20px;">        
        <table>
            <tr>
                <td>Email *</td>
                <td><input type="text" size="50" name="email" class="form_field2" value="{email}"></td>
            </tr>
            <tr>
                <td>Code</td>
                <td><input type="text" size="10" name="code" class="form_field2"> <sup>(Optional)</sup></td>
            </tr>
        </table>
    </div>
</div>
            
<br />
<div class="areaopac color3">
    <div class="normal_title">Ticket Information</div>
    <div style="padding-left:20px;"> 
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="{username}"  class="form_field2" /> <sup>(Optional, but it will make it easier for us)</sup></td>
            </tr>
            <tr>
                <td>Charactername</td>
                <td><input type="text" name="charname"  class="form_field2" /> <sup>(Optional)</sup></td>
            </tr>
                <td>Title *</td>
                <td><input type="text" size="60" name="title"  class="form_field2"></td>
            </tr>
        </table>
    </div>
</div>
<br />

<div class="areaopac color3">
    <div class="normal_title">Ticket Information</div>
    <div style="padding-left:20px; padding-right: 20px;"> 
        If you would like to add a screenshot to your ticket please use a 3th party website to do so.<br />One example is <a href="http://www.imageupload.co.uk/" target="_blank">http://www.imageupload.co.uk/</a>. For video's we generally recommend it to upload on <a href="http://www.youtube.com" target="_blank">YouTube</a>, private if required.<br />Please not that we will keep the video or screenshot confidential. In case of a report the video, screenshot or your identity will <b>NOT</b> be shown to the person that is being reported.<br /><br />            
        <textarea rows="10" cols="85" name="msg"  class="form_field3" style="width:100%"></textarea>
    </div>
</div>
<br />
<div align="center">
    <input type="submit" value="Send my ticket" class="btn"/>
    <input type="hidden" name="action" value="postnew" />
</div>
</form>
<!-- END BLOCK : newticket -->







<!-- START BLOCK : loginticket -->
<form id="stdform" action="tickets.php?t=view">
    <div class="areaopac color3">
        <div class="normal_title">Ticket Login</div>
        <div id="content_page">
            <div style="padding-left:20px;">

                <table id="regtable">
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" size="50" class="form_field" /></td>
                        <td>Code</td>
                        <td><input type="text" size="10" name="code" class="form_field" ></td>  
                        <td><input type="hidden" name="action" value="loginticket" /></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div style="text-align: center;"><input type="submit" value="Get my tickets" class="btn" /></div>
</form>
<!-- END BLOCK : loginticket -->






<!-- START BLOCK : viewtickets -->
<div class="areaopac color3">
    <div class="normal_title">Ticket List</div>
        <div style="padding-left:20px;">
            <table width="100%">
                <tr>
                    <th width="20" style="text-align:left;">&nbsp;</th>
                    <th width="50" style="text-align:left;">ID</th>
                    <th style="text-align:left;">Subject</th>
                    <th width="40" style="text-align:left;">Replys</th>
                </tr>
                <!-- START BLOCK : ticketlist -->
                <tr>
                    <td><img src="{icon}" /></td>
                    <td>#{id}</td>
                    <td><a href="{url}" class="menuitem">{title}</a></td>
                    <td>{replys}</td>
                </tr>
                <!-- END BLOCK : ticketlist -->
           </table>
        </div>
</div>
<div style="text-align: center; margin-top:25px;"><a class="btn menuitem" href="tickets.php?logout=true">Log Off</a></div>
<!-- END BLOCK : viewtickets -->





<!-- START BLOCK : myticket -->
<div class="areaopac color3">
    <div class="normal_title">Ticket Information</div>
    <div id="content_page">
        <div style="padding-left:20px;">
            <table width="100%">
                <tr>
                    <td width="100"><b>Ticket Id</b></td>
                    <td>#{id}</td>
                </tr>
                <tr>
                    <td width="100"><b>Subject</b></td>
                    <td>{title}</td>
                </tr>
                <tr>
                    <td><b>Username</b></td>
                    <td>{username}</td>
                </tr>
                <tr>
                    <td><b>Charname</b></td>
                    <td>{charname}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br />

<div class="areaopac color3">
    <div class="normal_title">Message</div>
    <div id="content_page">
        <div style="padding-left:20px;">
            {msg}
        </div>
    </div>
</div>
<br />

<div class="areaopac color3">
    <div class="normal_title">Replies</div>
    <div id="content_page">
        <div style="padding-left:20px; padding-right: 20px;">
            <!-- START BLOCK : reply -->
            <div style="margin:10px 0; border:1px solid #222222; border-width:1px 2px 2px 1px; padding:5px; background-color:{color};text-shadow:none;box-shadow: 0 0 6px rgba(53, 53, 53, 1), 1px 2px 1px rgba(42, 43, 52, 1), inset 0 0 1px rgba(71, 68, 75, 1), inset 0 0 19px rgba(98, 98, 98, 1);border-radius:5px;">
                <div style="font-style: italic; color:#333333; margin:0 10px; border-bottom:1px dotted #222222;">Posted by <b>{user}</b> at {date}</div>                
                <div style="color:black; margin:5px 10px; ">{msg}</div>
            </div>
            <!-- END BLOCK : reply -->
        </div>
    </div>
</div>
<br />

<!-- START BLOCK : newreply -->
<div class="areaopac color3">
    <div class="normal_title">New Reply</div>
    <div id="content_page">
        <div style="padding-left:20px; padding-right:20px;">
            If you would like to add a screenshot to your ticket please use a 3th party website to do so.<br />One example is <a href="http://www.imageupload.co.uk/" target="_blank">http://www.imageupload.co.uk/</a>. For video's we generally recommend it to upload on <a href="http://www.youtube.com" target="_blank">YouTube</a>, private if required.<br />Please not that we will keep the video or screenshot confidential. In case of a report the video, screenshot or your identity will <b>NOT</b> be shown to the person that is being reported.<br /><br />
            <form id="stdform" action="{action}">            
                <textarea rows="10" cols="85" name="msg" class="form_field3" style="width:100%;"></textarea>
                <br /><br />
                <div align="center"><input type="submit" value="Send Reply" class="btn" /></div>
                <br />
                <input type="hidden" name="action" value="addreply" />
            </form>
        </div>
    </div>
</div>
<!-- END BLOCK : newreply -->
<ul>
    <li><a href="{url_close}" class="menuitem">Close this ticket</a></li>
    <li><a href="{url_back}" class="menuitem">Back to my ticket list</a></li>
    <li><a href="{url_new}" class="menuitem">Create new ticket</a></li>
</ul>
<!-- END BLOCK : myticket -->


<!-- START BLOCK : error -->
<div class="areaopac color3" style="background-color:#FFD4D4;">
    <div id="padding">
        <div id="error">{title}</div>
        <div id="content_page">{msg}</div>
    </div>
</div>
<!-- END BLOCK : error -->

<!-- START BLOCK : success -->
<div class="areaopac color3" style="background-color:#D4FFD4;">
    <div id="padding">
        <div id="success">{title}</div>
        <div id="content_page">{msg}</div>
    </div>
</div>
<!-- END BLOCK : success -->
