<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/acpv2.js"></script>
<script language="javascript" src="tpl/js/lastlogins.js"></script>
<div class="contentheader">
    {onlinedot} {username} > Fishing<br /><br /><br />
    <span>Fishing</span> {banned}<br /><br />
</div>
                        
<div class="content">
    
    <table class="filltable">
        <tr>
            <th width="150">Fish</th>
            <th width="75">Amount</th>
            <th>Rating</th>
            <th>&nbsp;</th>
        </tr>
        <!-- START BLOCK : fishlist -->
        <tr>
            <td>{fish}</td>
            <td>{num}</td>
            <td>{rate}</td>
            <td>&nbsp;</td>
        </tr>
        <!-- END BLOCK : fishlist -->
    </table>
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->