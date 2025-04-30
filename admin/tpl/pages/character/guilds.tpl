<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/charinfo.js"></script>
<div class="contentheader">
    {onlinedot} {username} > {charname} > Guilds<br /><br />
    <span>Guilds</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    
    <!-- START BLOCK : guildlist -->
    <table class="filltable">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Position</th>
            <th>Join Date</th>
            <th>&nbsp;</th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td>{id}</td>
            <td><a href="{url}">{name}</a></td>
            <td>{pos}</td>
            <td>{regdate}</td>
            <td>&nbsp;</td>
        </tr>
        <!-- END BLOCK : list -->
    </table>
    <!-- END BLOCK : guildlist -->
    
    
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      