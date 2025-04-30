    <div style="width:536px; margin:0 auto; background-color:#f0f0f0; border:1px dotted #cccccc; border-width:0 1px 1px 1px; padding:2px; font-size:10px; font-weight:bold; font-style:italic;">Found {found} results</div>

    <table style="width:100%; border-collapse: collapse; margin-top:30px;" id="foundtable">
        <!-- START BLOCK : userblock -->
            <tr>
                <td colspan="5" style="background-color:#e0e0e0; font-size:15px; font-weight:bold; padding:4px; border:1px solid #cccccc; border-width:1px 0 1px 1px;">
                    <img src="{onlineimg}" /> <a href="{url}">{username}</a>
                    <span style="color:#777777; font-size:10px; font-style:italic; ">&nbsp;&nbsp;&nbsp;{email}</span>
                </td>
                <td style="background-color:#e0e0e0; font-size:15px; font-weight:bold; padding:4px; border:1px solid #cccccc; border-width:1px 2px 1px 0; text-align:right; color:#990000; font-style:italic;">
                    &nbsp;{banned}
                </td>
            </tr>
            <tr>
                <th style="text-align:left; background-color:{color_head}; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:100px;">CharID</th>
                <th style="text-align:left; background-color:{color_head}; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px;">Name</th>
                <th style="text-align:left; background-color:{color_head}; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:50px;">Level</th>
                <th style="text-align:left; background-color:{color_head}; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:100px;">Job</th>
                <th style="text-align:left; background-color:{color_head}; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:150px;">Creation</th>
                <th style="text-align:left; background-color:{color_head}; border:1px solid #cccccc; border-width:0 2px 1px 1px; padding:2px; width:150px;">Last Login</th>
            </tr>
            
            <!-- START BLOCK : character -->
            <tr>
                <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px; border-left:1px solid #cccccc;">{id}</td>
                <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;"><a href="{url}">{name}</a></td>
                <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{level}</td>
                <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{job}</td>
                <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{create}</td>
                <td style="border:1px dotted #cccccc; border-width:0 1px 1px 1px; padding:2px; border-right:2px solid #cccccc;">{last}</td>
            </tr>            
            <!-- END BLOCK : character -->
            
            <!-- START BLOCK : nochar -->
            <tr>
                <td colspan="6" style="font-size:10px; font-style:italic; border:1px solid #cccccc; border-width:0 2px 0 1px;"><i>No characters on this account</td>
            </tr>
            <!-- END BLOCK : nochar -->
            

            <tr>
                <td colspan="6" style="border-top:2px solid #cccccc; padding:2px;"><br /><br /><br /></td>
            </tr>
            
    
        <!-- END BLOCK : userblock -->
        
        
        <!-- START BLOCK : guildblock -->
        <!-- START BLOCK : guildlist -->
        <tr>
            <td style="background-color:#e0e0e0; font-size:15px; font-weight:bold; padding:4px; border:1px solid #cccccc; border-width:1px 0 1px 1px;" colspan="4"><a href="{url}">{guildname}</a></td>
        </tr>
        <tr>
            <th style="text-align:left; background-color:#f0f0f0; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:150px;">CharID</th>
            <th style="text-align:left; background-color:#f0f0f0; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:200px;">Name</th>
            <th style="text-align:left; background-color:#f0f0f0; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:100px;">Level</th>
            <th style="text-align:left; background-color:#f0f0f0; border:1px solid #cccccc; border-width:0 2px 1px 1px; padding:2px;">Position</th>
        </tr>
        <!-- START BLOCK : gcharlist -->
        <tr>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px; border-left:1px solid #cccccc;">{id}</td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;"><a href="{url}">{name}</a></td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{level}</td>
            <td style="border:1px dotted #cccccc; border-width:0 1px 1px 1px; padding:2px; border-right:2px solid #cccccc;">{position}</td>
        </tr>        
        <!-- END BLOCK : gcharlist -->
        <tr>
            <td colspan="6" style="border-top:2px solid #cccccc; padding:2px;"><br /><br /><br /></td>
        </tr>        
        <!-- END BLOCK : guildlist -->
        <!-- END BLOCK : guildblock -->
        
        
        <!-- START BLOCK : namechangeblock -->
        <tr>
            <td style="background-color:#e0e0e0; font-size:15px; font-weight:bold; padding:4px; border:1px solid #cccccc; border-width:1px 0 1px 1px;" colspan="4">Name Changes</td>
        </tr>        
        <tr>
            <th style="text-align:left; background-color:#f0f0f0; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:200px;">Old Name</th>
            <th style="text-align:left; background-color:#f0f0f0; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:200px;">New Name</th>
            <th style="text-align:left; background-color:#f0f0f0; border:1px solid #cccccc; border-width:0 0 1px 1px; padding:2px; width:300px;">Date</th>
        </tr>
        <!-- START BLOCK : namechangelist -->
        <tr>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px; border-left:1px solid #cccccc;"><a href="{url}">{oldname}</a></td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;"><a href="{url}">{newname}</a></td>
            <td style="border:1px dotted #cccccc; border-width:0 0 1px 1px; padding:2px;">{date}</td>
        </tr>
        <!-- END BLOCK : namechangelist -->
        <!-- END BLOCK : namechangeblock -->
        
        
        
    </table>


    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->