<!-- INCLUDE BLOCK : cpmenu -->

<!-- START BLOCK : changeemail -->
<script src="tpl/js/changeemail.js" type="text/javascript"></script>

<form method="post" id="cmform" action="cp_changeemail.php">
<div class="areaopac color3">
    <div class="normal_title">Password Information</div>
    <div style="padding-left:20px; padding-right:20px;">
        <table>
            <tr>
                <td width="120">Old email</td>
                <td><input type="text" size="30" name="cm_oldemail" maxlength="100" onchange="chk_cm_oldemail();" class="form_field" /></td>
                <td id="oldemailcheck">Please enter your old e-mail address</td>
            </tr>
            <tr>
                <td>New email</td>
                <td><input type="text" size="30"  name="cm_email1" maxlength="100" onchange="chk_cm_email1();" class="form_field" /></td>
                <td id="email1check">Enter the new e-mail address u would like to use</td>
            </tr>
            <tr>
                <td>New email again</td>
                <td><input type="text" size="30" name="cm_email2" maxlength="100" onchange="chk_cm_email2();" class="form_field" /></td>
                <td id="email2check">Enter the new e-mail address again</td>
            </tr>
        </table>
    </div>
</div>
<br />

<div class="areaopac color3">
    <div class="normal_title">Security Information</div>
    <div style="padding-left:20px; padding-right:20px;">
        <table>
            <tr>
                <td width="120">Security Code</td>
                <td><input type="text" name="cm_scode" maxlength="8" onchange="chk_cp_scode();" class="form_field" /></td>
                <td id="scodecheck">Enter your security code</td>
            </tr>
        </table>
    </div>
</div>
<br />                    

<div align="center">
    <input type="submit" value="Change my e-mail address" class="btn" />
    <input type="hidden" name="action" value="changeemail" />
</div>
</form>
<!-- END BLOCK : changeemail -->


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