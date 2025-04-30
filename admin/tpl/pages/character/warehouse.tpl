<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/charinfo.js"></script>
<div class="contentheader">
    {onlinedot} {username} > {charname} > Warehouse<br /><br />
    <span>Warehouse</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    
    
    <!-- START BLOCK : inventory -->

    <table id="invtable">
        <tr>
            <th>Id</th>
            <th></th>
            <th>Name</th>
            <th>Amount</th>
            <th>Plus</th>  
            <th>Serial</th>
            <th style="text-align:right; width:40px;">&nbsp;</th>
        </tr>
        <!-- START BLOCK : items -->
        <tr>
            <td width="75">{id}</td>
            <td><img src="{icon}" /></td>
            <td width="250">{name}</td>
            <td width="200">{num}</td>
            <td width="50">{plus}</td>
            <td style="font-size:9px;">{serial}</td>
            <td style="text-align:right">&nbsp;{edit} {delete}</td>
        </tr>                       
        <!-- END BLOCK : items -->
    </table>

    <!-- END BLOCK : inventory -->    
    
    <!-- START BLOCK : edititem -->
    <form method="post" action="warehouse.php?cid={cid}" class="stdform">
    <table class="ietable">
        <tr>
            <th colspan="4">{id} - {name}</th>
        </tr>
        <tr>
            <td class="ietd1">Plus</td>
            <td class="ietd4"><input type="text" name="plus" value="{plus}" size="5"/></td>
        </tr>
        <tr>
            <td class="ietd1">Flag</td>
            <td class="ietd4"><input type="text" name="flag" value="{flag}"  size="10"/></td>
        </tr>
        <tr>
            <td class="ietd1">Flag2</td>
            <td class="ietd4"><input type="text" name="flag2" value="{flag2}"  size="10"/></td>
        </tr>
        <tr>
            <td class="ietd1">Dura</td>
            <td class="ietd4"><input type="text" name="dura1" value="{dura1}"  size="5" /> / <input type="text" name="dura2" value="{dura2}" size="5" /></td>
        </tr>
        <tr>
            <td class="ietd1">Set Time</td>
            <td class="ietd4"><input type="text" name="settime" value="{settime}"  size="15" /></td>
        </tr>
        <tr>
            <td class="ietd1">Timestamp</td>
            <td class="ietd4"><input type="text" name="timestamp" value="{timestamp}"  size="15"/></td>
        </tr>
        <tr>
            <td class="ietd1">Paytype</td>
            <td class="ietd4"><input type="text" name="paytype" value="{paytype}" size="3" /></td>
        </tr>
        <tr>
            <td class="ietd1">Amount</td>
            <td class="ietd4"><input type="text" name="amount" value="{amount}" size="5" /></td>
        </tr>
        <tr>
            <td class="ietd5" colspan="4">
                <input type="hidden" name="action" value="saveitem" />
                <input type="hidden" name="slot" value="{slot}" />
                <input type="submit" value="Save Item" />
            </td>
        </tr>
    </table>
    </form>        
    <!-- END BLOCK : edititem -->    
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      