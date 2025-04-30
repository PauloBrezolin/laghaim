
<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    Admin Panel > Statistics > Staff List<br /><br /><br />
    <span>Staff List</span><br /><br />
</div>
                        
            
  <br />      
    <table width="100%" class="filltable">
         <tr>
             <th width="150">Name</th>
             <th width="250">Last Active</th>
             <th>When</th>
             
         </tr>

         <!-- START BLOCK : names -->
         <tr>
             <td style="color:{namecol}; {on}">{name}</td>
             <td style=" {on}">{rawdate}</td>
             <td style="color:{color}; {on}">{date}</td>
         </tr>
         <!-- END BLOCK : names -->
     </table>
    

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
