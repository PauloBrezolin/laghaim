
<script language="javascript" src="tpl/js/acpv2.js"></script>
<div class="contentheader">
    Admin Panel > Statistics > Ban List<br /><br /><br />
    <span>Ban List</span><br /><br />
    <!-- START BLOCK : pagelist -->
    <table width="100%" style="margin-top:5px;">
        <tr>
            <!-- START BLOCK : page -->
            <td class="spacetd">&nbsp;</td><td class="menutd" {info}>{p}</td>
            <!-- END BLOCK : page -->
            <th>&nbsp;</th>
        </tr>
    </table>    
    <!-- END BLOCK : pagelist -->
</div>
                        
            
  <br />      
   <table cellspacing="0" cellpadding="2" style="width:650px; margin:0 auto;">
  <!-- START BLOCK : list -->
        <tr>
            <td style="background-color: #f1f1f1; border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:12px; font-weight:bold; width:150px;">{username}</td>
            <td style="background-color: #f1f1f1; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:10px; font-style: italic; width:150px;">{date}</td>
            <td style="background-color: #f1f1f1; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:12px; font-weight:bold; border-left: 1px dotted #cccccc; width:100px; text-align:center;">{bantime}</td>
            <td style="background-color: #f1f1f1; border:1px solid #cccccc; border-width:1px 0 0 0; font-size:10px; font-weight:bold; border-left: 1px dotted #cccccc; width:120px; text-align:center;">{gm}</td>
            <td style="background-color: #f1f1f1; border:1px solid #cccccc; border-width:1px 2px 0 0; font-size:10px; font-weight:bold; border-left: 1px dotted #cccccc; text-align:center;"><a href="{num}" class="showreason">Show Reason</a></td>
        </tr>								
        <tr class="reason{num}" style="display:none;">
            <td style="background-color: #f1f1f1; border:1px solid #cccccc; border-width:0 2px 0 1px; border-top:1px dotted #cccccc;" colspan="5">{reason}</td>
        </tr>
        <tr class="reason{num}" style="display:none;">
            <td style="background-color: #f1f1f1; border:1px solid #cccccc; border-width:0 2px 0 1px; border-top:1px dotted #cccccc; font-size:10px;" colspan="5">{gmreason}</td>
        </tr>                                                                
    <!-- END BLOCK : list -->
        <tr>
            <td style="border-top:2px solid #cccccc;" colspan="5">&nbsp;</td>
        </tr>                                                                
    
    </table>            
    

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
