<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    {gm} > Action Log<br /><br /><br />
    <span>Action Log</span><br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : gmlog -->
    <h2>New logfiles</h2>
    <table class="filltable">
        <tr>
            <td>User</td>
            <td>Character</td>
            <th width="150">Date</th>
            <th>IP</th>
            <th>Type</th>
            <th>Action</th>
        </tr>         
        
        <!-- START BLOCK : list -->
        <tr>
            
            <td>{user}</td>
            <td>{char}</td>
            <td>{date}</td>
            <td>{ip} ({host})</td>
            <td>{type}</td>
            <td>{action}</td>
        </tr>                      
        <!-- END BLOCK : list -->
                              
    </table>
    </form>
    <!-- END BLOCK : gmlog -->
    
    <!-- START BLOCK : oldlog -->
    <br /><br />
    <hr size="1" />
    <h2>Old Logfiles</h2>
    <table class="filltable">
        <tr>
            <th width="125">IP</th>
            <th width="250">Host</th>
            <th width="250">Date</th>
            <th>Action</th>
        </tr>
        <!-- START BLOCK : logrow -->
        <tr>
            <td>{ip}</td>
            <td style="font-size:9px;">{host}</td>
            <td>{date}</td>
            <td>{action}</td>
        </tr>
        <!-- END BLOCK : logrow -->
    </table>    
    <!-- END BLOCK : oldlog -->
    
    <!-- START BLOCK : banlog -->
   <br /><br />
    <hr size="1" />
    <h2>Ban Logs</h2>

   <table cellspacing="0" cellpadding="2" style="width:550px; margin:0 auto;">
        <!-- START BLOCK : banlist -->
        <tr>
            <td style="background-color: {bgcolor}; border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:11px; font-weight:bold;">{user}</td>
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
        <!-- END BLOCK : banlist -->
    </table>    
    
    
    <!-- END BLOCK : banlog -->
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->