<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/charinfo.js"></script>
<div class="contentheader">
    Admin Panel > Settings > Roles<br /><br />
    <span>Roles</span><br /><br />
</div>
                        
<div class="content">
    
    <!-- START BLOCK : newrole -->
    <form method="post" action="settings.php">
    <input type="hidden" name="action" value="newrole" />
    <table class="roletable">
        <tr>
            <th colspan="6">Role Settings</th>
        </tr>
        <tr>
            <td class="rtd1" colspan="2">Role Name <input type="text" name="rolename" /></td>
            <td class="rtd4" colspan="2">Role Color <input type="text" name="rolecolor" size="6" maxlength="6" /></td>
            <td class="rtd6" colspan="2"><input type="submit" value="Save Changes" /></td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Search Types</th>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c0" value="yes" /></td><td class="rtd2">Search Username</td>
            <td class="rtd3"><input type="checkbox" name="c1" value="yes" /></td><td class="rtd4">Search Charname</td>
            <td class="rtd5"><input type="checkbox" name="c2" value="yes" /></td><td class="rtd6">Search Guild</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c3" value="yes" /></td><td class="rtd2">Search Email</td>
            <td class="rtd3"><input type="checkbox" name="c4" value="yes" /></td><td class="rtd4">Search IP</td>
            <td class="rtd5"><input type="checkbox" name="c5" value="yes" /></td><td class="rtd6">Search NameChange</td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <th colspan="6">View Rights</th>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c6" value="yes" /></td><td class="rtd2">Cash Amount</td>
            <td class="rtd3"><input type="checkbox" name="c7" value="yes" /></td><td class="rtd4">IP Address</td>
            <td class="rtd5"><input type="checkbox" name="c8" value="yes" /></td><td class="rtd6">Birthday</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c9" value="yes" /></td><td class="rtd2">Security Code</td>
            <td class="rtd3"><input type="checkbox" name="c10" value="yes" /></td><td class="rtd4">Characters</td>
            <td class="rtd5"><input type="checkbox" name="c16" value="yes" /></td><td class="rtd6">GM Level</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c30" value="yes" /></td><td class="rtd2">Skills</td>
            <td class="rtd3"><input type="checkbox" name="c32" value="yes" /></td><td class="rtd4">Inventory</td>
            <td class="rtd5"><input type="checkbox" name="c35" value="yes" /></td><td class="rtd6">Warehouse</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c38" value="yes" /></td><td class="rtd2">Friendlist</td>
            <td class="rtd3"><input type="checkbox" name="c40" value="yes" /></td><td class="rtd4">Quests</td>
            <td class="rtd5"><input type="checkbox" name="c42" value="yes" /></td><td class="rtd6">Affinity</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c44" value="yes" /></td><td class="rtd2">Guilds</td>
            <td class="rtd3"><input type="checkbox" name="c45" value="yes" /></td><td class="rtd4">Pets</td>
            <td class="rtd5"><input type="checkbox" name="c47" value="yes" /></td><td class="rtd6">Give Item Log</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c49" value="yes" /></td><td class="rtd2">Last Logins</td>
            <td class="rtd3"><input type="checkbox" name="c50" value="yes" /></td><td class="rtd4">Item Mall History</td>
            <td class="rtd5"><input type="checkbox" name="c51" value="yes" /></td>            <td class="rtd6">Email changes</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c52" value="yes" /></td><td class="rtd2">Notes</td>
            <td class="rtd3"><input type="checkbox" name="c59" value="yes" /></td><td class="rtd4">Password Requests</td>
            <td class="rtd5"><input type="checkbox" name="c62" value="yes" /></td><td class="rtd6">Donations</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c64" value="yes" /></td><td class="rtd2">Top 100 Donators</td>
            <td class="rtd3"><input type="checkbox" name="c65" value="yes" /></td><td class="rtd4">Online Players</td>
            <td class="rtd5"><input type="checkbox" name="c72" value="yes" /></td><td class="rtd6">Titles</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c73" value="yes" /></td><td class="rtd2">Hack Logs</td>
            <td class="rtd3"><input type="checkbox" name="c74" value="yes" /></td><td class="rtd4">Trade Agent</td>
            <td class="rtd5">&nbsp;</td><td class="rtd6">&nbsp;</td>
        </tr>        
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Edit Rights</th>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c11" value="yes" /></td><td class="rtd2">Username</td>
            <td class="rtd3"><input type="checkbox" name="c12" value="yes" /></td><td class="rtd4">Password</td>
            <td class="rtd5"><input type="checkbox" name="c13" value="yes" /></td><td class="rtd6">Email</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c14" value="yes" /></td><td class="rtd2">Birthday</td>
            <td class="rtd3"><input type="checkbox" name="c15" value="yes" /></td><td class="rtd4">Security Code</td>
            <td class="rtd5"><input type="checkbox" name="c17" value="yes" /></td><td class="rtd6">First Charname</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c18" value="yes" /></td><td class="rtd2">Charname</td>
            <td class="rtd3"><input type="checkbox" name="c19" value="yes" /></td><td class="rtd4">Level</td>
            <td class="rtd5"><input type="checkbox" name="c20" value="yes" /></td><td class="rtd6">Class & Job</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c21" value="yes" /></td><td class="rtd2">Gold Amount</td>
            <td class="rtd3"><input type="checkbox" name="c22" value="yes" /></td><td class="rtd4">Statpoints</td>
            <td class="rtd5"><input type="checkbox" name="c23" value="yes" /></td><td class="rtd6">Exp</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c24" value="yes" /></td><td class="rtd2">Sp</td>
            <td class="rtd3"><input type="checkbox" name="c25" value="yes" /></td><td class="rtd4">Reputation</td>
            <td class="rtd5"><input type="checkbox" name="c26" value="yes" /></td><td class="rtd6">Pk stats</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c27" value="yes" /></td><td class="rtd2">Current Title</td>
            <td class="rtd3"><input type="checkbox" name="c28" value="yes" /></td><td class="rtd4">Guild Out Date</td>
            <td class="rtd5"><input type="checkbox" name="c29" value="yes" /></td><td class="rtd6">GM Level</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c31" value="yes" /></td><td class="rtd2">Skills</td>
            <td class="rtd3"><input type="checkbox" name="c34" value="yes" /></td><td class="rtd4">Inventory</td>
            <td class="rtd5"><input type="checkbox" name="c36" value="yes" /></td><td class="rtd6">Warehouse</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c43" value="yes" /></td><td class="rtd2">Affinity</td>
            <td class="rtd3"><input type="checkbox" name="c46" value="yes" /></td><td class="rtd4">Pets</td>
            <td class="rtd5"><input type="checkbox" name="c54" value="yes" /></td><td class="rtd6">Notes</td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Delete Rights</th>
        </tr>        
        <tr>
            <td class="rtd1"><input type="checkbox" name="c37" value="yes" /></td><td class="rtd2">Warehouse Items</td>
            <td class="rtd3"><input type="checkbox" name="c39" value="yes" /></td><td class="rtd4">Friends from friendlist</td>
            <td class="rtd5"><input type="checkbox" name="c41" value="yes" /></td><td class="rtd6">Quests</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c55" value="yes" /></td><td class="rtd2">Own Notes</td>
            <td class="rtd3"><input type="checkbox" name="c33" value="yes" /></td><td class="rtd4">Inventory Items</td>
            <td class="rtd5">&nbsp;</td><td class="rtd6">&nbsp;</td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Other Rights</th>
        </tr>          
        <tr>
            <td class="rtd1"><input type="checkbox" name="c48" value="yes" /></td><td class="rtd2">Give Items</td>
            <td class="rtd3"><input type="checkbox" name="c53" value="yes" /></td><td class="rtd4">Add Notes</td>
            <td class="rtd5"><input type="checkbox" name="c56" value="yes" /></td><td class="rtd6">Ban and Unban</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c57" value="yes" /></td><td class="rtd2">Unban from other GM</td>
            <td class="rtd3"><input type="checkbox" name="c58" value="yes" /></td><td class="rtd4">Unban from Admin</td>
            <td class="rtd5"><input type="checkbox" name="c60" value="yes" /></td><td class="rtd6">IP Ban</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c61" value="yes" /></td><td class="rtd2">IP Unban</td>
            <td class="rtd3"><input type="checkbox" name="c63" value="yes" /></td><td class="rtd4">Add Cash</td>
            <td class="rtd5"><input type="checkbox" name="c67" value="yes" /></td><td class="rtd6">Is Administrator</td>
        </tr>        
        <tr>
            <td class="rtd1"><input type="checkbox" name="c68" value="yes" /></td><td class="rtd2">Is Head GameMaster</td>
            <td class="rtd3"><input type="checkbox" name="c69" value="yes" /></td><td class="rtd4">Is GameMaster</td>
            <td class="rtd5"><input type="checkbox" name="c70" value="yes" /></td><td class="rtd6">Is Trial GameMaster</td>
        </tr>        
        <tr>
            <td class="rtd1"><input type="checkbox" name="c66" value="yes" /></td><td class="rtd2">Can Edit GameMasters</td>
            <td class="rtd3"><input type="checkbox" name="c71" value="yes" /></td><td class="rtd4">Can Edit Roles</td>
            <td class="rtd5">&nbsp;</td><td class="rtd6"></td>
        </tr>        
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>
    </table>
    <!-- END BLOCK : newrole -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- START BLOCK : editrole -->
    <form method="post" action="settings.php">
    <input type="hidden" name="action" value="editrole" />
    <input type="hidden" name="roleid" value="{roleid}" />
    <table class="roletable">
        <tr>
            <th colspan="6">Role Settings</th>
        </tr>
        <tr>
            <td class="rtd1" colspan="2">Role Name <input type="text" name="rolename" value="{rolename}" /></td>
            <td class="rtd4" colspan="2">Role Color <input type="text" name="rolecolor" size="6" maxlength="6" value="{rolecolor}" /></td>
            <td class="rtd6" colspan="2"><input type="submit" value="Save Changes" /></td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Search Types</th>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c0" value="yes" {c0} /></td><td class="rtd2">Search Username</td>
            <td class="rtd3"><input type="checkbox" name="c1" value="yes" {c1} /></td><td class="rtd4">Search Charname</td>
            <td class="rtd5"><input type="checkbox" name="c2" value="yes" {c2} /></td><td class="rtd6">Search Guild</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c3" value="yes" {c3} /></td><td class="rtd2">Search Email</td>
            <td class="rtd3"><input type="checkbox" name="c4" value="yes" {c4} /></td><td class="rtd4">Search IP</td>
            <td class="rtd5"><input type="checkbox" name="c5" value="yes" {c5} /></td><td class="rtd6">Search NameChange</td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <th colspan="6">View Rights</th>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c6" value="yes" {c6} /></td><td class="rtd2">Cash Amount</td>
            <td class="rtd3"><input type="checkbox" name="c7" value="yes" {c7} /></td><td class="rtd4">IP Address</td>
            <td class="rtd5"><input type="checkbox" name="c8" value="yes" {c8} /></td><td class="rtd6">Birthday</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c9" value="yes" {c9} /></td><td class="rtd2">Security Code</td>
            <td class="rtd3"><input type="checkbox" name="c10" value="yes" {c10} /></td><td class="rtd4">Characters</td>
            <td class="rtd5"><input type="checkbox" name="c16" value="yes" {c16} /></td><td class="rtd6">GM Level</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c30" value="yes" {c30} /></td><td class="rtd2">Skills</td>
            <td class="rtd3"><input type="checkbox" name="c32" value="yes" {c32} /></td><td class="rtd4">Inventory</td>
            <td class="rtd5"><input type="checkbox" name="c35" value="yes" {c35} /></td><td class="rtd6">Warehouse</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c38" value="yes" {c38} /></td><td class="rtd2">Friendlist</td>
            <td class="rtd3"><input type="checkbox" name="c40" value="yes" {c40} /></td><td class="rtd4">Quests</td>
            <td class="rtd5"><input type="checkbox" name="c42" value="yes" {c42} /></td><td class="rtd6">Affinity</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c44" value="yes" {c44} /></td><td class="rtd2">Guilds</td>
            <td class="rtd3"><input type="checkbox" name="c45" value="yes" {c45} /></td><td class="rtd4">Pets</td>
            <td class="rtd5"><input type="checkbox" name="c47" value="yes" {c47} /></td><td class="rtd6">Give Item Log</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c49" value="yes" {c49} /></td><td class="rtd2">Last Logins</td>
            <td class="rtd3"><input type="checkbox" name="c50" value="yes" {c50} /></td><td class="rtd4">Item Mall History</td>
            <td class="rtd5"><input type="checkbox" name="c51" value="yes" {c51} /></td>            <td class="rtd6">Email changes</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c52" value="yes" {c52} /></td><td class="rtd2">Notes</td>
            <td class="rtd3"><input type="checkbox" name="c59" value="yes" {c59} /></td><td class="rtd4">Password Requests</td>
            <td class="rtd5"><input type="checkbox" name="c62" value="yes" {c62} /></td><td class="rtd6">Donations</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c64" value="yes" {c64} /></td><td class="rtd2">Top 100 Donators</td>
            <td class="rtd3"><input type="checkbox" name="c65" value="yes" {c65} /></td><td class="rtd4">Online Players</td>
            <td class="rtd5"><input type="checkbox" name="c72" value="yes" {c72} /></td><td class="rtd6">Titles</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c73" value="yes" {c73} /></td><td class="rtd2">Hack Logs</td>
            <td class="rtd3"><input type="checkbox" name="c74" value="yes" {c74} /></td><td class="rtd4">Trade Agent</td>
            <td class="rtd5">&nbsp;</td><td class="rtd6">&nbsp;</td>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Edit Rights</th>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c11" value="yes" {c11} /></td><td class="rtd2">Username</td>
            <td class="rtd3"><input type="checkbox" name="c12" value="yes" {c12} /></td><td class="rtd4">Password</td>
            <td class="rtd5"><input type="checkbox" name="c13" value="yes" {c13} /></td><td class="rtd6">Email</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c14" value="yes" {c14} /></td><td class="rtd2">Birthday</td>
            <td class="rtd3"><input type="checkbox" name="c15" value="yes" {c15} /></td><td class="rtd4">Security Code</td>
            <td class="rtd5"><input type="checkbox" name="c17" value="yes" {c17} /></td><td class="rtd6">First Charname</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c18" value="yes" {c18} /></td><td class="rtd2">Charname</td>
            <td class="rtd3"><input type="checkbox" name="c19" value="yes" {c19} /></td><td class="rtd4">Level</td>
            <td class="rtd5"><input type="checkbox" name="c20" value="yes" {c20} /></td><td class="rtd6">Class & Job</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c21" value="yes" {c21} /></td><td class="rtd2">Gold Amount</td>
            <td class="rtd3"><input type="checkbox" name="c22" value="yes" {c22} /></td><td class="rtd4">Statpoints</td>
            <td class="rtd5"><input type="checkbox" name="c23" value="yes" {c23} /></td><td class="rtd6">Exp</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c24" value="yes" {c24} /></td><td class="rtd2">Sp</td>
            <td class="rtd3"><input type="checkbox" name="c25" value="yes" {c25} /></td><td class="rtd4">Reputation</td>
            <td class="rtd5"><input type="checkbox" name="c26" value="yes" {c26} /></td><td class="rtd6">Pk stats</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c27" value="yes" {c27} /></td><td class="rtd2">Current Title</td>
            <td class="rtd3"><input type="checkbox" name="c28" value="yes" {c28} /></td><td class="rtd4">Guild Out Date</td>
            <td class="rtd5"><input type="checkbox" name="c29" value="yes" {c29} /></td><td class="rtd6">GM Level</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c31" value="yes" {c31} /></td><td class="rtd2">Skills</td>
            <td class="rtd3"><input type="checkbox" name="c34" value="yes" {c34} /></td><td class="rtd4">Inventory</td>
            <td class="rtd5"><input type="checkbox" name="c36" value="yes" {c36} /></td><td class="rtd6">Warehouse</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c43" value="yes" {c43} /></td><td class="rtd2">Affinity</td>
            <td class="rtd3"><input type="checkbox" name="c46" value="yes" {c46} /></td><td class="rtd4">Pets</td>
            <td class="rtd5"><input type="checkbox" name="c54" value="yes" {c54} /></td><td class="rtd6">Notes</td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Delete Rights</th>
        </tr>        
        <tr>
            <td class="rtd1"><input type="checkbox" name="c37" value="yes" {c37} /></td><td class="rtd2">Warehouse Items</td>
            <td class="rtd3"><input type="checkbox" name="c39" value="yes" {c39} /></td><td class="rtd4">Friends from friendlist</td>
            <td class="rtd5"><input type="checkbox" name="c41" value="yes" {c41} /></td><td class="rtd6">Quests</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c55" value="yes" {c55} /></td><td class="rtd2">Own Notes</td>
            <td class="rtd3"><input type="checkbox" name="c33" value="yes" {c33} /></td><td class="rtd4">Inventory Items</td>
            <td class="rtd5">&nbsp;</td><td class="rtd6">&nbsp;</td>
        </tr>
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>        
        <tr>
            <th colspan="6">Other Rights</th>
        </tr>          
        <tr>
            <td class="rtd1"><input type="checkbox" name="c48" value="yes" {c48} /></td><td class="rtd2">Give Items</td>
            <td class="rtd3"><input type="checkbox" name="c53" value="yes" {c53} /></td><td class="rtd4">Add Notes</td>
            <td class="rtd5"><input type="checkbox" name="c56" value="yes" {c56} /></td><td class="rtd6">Ban and Unban</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c57" value="yes" {c57} /></td><td class="rtd2">Unban from other GM</td>
            <td class="rtd3"><input type="checkbox" name="c58" value="yes" {c58} /></td><td class="rtd4">Unban from Admin</td>
            <td class="rtd5"><input type="checkbox" name="c60" value="yes" {c60} /></td><td class="rtd6">IP Ban</td>
        </tr>
        <tr>
            <td class="rtd1"><input type="checkbox" name="c61" value="yes" {c61} /></td><td class="rtd2">IP Unban</td>
            <td class="rtd3"><input type="checkbox" name="c63" value="yes" {c63} /></td><td class="rtd4">Add Cash</td>
            <td class="rtd5"><input type="checkbox" name="c67" value="yes" {c67} /></td><td class="rtd6">Is Administrator</td>
        </tr>        
        <tr>
            <td class="rtd1"><input type="checkbox" name="c68" value="yes" {c68} /></td><td class="rtd2">Is Head GameMaster</td>
            <td class="rtd3"><input type="checkbox" name="c69" value="yes" {c69} /></td><td class="rtd4">Is GameMaster</td>
            <td class="rtd5"><input type="checkbox" name="c70" value="yes" {c70} /></td><td class="rtd6">Is Trial GameMaster</td>
        </tr>        
        <tr>
            <td class="rtd1"><input type="checkbox" name="c66" value="yes" {c66} /></td><td class="rtd2">Can Edit GameMasters</td>
            <td class="rtd3"><input type="checkbox" name="c71" value="yes" {c71} /></td><td class="rtd4">Can Edit Roles</td>
            <td class="rtd5">&nbsp;</td><td class="rtd6"></td>
        </tr>        
        <tr>
            <td class="lrtd" colspan="6">&nbsp;</td>
        </tr>
    </table>
    <!-- END BLOCK : editrole -->    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      