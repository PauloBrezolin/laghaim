<script language="javascript" src="tpl/js/charinfo.js"></script>
<script>
    function showMore()
    {
        $('#charinfotable .hidden').toggle();
    }
</script>    

<div class="contentheader">
    {onlinedot} {username} > {charname} > Character Info<br /><br />
    <span>Character Info</span> {banned}<br /><br />
    <!-- INCLUDE BLOCK : charmenu -->
</div>

<div class="content">
    <!-- START BLOCK : charinfo -->
    <form id="edituserinfo" method="post">
        <table id="charinfotable">
            <tr>
                <th>ID</th>
                <td>{id}</td>
                <td class="edit"></td>
            </tr>                              
            <tr>
                <th>Current Name</th>
                <td id="chName">{firstname}</td>
                <td class="edit">{editname}</td>
            </tr>           
            <tr>
                <th>All Previous Names</th>
                <td>{allnames}</td>
                <td class="edit">&nbsp;</td>
            </tr>            
            <tr>
                <th>Level</th>
                <td id="chLevel">{level}</td>
                <td class="edit">{editlevel}</td>
            </tr>                              
            <tr>
                <th>Class</th>
                <td id="chJob">{cj}</td>
                <td class="edit">{editjob}</td>
            </tr>      
            <tr>
                <th>Money</th>
                <td id="chMoney">{money}</td>
                <td class="edit">{editmoney}</td>
            </tr>          
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <th>HP</th>
                <td>{hp_now} / {hp_max}</td>
            </tr>  
            <tr>
                <th>MP</th>
                <td>{mp_now} / {mp_max}</td>
            </tr>  
            <tr>
                <th>EP</th>
                <td>{ep_now} / {ep_max}</td>
            </tr>              
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <th>Strength</th>
                <td id="chStr">{str}</td>
                <td class="edit">{editstr}</td>
            </tr>                              
            <tr>
                <th>Dexterity</th>
                <td id="chDex">{dex}</td>
                <td class="edit">{editdex}</td>
            </tr>                              
            <tr>
                <th>Intelligence</th>
                <td id="chInt">{int}</td>
                <td class="edit">{editint}</td>
            </tr>                              
            <tr>
                <th>Constitution</th>
                <td id="chCon">{con}</td>
                <td class="edit">{editcon}</td>
            </tr>          
            <tr>
                <th>Charisma</th>
                <td id="chCharisma">{charisma}</td>
                <td class="edit">{editcharisma}</td>
            </tr>            
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>     
            <tr>
                <th>Max Stamina</th>
                <td id="chStamina">{stamina}</td>
                <td class="edit">{editstamina}</td>
            </tr>          
            <tr>
                <th>Max EPower</th>
                <td id="chEPower">{epower}</td>
                <td class="edit">{editepower}</td>
            </tr>          
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>          
            <tr>
                <th>Exp</th>
                <td id="chExp">{exp}</td>
                <td class="edit">{editexp}</td>
            </tr>  
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>          
            <tr>
                <th>Reputation</th>
                <td id="chFame">{fame}</td>
                <td class="edit">{editfame}</td>
            </tr>                              
            <tr>
                <th>Enabled</th>
                <td id="chEnable">{enable}</td>
                <td class="edit">{editenable}</td>
            </tr> 
            <!-- START BLOCK : adminonly -->
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>      
            <tr>
                <th>GM Level</th>
                <td id="chAdmin">{admin}</td>
                <td class="edit">{editgmlevel}</td>
            </tr>                  
            <tr class="hidden">
                <td colspan="3">&nbsp;</td>
            </tr>          
            <!-- END BLOCK : adminonly -->
        </table>
    </form>
    <!-- END BLOCK : charinfo -->

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>