<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/search.js"></script>
<div class="contentheader">
    Search > Item<br /><br /><br />
    <span>Item Search</span><br /><br />
</div>
                        
<div class="content">
    
    <div id="searchcontainer">
        <form id="searchitemform">
            Item ID: <input type="text" name="id" id="id" size="10" value="{id}" /> Amount: <input type="text" name="amount" id="amount" size="10" value="{num}" /> <input type="submit" value="Search" /><br />
            <input type="hidden" name="action" value="searchitem" />
        </form>
    </div>
    
            Found a total of {found} records with {dupes} duplicate<br />
    <h2>Inventory Items</h2>
    <table class="filltable">
        <tr>
            <th width="150">Char Name</th>
            <th width="50">Amount</th>
            <th width="50">Plus</th>
            <th>Serials</th>
        </tr>
        <!-- START BLOCK : inventory_list -->
        <tr>
            <td><a href="{url}" class="menuitem">{name}</a></td>
            <td>{amount}</td>
            <td>{plus}</td>
            <td style="font-size:10px;">{serials}</td>
        </tr>
        <!-- END BLOCK : inventory_list -->
    </table>
    <br /><br />
        
    <h2>Warehouse Items</h2>
    
    
    <!-- START BLOCK : warehouse_list -->
    <div style="border: 1px solid black; margin-bottom: 10px;">
        <div style="border:1px dotted gray; background-color:#f3f3f3;"><a href="{url}" target="_blank">{name}</a> ({amount})</div>
        <div style="font-size:10px;">
            <!-- START BLOCK : warehouse_items -->
            {serials}
            <!-- END BLOCK : warehouse_items -->
        </div>
    </div>
    <!-- END BLOCK : warehouse_list -->
    
    

    <br /><br />
    
    <h2>Guild Storage Items</h2>
    <table class="filltable">
        <tr>
            <th width="150">Guild Name</th>
            <th width="50">Amount</th>
            <th width="50">Plus</th>
            <th>Serials</th>
        </tr>
        <!-- START BLOCK : guild_list -->
        <tr>
            <td><a href="{url}">{name}</a></td>
            <td>{amount}</td>
            <td>{plus}</td>
            <td style="font-size:10px;">{serials}</td>
        </tr>
        <!-- END BLOCK : guild_list -->
    </table>       
    <br /><br />
    
    <h2>Shop Items</h2>
    <table class="filltable">
        <tr>
            <th width="150">Guild Name</th>
            <th width="50">Amount</th>
            <th width="50">Plus</th>
            <th>Serials</th>
        </tr>
        <!-- START BLOCK : shop_list -->
        <tr>
            <td><a href="{url}">{name}</a></td>
            <td>{amount}</td>
            <td>{plus}</td>
            <td style="font-size:10px;">{serials}</td>
        </tr>
        <!-- END BLOCK : shop_list -->
    </table> 
        
    <h2>Event Inventory Items</h2>
    <table class="filltable">
        <tr>
            <th width="150">Char Name</th>
            <th width="50">Amount</th>
            <th width="50">Plus</th>
            <th>Serials</th>
        </tr>
        <!-- START BLOCK : event_list -->
        <tr>
            <td><a href="{url}" class="menuitem">{name}</a></td>
            <td>{amount}</td>
            <td>{plus}</td>
            <td style="font-size:10px;">{serials}</td>
        </tr>
        <!-- END BLOCK : event_list -->
    </table>        
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->