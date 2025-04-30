<!-- INCLUDE BLOCK : cpmenu -->

<!-- START BLOCK : changepassform -->
<script src="tpl/js/changepass.js" type="text/javascript"></script>

<form method="post" id="cpform" action="cp_changepass.php">
<div class="areaopac color3">    
    <div class="normal_title">Password Information</div>
        <div style="padding-left:20px; padding-right:20px;">
            <table>
                <tr>
                    <td width="120">Old password</td>
                    <td><input type="password" name="cp_oldpw" maxlength="30" onchange="chk_cp_oldpw();" class="form_field" /></td>
                    <td id="oldpwcheck">Please enter your old password</span></td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td><input type="password"  name="cp_pw1" maxlength="30" onchange="chk_cp_pw1();" class="form_field" /></td>
                    <td id="pw1check">Enter the new password u would like to have</td>
                </tr>
                <tr>
                    <td>New password (again)</td>
                    <td><input type="password" name="cp_pw2" maxlength="30" onchange="chk_cp_pw2();" class="form_field" /></td>
                    <td id="pw2check">Enter the new password again</td>
                </tr>
            </table>
    </div>
</div>
<br />
<div class="areaopac color3">
    <div class="normal_title">Security Information</div>
    <div id="content_page">
        <div style="padding-left:20px; padding-right:20px;">
            <table>
                <tr>
                    <td width="120">Security Code</td>
                    <td><input type="text" name="cp_scode" maxlength="8" onchange="chk_cp_scode();" class="form_field" /></td>
                    <td id="scodecheck">Enter your security code</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br />                    
<div align="center">
    <input type="submit" value="Change my password" class="btn" />
    <input type="hidden" name="action" value="changepass" />
</div>
</form>
<!-- END BLOCK : changepassform -->


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