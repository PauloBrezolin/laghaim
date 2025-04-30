<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/lastlogins.js"></script>
<div class="contentheader">
    {onlinedot} {username} > Email Changes<br /><br /><br />
    <span>Email Changes</span> {banned} <br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : mailchanges -->
    <table class="filltable">
        <tr>
            <th>Date</th>
            <th>Ip</th>
            <th>Hostname</th>
            <th>New Email</th>
            <th>&nbsp;</th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td>{date}</td>
            <td>{ip}</td>
            <td>{hostname}</td>
            <td>{newmail}</td>
            <td>&nbsp;</td>
        </tr>
        <!-- END BLOCK : list -->
    </table>
    <!-- END BLOCK : mailchanges -->
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->    