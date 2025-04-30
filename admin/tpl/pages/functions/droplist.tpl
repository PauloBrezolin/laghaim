<!-- START BLOCK : showpage -->
<div class="contentheader">
    Admin Panel > Settings > Drop List > Edit Droplist<br /><br /><br />
    <span>Edit Droplist</span><br /><br />
</div>

<div class="content">
    
    <table class="filltable">
        <tr>
            <th>NpcID</th>
            <th>Name</th>
            <th>ItemId</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Rate</th>
            <th>Plus</th>
            <th>AddFlag</th>
            <th></th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td>{npc_idx}</td>
            <td>{npc_name}</td>
            <td>{item_idx}</td>
            <td>{item_name}</td>
            <td>{item_num}</td>
            <td>{item_rate}</td>
            <td>{item_plus}</td>
            <td>{item_addflag}</td>
            <td style="text-align:right;">{delete}</td>
        </tr>
        <!-- END BLOCK : list -->
    </table>
        <br /><br />
        <table>
            <tr>
                <td>Npc ID</td>
                <td><input type="text" name="npc_idx" value="0" size="5" /></td>
            </tr>
            <tr>
                <td>Item ID</td>
                <td><input type="text" name="item_idx" value="0" size="5" /></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td><input type="text" name="item_num" value="1" size="5" /></td>
            </tr>
            <tr>
                <td>Rate</td>
                <td><input type="text" name="item_rate" value="0" size="5" /> (1 - 10000)</td>
            </tr>
            <tr>
                <td>Plus</td>
                <td><input type="text" name="item_plus" value="0" size="5" /></td>
            </tr>
            <tr>
                <td>AddFlag</td>
                <td><input type="text" name="item_addflag" value="0" size="5" /></td>
            </tr>
        </table>

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->