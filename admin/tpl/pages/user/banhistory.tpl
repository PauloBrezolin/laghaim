<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    {onlinedot} {username} > Ban History<br /><br /><br />
    <span>Ban History</span> {banned}<br /><br />
</div>
                        
<div class="content">
    
    
    <!-- START BLOCK : setban -->
    <form method="post" action="banhistory.php?uid={uid}" class="stdform">
    <table cellspacing="0" cellpadding="2" style="width:550px; margin:0 auto;">
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:11px; font-weight:bold;">{gm}</td>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:10px; font-style: italic;">{date}</td>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:11px; font-weight:bold; border-left: 1px dotted #cccccc;">
                <select name="time" style="font-size:10px;">
                        <option value="9999">Permanent</option>
                        <option value="1">1 Day</option>
                        <option value="2">2 Days</option>
                        <option value="3">3 Days</option>
                        <option value="7">1 Week</option>
                        <option value="14">2 Weeks</option>
                        <option value="30">1 Month</option>
                </select>                
            </td>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 2px 0 0; font-size:10px; font-weight:bold; border-left: 1px dotted #cccccc; width:60px; text-align:center;">{action}</td>
        </tr>								
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:0 2px 0 1px; border-top:1px dotted #cccccc;" colspan="4"><textarea style="width:535px;" rows="7" name="msg"></textarea></td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:0 2px 0 1px; border-top:1px dotted #cccccc; font-size:10px;" colspan="4">
                <input type="checkbox" name="sendmail" value="yes" checked="checked" />Send email<br />
                <input type="checkbox" name="sendreason" value="yes" checked="checked" />Send Reason in email
            </td>
        </tr>                                      
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:0 2px 0 1px; border-top:1px dotted #cccccc; font-size:10px;" colspan="4">
                Additional notes (won't be shown to player)<br />
                <textarea style="width:535px;" rows="3" name="msg2"></textarea>
            </td>
        </tr>                                      
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:0 2px 2px 1px; border-top:1px dotted #cccccc; font-size:10px;" colspan="4">
                <input type="submit" value="Perform Action" />
                <input type="hidden" name="action" value="{act}" />
            </td>
        <tr>
            <td colspan="4">&nbsp;<br /><br /></td>
        </tr>
    </table> 
    </form>
    <!-- END BLOCK : setban -->
    
    
    
    <!-- START BLOCK : banlist -->
    
    <table cellspacing="0" cellpadding="2" style="width:550px; margin:0 auto;">
        <!-- START BLOCK : showlist -->
        <!-- START BLOCK : list -->
        <tr>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:11px; font-weight:bold;">{gm}</td>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:10px; font-style: italic;">{date}</td>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:11px; font-weight:bold; border-left: 1px dotted #cccccc;">{bantime}</td>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 2px 0 0; font-size:10px; font-weight:bold; border-left: 1px dotted #cccccc; width:60px; text-align:center;">{action}</td>
        </tr>								
        <tr>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:0 2px 0 1px; border-top:1px dotted #cccccc;" colspan="4">{reason}</td>
        </tr>
        <tr>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:0 2px 2px 1px; border-top:1px dotted #cccccc; font-size:10px;" colspan="4">{gmreason}</td>
        </tr>                                                                
        <tr>
            <td colspan="4">&nbsp;<br /><br /></td>
        </tr>
        <!-- END BLOCK : list -->
        <!-- START BLOCK : auto -->
        <tr>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 0 2px 1px; font-size:11px; font-weight:bold;">{gm}</td>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 0 2px 0; font-size:10px; font-style: italic;">{date}</td>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 0 2px 0; font-size:11px; font-weight:bold; border-left: 1px dotted #cccccc;">{bantime}</td>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 2px 2px 0; font-size:10px; font-weight:bold; border-left: 1px dotted #cccccc; width:60px; text-align:center;">{action}</td>
        </tr>								
        <tr>
            <td colspan="4">&nbsp;<br /><br /></td>
        </tr>
        <!-- END BLOCK : auto -->
        <!-- END BLOCK : showlist -->
    </table>
    
    
    <!-- END BLOCK : banlist -->
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>