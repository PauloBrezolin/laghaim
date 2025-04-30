<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/charinfo.js"></script>
<div class="contentheader">
    {onlinedot} {username} > {charname} > Pets<br /><br />
    <span>Pets</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    

    <!-- START BLOCK : p1list -->
    <table class="filltable">
        <tr>
            <th width="40">&nbsp;</th>
            <th width="200">Name Tag</th>
            <th width="75">Level</th>
            <th>&nbsp;</th>        
        </tr>
        <!-- START BLOCK : list1 -->
        <tr>
            <td><img src="tpl/img/icon.php?i={icon}" /></td>
            <td>{name}</td>
            <td>{level}</td>
            <td>&nbsp;</td>        
        </tr>
        <!-- END BLOCK : list1 -->
    </table>
    <!-- END BLOCK : p1list -->    
    
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      