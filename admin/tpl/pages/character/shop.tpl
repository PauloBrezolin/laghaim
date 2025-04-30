<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/charinfo.js"></script>
<div class="contentheader">
    {onlinedot} {username} > {charname} > Pets<br /><br />
    <span>Pets</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    
    <!-- START BLOCK : shop -->
    <table id="charinfotable">
        <tr>
            <th>ID</th>
            <td>{id}</td>
        </tr>  
        <tr>
            <th>Title</th>
            <td>{title}</td>
        </tr>  
        <tr>
            <th>World</th>
            <td>{world}</td>
        </tr>  
        <tr>
            <th>Location</th>
            <td>{coord}</td>
        </tr>  
        <tr>
            <th>Value</th>
            <td>{gold}G {silver}S {bronze}B {laim}laim</td>
        </tr>  
        <tr>
            <th>State</th>
            <td>{enable}</td>
        </tr>  
        <tr>
            <th>Action</th>
            <td><a href="shop.php?cid={cid}&action=deleteall" class="menulink">Delete all</a></td>
        </tr>  
    </table>
    <h2>Items</h2>
    <table class="filltable">
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Plus</th>
            <th>Gold</th>
            <th>Silver</th>
            <th>Bronze</th>
            <th>Laim</th>
            <th>Serial</th>
            <th>Action</th>
        </tr>
        <!-- START BLOCK : items -->
        <tr>
            <td><img src="{icon}" /></td>
            <td width="75">{id}</td>
            <td width="200">{name}</td>
            <td width="50">{amount}</td>
            <td width="50">{plus}</td>
            <td width="50">{gold}</td>
            <td width="50">{silver}</td>
            <td width="50">{bronze}</td>
            <td width="50">{laim}</td>
            <td>{serial}</td>
            <td style="text-align:right">    
                <a href="{deleteitem}" class="menulink"><img src="tpl/img/delete.png" /></a>
            </td>
        </tr>                       
        <!-- END BLOCK : items -->                
    </table>
        
        
    <!-- END BLOCK : shop -->
    
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      