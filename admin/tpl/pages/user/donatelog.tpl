<!-- START BLOCK : showpage -->
<div class="contentheader">
    {onlinedot} {username} > Donation Log<br /><br /><br />
    <span>Donation Log</span> {banned}<br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : donatelog -->

    <table class="filltable">
        <tr>
            <th width="300">Date</th>
            <th width="150">Points</th>
            <th width="75">Value</th>
            <th width="200">Type</th>
            <th width="150">Reference</th>
            <th>Reason</th>
        </tr>         
        
        <!-- START BLOCK : list -->
        <tr>
            <td>{date}</td>
            <td>{points}</td>
            <td>${value}</td>
            <td>{gm}</td>
            <td>{ref}</td>
            <td>{reason}</td>
        </tr>                      
        <!-- END BLOCK : list -->
        <tr>
            <td colspan="6" style="border:0;">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Total:</td>
            <td style="font-weight: bold;">{total_cash}</td>
            <td style="font-weight: bold;">${total_dollar}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
                              
    </table>
    <!-- END BLOCK : donatelog -->
    
    <!-- START BLOCK : addform -->
    <br /><br />
    <form method="post" action="donatelog.php?uid={uid}" class="stdform">
    <table>
        <tr>
            <td>Points</td>
            <td><input type="text" name="cash" size="6" /></td>
        </tr>
        <tr>
            <td>Reason</td>
            <td><input type="text" name="reason" size="50" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" value="Add" />
                <input type="hidden" name="action" value="addcash" />
            </td>
        </tr>
    </table>
    </form>
    <!-- END BLOCK : addform -->
   
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->    