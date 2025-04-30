<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    IP Banning<br /><br /><br />
    <span>IP Banning</span><br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : banform -->
    <form method="post" action="ipban.php" class="stdform">
    <table class="git">
        <tr>
            <td class="gitd1">Ip Address</td>
            <td class="gitd2"><input type="text" name="ip" maxlength="15" size="18" /></td>
        </tr>
        <tr>
            <td class="gitd1">Reason</td>
            <td class="gitd2"><input type="text" name="reason" size="50" /></td>
        </tr>
        <tr>
            <td class="gitd3">&nbsp;</td>
            <td class="gitd4">
                <input type="submit" value="Ban the sucker!" size="50" />
                <input type="hidden" name="action" value="ipban" />
            </td>
        </tr>
    </table>
    </form>
    <br /><br />
    <!-- END BLOCK : banform -->
    
    
    <!-- START BLOCK : ipblock -->
    <table class="filltable">
        <tr>
            <th width="150">Date</th>
            <th width="150">IP</th>
            <th width="200">GM</th>
            <th>Reason</th>
            <th></th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td>{date}</td>
            <td>{ip}</td>
            <td>{gm}</td>
            <td>{reason}</td>
            <td style="text-align:right;">{delete}</td>
        </tr>
        <!-- END BLOCK : list -->
    </table>
    <!-- END BLOCK : ipblock -->
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->    