<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    Admin Panel > Settings > Change Password<br /><br />
    <span>Change Password</span><br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : cpwform -->
    <form method="post" action="changepw.php" class="stdform">
    <table class="gmtable">
        <tr>
            <td class="gtd1" style="width:200px;">Old Password</td>
            <td class="gtd2"><input type="password" name="oldpw" /></td>
        </tr>
        <tr>
            <td class="gtd1">New Password</td>
            <td class="gtd2"><input type="password" name="newpw1" /></td>
        </tr>
        <tr>
            <td class="gtd1">New Password (again)</td>
            <td class="gtd2"><input type="password" name="newpw2" /></td>
        </tr>
        <tr>
            <td class="gtd3">&nbsp;</td>
            <td class="gtd4">
                <input type="submit" value="Change Password" />
                <input type="hidden" name="action" value="changepw" />
            </td>
        </tr>
    </table>
    </form>
    <!-- END BLOCK : cpwform -->
    
    
    
    <!-- START BLOCK : error -->
    <div style="margin-top:10px; text-align:center;">{msg}</div>
    <!-- END BLOCK : error -->
    
</div>