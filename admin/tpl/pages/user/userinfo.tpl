<script language="javascript" src="tpl/js/acpv2.js"></script>
<script language="javascript" src="tpl/js/userinfo.js"></script>
<div class="contentheader">
    {onlinedot} {username} > View userinfo<br /><br /><br />
    <span>{username}</span> {banned} <br /><br />
</div>
                        
<div class="content">
    <!-- START BLOCK : userinfo -->
    <form id="edituserinfo" method="post">
    <table id="userinfotable">
        <tr>
            <th>User ID</th>
            <td>{userid}</td>
            <td class="edit"></td>
        </tr>                              
        <tr>
            <th>User Name</th>
            <td id="usrName">{username}</td>
            <td class="edit">{username_edit}</td>
        </tr>                              
        <tr>
            <th>Password</th>
            <td id="usrPw">{password}</td>
            <td class="edit">{password_edit}</td>
        </tr>                              
        <!-- START BLOCK : showcash -->
        <tr>
            <th>LP</th>
            <td id="usrCash">{cash}</td>
            <td class="edit"></td>
        </tr>                          
        <!-- END BLOCK : showcash -->
        <tr>
            <th>Account Creation</th>
            <td>{regdate}</td>
            <td class="edit"></td>
        </tr>                              
        <tr>
            <th>Status</th>
            <td>{status}</td>
            <td class="edit"></td>
        </tr>                              
        <tr>
            <th>Registration IP</th>
            <td>{regip}</td>
            <td class="edit"></td>
        </tr>                              
        <tr>
            <th>Current Email</th>
            <td id="usrEmail">{email}</td>
            <td class="edit">{email_edit}</td>
        </tr>      
        <tr>
            <th>Registration Email</th>
            <td>{regmail}</td>
            <td></td>
        </tr>           
        <tr>
            <th>Pin Code</th>
            <td id="usrSecCode">{scode}</td>
            <td class="edit">{scode_edit}</td>
        </tr>      
        <tr>
            <th>Kick User</th>
            <td>{kickuser}</td>
            <td></td>
        </tr>
    </table>
    </form>
        
    <br />
    <!-- START BLOCK : settmp -->
    <a href="{url}" class="menulink">Set the password of this account temporarily to 123456</a>
    <!-- END BLOCK : settmp -->
    
    <!-- START BLOCK : setback -->
    <a href="{url}" class="menulink">Change the password back to original</a>
    <!-- END BLOCK : setback -->
   
    <br />
    <!-- START BLOCK : charlist -->    
    <table style="width:100%; border-collapse: collapse; margin-top:30px;" id="foundtable">
        <tr>
            <th style="border:1px solid #cccccc; border-width:1px 0 1px 1px; padding:2px; width:25px;">Slot</th>
            <th style="border:1px solid #cccccc; border-width:1px 0 1px 1px; padding:2px;">ID</th>
            <th style="border:1px solid #cccccc; border-width:1px 0 1px 1px; padding:2px;">Name</th>
            <th style="border:1px solid #cccccc; border-width:1px 0 1px 1px; padding:2px;">Level</th>
            <th style="border:1px solid #cccccc; border-width:1px 0 1px 1px; padding:2px;">Class</th>
            <th style="border:1px solid #cccccc; border-width:1px 0 1px 1px; padding:2px;">Created</th>
            <th style="border:1px solid #cccccc; border-width:1px 0 1px 1px; padding:2px; border-right: 2px solid #cccccc;">Last Use</th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px; border-left:1px solid #cccccc;">{slot}</td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{id}</a></td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;"><a href="{url}" class="menulink">{name}</a></td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{level}</td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{job}</td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{create}</td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px; border-right: 2px solid #cccccc;">{lastuse}</td>
        </tr>     
        <!-- END BLOCK : list -->
        <tr>
            <td colspan="6" style="border-top:2px solid #cccccc; padding:2px;">&nbsp;</td>
        </tr>
    </table>
    <!-- END BLOCK : charlist -->
    
    
    <!-- END BLOCK : userinfo -->
    
    
    
    
    
    
    
    
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>