<!-- START BLOCK : showpage -->
<div class="contentheader">
    {onlinedot} {username} > {charname} > Give Item<br /><br />
    <span>Give Item</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    
    <table class="filltable">
        <tr>
            <th width="275">Date</th>
            <th width="50">ID</th>
            <th>Name</th>
            <th width="100">Amount</th>
            <th width="50">Plus</th>
            <th width="150">GM</th>
            <th>Reason</th>
        </tr>
        <!-- START BLOCK : items -->
        <tr>
            <td>{date}</td>
            <td>{id}</td>
            <td>{name}</td>
            <td>{count}</td>
            <td>{plus}</td>
            <td>{gm}</td>
            <td>{reason}</td>
        </tr>        
        <!-- END BLOCK : items -->
    </table>
        
    
    <!-- START BLOCK : giveitem -->
    <br /><br />
    <form method="post" action="giveitem.php?cid={cid}" class="stdform">
    <table class="git">
        <tr>
            <td class="gitd1">Item ID</td>
            <td class="gitd2"><input type="text" name="id" size="5" maxlength="5" value="" /></td>
        </tr>
        <tr>
            <td class="gitd1">Plus</td>
            <td class="gitd2"><input type="text" name="plus" size="5" maxlength="5" value="0" /></td>
        </tr>
        <tr>
            <td class="gitd1">Amount</td>
            <td class="gitd2"><input type="text" name="num" size="10" maxlength="20" value="1" /></td>
        </tr>
        <tr>
            <td class="gitd1">Flag1</td>
            <td class="gitd2"><input type="text" name="flag1" size="10" maxlength="20" value="0" /></td>
        </tr>
        <tr>
            <td class="gitd1">Flag2</td>
            <td class="gitd2"><input type="text" name="flag2" size="10" maxlength="20" value="0" /></td>
        </tr>
        <tr>
            <td class="gitd1">Endurance1</td>
            <td class="gitd2"><input type="text" name="endu1" size="20" maxlength="20" value="0" /> (max 130)</td>
        </tr>
        <tr>
            <td class="gitd1">Endurance2</td>
            <td class="gitd2"><input type="text" name="endu2" size="20" maxlength="20" value="0" /> (max 130)</td>
        </tr>
        <tr>
            <td class="gitd1">Set Time</td>
            <td class="gitd2"><input type="text" name="settime" size="20" maxlength="20" value="0" />(seconds / 0 = no limit)</td>
        </tr>
        <tr>
            <td class="gitd1">Reason</td>
            <td class="gitd2"><input type="text" name="reason" size="35" maxlength="255" value="" /></td>
        </tr>
        <tr>
            <td class="gitd3">&nbsp;</td>
            <td class="gitd4">
                <input type="submit" value="Add Item to Warehouse" />
                <input type="hidden" name="action" value="additem" /> 
                <span style="font-size:10px; font-style:italic;">User has to be offline</span>
            </td>
        </tr>
    </table>
    </form>
    <!-- END BLOCK : giveitem -->    
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      