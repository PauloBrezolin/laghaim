<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    Statistics > Shop List<br /><br />
    <span>Shop List</span><br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : usershop -->
    <table>
        <tr>
            <th align="left" width="150">Character</th>
            <td><a href="{charurl}">{charname}</a></td>
        </tr>
        <tr>
            <th align="left">World</th>
            <td>{world}</td>
        </tr>
        <tr>
            <th align="left">Coordinates</th>
            <td>{posx} - {posz}</td>
        </tr>
        <tr>
            <th align="left">Gold Silver Bronze</th>
            <td>{gold} - {silver} - {bronze}</td>
        </tr>
        <tr>
            <th align="left">Laim</th>
            <td>{laim}</td>
        </tr>
    </table>
        <br /><h2>Items</h2>

    <table class="filltable">
        <tr>
            <th width="50">Id</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Plus</th>
            <th>Flags</th>
            <th>G/S/B</th>
            <th>Laim</th>
            <th width="500">Serial</th>
        </tr>
    <!-- START BLOCK : itemlist -->
        <tr>
            <td>{id}</td>
            <td>{name}</td>
            <td>{count}</td>
            <td>{plus}</td>
            <td>{flag1} - {flag2}</td>
            <td>{gold}/{silver}/{bronze}</td>
            <td>{price}</td>
            <td>{serial1} {serial2} {serial3} {serial4} {serial5}</td>
        </tr>
    <!-- END BLOCK : itemlist -->
    <!-- END BLOCK : usershop -->
    
    
    <!-- START BLOCK : shoplist -->
    <table class="filltable">
        <tr>
            <th>Char Name</th>        
            <th>World</th>
            <th>G/S/B</th>                
            <th>Laim</th>
            <th>Items</th>
            <th>&nbsp;</th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td><a href="{charurl}" class="menulink">{charname}</a></td>
            <td>{world} <span style="font-size:10px;">({posx} - {posx})</span></td>
            <td>{gold}/{silver}/{bronze}</td>
            <td>{laim}</td>
            <td>{items}</td>
            <td><a href="{shopurl}" class="menulink">View Items in Shop</a></td>
        </tr>
        <!-- END BLOCK : list -->
    </table>
    <!-- END BLOCK : shoplist -->
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      