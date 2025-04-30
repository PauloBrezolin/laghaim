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
            <th width="150">Date</th>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>        
            <th>Plus</th>
            <th>Flag1</th>
            <th>Flag2</th>
            <th>Flag Ext</th>
            <th>Event</th>
            <th>&nbsp;</th>                
        </tr>
        <!-- START BLOCK : list1 -->
        <tr>
            <td>{date}</td>
            <td>{id}</td>
            <td>{name}</td>
            <td>{count}</td>
            <td>{plus}</td>
            <td>{flag1}</td>
            <td>{flag2}</td>
            <td>{ext}</td>
            <td>{event}</td>
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