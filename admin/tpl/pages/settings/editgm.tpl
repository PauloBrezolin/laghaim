<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    Admin Panel > Settings > Edit GameMasters<br /><br />
    <span>Edit GameMasters</span><br /><br />
</div>

<div class="content">

    <!-- START BLOCK : editgm -->
    <form method="post" action="settings.php">

        <table class="gmtable">
            <tr>
                <th colspan="2">Login Details</th>
            </tr>
            <tr>
                <td class="gtd1">Username</td>
                <td class="gtd2"><input type="text" name="username" value="{username}" /></td>
            </tr>
            <tr>
                <td class="gtd1">Password</td>
                <td class="gtd2"><input type="text" name="password" /> <span style="font-size:10px;">Leave empty for no change</span></td>
            </tr>
            <tr>
                <th colspan="2">GM Settings</th>
            </tr>
            <tr>
                <td class="gtd1">Display Name</td>
                <td class="gtd2"><input type="text" name="displayname" value="{displayname}" /></td>
            </tr>
            <tr>
                <td class="gtd1">Rights</td>
                <td class="gtd2">
                    <select name="role">
                        <!-- START BLOCK : rolelist2 -->
                        <option value="{id}" {selected}>{name}</option>
                        <!-- END BLOCK : rolelist2 -->
                    </select>
                </td>
            </tr>
            <tr>
                <td class="gtd1">Activated</td>
                <td class="gtd2"><input type="checkbox" name="enable" value="yes" {enable} /></td>
            </tr>
            <tr>
                <td class="gtd3">&nbsp;</td>
                <td class="gtd4">
                    <input type="submit" value="Save" />
                    <input type="hidden" name="action" value="editgm" />
                    <input type="hidden" name="gmid" value="{gmid}" />
                </td>
            </tr>
        </table>
    </form>
    <div style="text-align:center; margin-top:25px;"><a href="gmlog.php?aid={gmid}" class="menulink">View Logs</a></div>
    <!-- END BLOCK : editgm -->    

    
    <!-- START BLOCK : newgm -->
    <form method="post" action="settings.php">

        <table class="gmtable">
            <tr>
                <th colspan="2">Login Details</th>
            </tr>
            <tr>
                <td class="gtd1">Username</td>
                <td class="gtd2"><input type="text" name="username" /></td>
            </tr>
            <tr>
                <td class="gtd1">Password</td>
                <td class="gtd2"><input type="text" name="password" /></td>
            </tr>
            <tr>
                <th colspan="2">GM Settings</th>
            </tr>
            <tr>
                <td class="gtd1">Display Name</td>
                <td class="gtd2"><input type="text" name="displayname" /></td>
            </tr>
            <tr>
                <td class="gtd1">Rights</td>
                <td class="gtd2">
                    <select name="role">
                        <!-- START BLOCK : rolelist -->
                        <option value="{id}">{name}</option>
                        <!-- END BLOCK : rolelist -->
                    </select>
                </td>
            </tr>
            <tr>
                <td class="gtd1">Activated</td>
                <td class="gtd2"><input type="checkbox" name="enable" value="yes" /></td>
            </tr>
            <tr>
                <td class="gtd3">&nbsp;</td>
                <td class="gtd4">
                    <input type="submit" value="Create GM" />
                    <input type="hidden" name="action" value="newgm" />
                </td>
            </tr>
        </table>
    </form>
    <!-- END BLOCK : newgm -->      


<!-- START BLOCK : error -->
{msg}
<!-- END BLOCK : error -->

</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->  