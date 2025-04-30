<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/lastlogins.js"></script>
<div class="contentheader">
    {onlinedot} {username} > GM Action Log<br /><br /><br />
    <span>GM Action Log</span> {banned}<br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : gmlog -->

    <table class="filltable">
        <tr>
            <th>GM</th>
            <th width="150">Date</th>
            <th>IP</th>
            <th>Type</th>
            <th>Action</th>
        </tr>         
        
        <!-- START BLOCK : list -->
        <tr>
            <td>{gm}</th>
            <td>{date}</td>
            <td>{ip} ({host})</td>
            <td>{type}</td>
            <td>{action}</td>
        </tr>                      
        <!-- END BLOCK : list -->
                              
    </table>
    </form>
    <!-- END BLOCK : gmlog -->
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->