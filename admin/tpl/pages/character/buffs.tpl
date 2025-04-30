<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/charinfo.js"></script>
<div class="contentheader">
    {onlinedot} {username} > {charname} > Buffs<br /><br />
    <span>Active Buffs</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    

    <table class="filltable">
        <tr>
            <th width="40">&nbsp;</th>
            <th width="50">Id</th>
            <th width="250">Name</th>
            <th width="250">Type</th>
            <th>Remain time</th>        
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td><img src="data/icons/{id}.jpg" /></td>
            <td>{id}</td>
            <td>{name}</td>
            <td>{type} : {rate}</td>
            <td>{time}</td>        
        </tr>
        <!-- END BLOCK : list -->
    </table>
        <p>This information is only replicating the last save state, so if he used a new potion 3 minutes ago it may or may not appear yet</p>
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      