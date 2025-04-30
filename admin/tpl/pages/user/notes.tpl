<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    {onlinedot} {username} > Notes<br /><br /><br />
    <span>Notes</span> {banned} <br /><br />
</div>
                        
<div class="content">
    
    <form method="post" action="notes.php?uid={uid}" class="stdform">
    <input type="hidden" name="action" value="editnote" />
    <table cellspacing="0" cellpadding="2" style="width:550px; margin:0 auto;">
        <!-- START BLOCK : list -->
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:11px; font-weight:bold;">{gm}</td>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:10px; font-style: italic;">{date}</td>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 2px 0 0; font-size:10px; font-weight:bold; border-left: 1px dotted #cccccc; text-align:right; width:40px;">
                {edit}
                {delete}
            </td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:0 2px 2px 1px; border-top:1px dotted #cccccc;" colspan="3" id="note{id}">{msg}</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <!-- END BLOCK : list -->
    
    </table>
    </form>
    
    
    
    
    <!-- START BLOCK : addnotes -->
    <form method="post" action="notes.php?uid={uid}" class="stdform">
    <table cellspacing="0" cellpadding="2" style="width:550px; margin:0 auto;">
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:11px; font-weight:bold;">{gm}</td>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 2px 0 0; font-size:10px; font-style: italic;">&nbsp;</td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:0 2px 0 1px; border-top:1px dotted #cccccc;" colspan="2"><textarea style="width:535px;" rows="10" name="msg"></textarea></td>
        </tr>
        <tr>
            <td  style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:0 2px 2px 1px; border-top:1px dotted #cccccc;" colspan="3">
                <input type="submit" value="Add Note" />
                <input type="hidden" name="action" value="addnote" />
                <input type="hidden" name="uid" value="{uid}" />
            </td>
        </tr>
    </table>    
    </form>
    <!-- END BLOCK : addnotes -->
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->  