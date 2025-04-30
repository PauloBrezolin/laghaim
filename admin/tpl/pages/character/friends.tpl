<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/charinfo.js"></script>
<div class="contentheader">
    {onlinedot} {username} > {charname} > Friends<br /><br />
    <span>Friends</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    <table class="filltable">
        <tr>
            <th width="200">Name</th>
            <th width="75">Level</th>
            <th>Race</th>
            <th>&nbsp;</th>        
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td><img src="{status}" /> <a href="{url}">{name}</a></td>
            <td>{level}</td>
            <td>{race}</td>
            <td>&nbsp;</td>        
        </tr>
        <!-- END BLOCK : list -->
    </table>

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      