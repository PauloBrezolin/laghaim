<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/inventory.js"></script>

<div class="contentheader">
    {onlinedot} {username} > {charname} > Inventory<br /><br />
    <span>Inventory</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>
                        
<div class="content">
    <!-- START BLOCK : inventory -->

    <h2>Normal Inventory</h2>
    <table id="invtable">
        <tr>
            <th>Position</th>
            <th></th>
            <th>Id</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Plus</th>  
            <th>Dura</th>
            <th>Serial</th>
            <th style="text-align:right">Actions</th>
        </tr>
        <!-- START BLOCK : items -->
        <tr>
            <td width="100">{wearing}</td>
            <td>
                <a href="#" class="popper" data-popbox="{popnum}"><img src="{icon}" /></a>
                <div id="{popnum}" class="popbox">
                    <h2>{prefix}{name} {mplus}</h2>
                    <img src="{icon}" /><br />
                    <b>Durability:</b> {dura1} / {dura2}<br />
                    <b>Settime:</b> {settime}<br />
                    <b>Timestamp:</b> {timestamp}<br />
                    <b>Paytype:</b> {paytype}<br />
                    <b>Flag1:</b> {flag}<br />
                    <b>Flag2:</b> {flag2}
                    
                    <!-- START BLOCK : options -->
                    <ul>
                        <!-- START BLOCK : optlist -->
                        <li>{line}</li>
                        <!-- END BLOCK : optlist -->
                    </ul>
                    <!-- END BLOCK : options -->
                </div>              
            </td>
            <td width="75">{id}</td>
            <td width="200">{name}</td>
            <td width="200">{num}</td>
            <td width="50">{plus}</td>
            <td width="200">{dura1}/{dura2}</td>
            <td>{serial}</td>
            <td style="text-align:right">    
                {edit}
                {delete}
            </td>
        </tr>                       
        <!-- END BLOCK : items -->
    </table>

            <br /><br />
    <h2>Event Inventory</h2>
    
    <table id="invtable">
        <tr>
            <th>Position</th>
            <th></th>
            <th>Id</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Plus</th>  
            <th>Serial</th>
            <th style="text-align:right">Actions</th>
        </tr>
        <!-- START BLOCK : items2 -->
        <tr>
            <td width="100">{wearing}</td>
            <td>
                <a href="#" class="popper" data-popbox="{popnum}"><img src="{icon}" /></a>
                <div id="{popnum}" class="popbox">
                    <h2>{prefix}{name} {mplus}</h2>
                    <img src="{icon}" /><br />
                    <b>Durability:</b> {dura1} / {dura2}<br />
                    <b>Settime:</b> {settime}<br />
                    <b>Timestamp:</b> {timestamp}<br />
                    <b>Paytype:</b> {paytype}<br />
                    <b>Flag1:</b> {flag}<br />
                    <b>Flag2:</b> {flag2}
                    
                    <!-- START BLOCK : options2 -->
                    <ul>
                        <!-- START BLOCK : optlist2 -->
                        <li>{line}</li>
                        <!-- END BLOCK : optlist2 -->
                    </ul>
                    <!-- END BLOCK : options2 -->
                </div>              
            </td>
            <td width="75">{id}</td>
            <td width="200">{name}</td>
            <td width="200">{num}</td>
            <td width="50">{plus}</td>
            <td>{serial}</td>
            <td style="text-align:right">    
                {edit}
                {delete}
            </td>
        </tr>                       
        <!-- END BLOCK : items2 -->
    </table>    

    <!-- END BLOCK : inventory -->
    
    
    <!-- START BLOCK : edititem -->
    <form method="post" action="inventory.php?cid={cid}" class="stdform">
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
            <td class="ietd3">Flag2</td>
            <td class="ietd4"><input type="text" name="flag2" value="{flag2}"  size="10"/></td>
        </tr>
        <tr>
            <td class="ietd3">Dura</td>
            <td class="ietd4"><input type="text" name="dura1" value="{dura1}"  size="5" /> / <input type="text" name="dura2" value="{dura2}" size="5" /></td>
        </tr>
        <tr>
            <td class="ietd3">Set Time</td>
            <td class="ietd4"><input type="text" name="settime" value="{settime}"  size="15" /></td>
        </tr>
        <tr>
            <td class="ietd3">Timestamp</td>
            <td class="ietd4"><input type="text" name="timestamp" value="{timestamp}"  size="15"/></td>
        </tr>
        <tr>
            <td class="ietd3">Paytype</td>
            <td class="ietd4"><input type="text" name="paytype" value="{paytype}" size="3" /></td>
        </tr>
        <tr>
            <td class="ietd5" colspan="4">
                <input type="hidden" name="action" value="saveitem" />
                <input type="hidden" name="slot" value="{slot}" />
                <input type="hidden" name="wearing" value="{wearing}" />
                <input type="hidden" name="type" value="{type}" />
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