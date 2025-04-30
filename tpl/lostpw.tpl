<script src="tpl/js/globals.js" type="text/javascript"></script>
<!-- START BLOCK : needlogout -->
<table>
    <tr>
        <td><img src="tpl/images/error.png" /></td>
        <td> U need to be logged off to use this feature</td>
    </tr>
</table>
<!-- END BLOCK : needlogout -->

<!-- START BLOCK : lostpwform -->
<form method="post" id="stdform" action="lostpw.php?q=lost">
<div class="areaopac color3">
    <div class="normal_title">Password Recovery</div>
    <div id="content_page">
        <div style="padding-left:20px;">    
            <table>
                <tr>
                    <td width="100">Username</td>
                    <td><input type="text" name="req_uname" maxlength="30" class="form_field"/></td>
                    <td>Enter the username of the account you want to request the password for</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br />
<div class="areaopac color3">
    <div class="normal_title">Security Information</div>
    <div id="content_page">
        <div style="padding-left:20px;">
            <table>
                <tr>
                    <td width="100">Security Code</td>
                    <td><input type="text" name="req_scode" maxlength="8" class="form_field" /></td>
                    <td>Enter your security code</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br />
<div align="center">
    <input type="submit" value="Request my password" class="btn" />
    <input type="hidden" name="action" value="sendmail" />
</div>
</form>
<!-- END BLOCK : lostpwform -->




<!-- START BLOCK : entercodeform -->
<form method="post" id="stdform" action="lostpw.php?q=code">
<div class="areaopac color3">    
    <div class="normal_title">Recovery Information</div>
    <div style="padding-left:20px;">    
        <table>
            <tr>
                <td width="110">Username</td>
                <td><input type="text" name="cpw_uname" maxlength="15" class="form_field" /></td>
                <td>Enter the username of the account u requested the password for</td>
            </tr>
            <tr>
                <td>E-mailed Code</td>
                <td><input type="text" name="cpw_mcode" maxlength="8" class="form_field"  value="{code}"/></td>
                <td>The code that was emailed to you (already filled in for you)</td>
            </tr>  
        </table>
    </div>
</div>
<br />    

<div class="areaopac color3">
    <div class="normal_title"><div id="news_t">New Password</div></div>
    <div style="padding-left:20px;">    
        <table>
            <tr>
               <td width="110">New Password</td>
               <td><input type="password" name="cpw_pw1" maxlength="30" class="form_field" /></td>
               <td>Enter your new password here</td>
           </tr> 
           <tr>
               <td>New Password (Again)</td>
               <td><input type="password" name="cpw_pw2" maxlength="30" class="form_field" /></td>
               <td>Please enter your new password again</td>
           </tr>         
        </table>
    </div>
</div>
<br />             

<div class="areaopac color3">
    <div class="normal_title">Security Information</div>
    <div style="padding-left:20px;">
        <table>
            <tr>
                <td width="110">Security Code</td>
                <td><input type="text" name="cpw_scode" maxlength="8" class="form_field" /></td>
                <td>Enter your security code</td>
            </tr>
        </table>
    </div>
</div>
<br />
<div align="center">
    <input type="submit" value="Save my new password" class="btn" />
    <input type="hidden" name="action" value="changepw" />
</div>
</form>
<!-- END BLOCK : entercodeform -->

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