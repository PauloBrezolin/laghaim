<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/acpv2.js"></script>
<script language="javascript" src="tpl/js/lastlogins.js"></script>
<div class="contentheader">
    {onlinedot} {username} > Last Logins<br /><br /><br />
    <span>Last Logins</span> {banned}<br /><br />
    <table width="100%" style="margin-top:5px;">
        <tr>
            <td class="spacetd">&nbsp;</td><td class="menutd" {info}><a href="lastlogins.php?uid={uid}&limit=25" class="menulink">25</a></td>
            <td class="spacetd">&nbsp;</td><td class="menutd" {info}><a href="lastlogins.php?uid={uid}&limit=50" class="menulink">50</a></td>
            <td class="spacetd">&nbsp;</td><td class="menutd" {info}><a href="lastlogins.php?uid={uid}&limit=100" class="menulink">100</a></td>
            <td class="spacetd">&nbsp;</td><td class="menutd" {info}><a href="lastlogins.php?uid={uid}&limit=250" class="menulink">250</a></td>
            <td class="spacetd">&nbsp;</td><td class="menutd" {info}><a href="lastlogins.php?uid={uid}&limit=500" class="menulink">500</a></td>
        </tr>
    </table>        
</div>
                        
<div class="content">
    
    <!-- START BLOCK : lastlogins -->

    <table class="filltable">
        <tr>
            <th width="200">Date</th>
            <th width="150">IP</th>
            <th>Hostname</th>
        </tr>         
        
        <!-- START BLOCK : list -->
        <tr>
            <td>{date}</td>
            <td>{ip}</td>
            <td id="{id}">
                <script type="text/javascript">GetHost('#{id}','{ip}');</script>
            </td>
        </tr>                      
        <!-- END BLOCK : list -->
                              
    </table>
    </form>
    <!-- END BLOCK : lastlogins -->
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->