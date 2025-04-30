<script src="tpl/js/globals.js" type="text/javascript"></script>
<!-- START BLOCK : ranking -->
<div class="color2" align="center" style="letter-spacing:15px; font-family: 'Archivo Narrow', sans-serif; margin-bottom:8px;" align="center">CLASS RANKING</div>
<div class="areaopac color3" style="padding:4px;">            
    <table id="ranktable" style="margin:0 auto;">
        <tr>
            <!-- START BLOCK : col -->
            <td valign="top">
                <table class="innerrank">
                    <!-- START BLOCK : race -->
                    <tr>
                        <th colspan="3" style="border:1px solid #121212;">{racename}</th>
                    </tr>
                    <!-- START BLOCK : char -->
                    <tr>
                        <td width="20">{pos}</td>
                        <td width="140">{name}</td>
                        <td width="30">{level}</td>
                    </tr>
                    <!-- END BLOCK : char -->
                    <tr>
                        <td colspan="2"><a href="{racerankurl}" class="menuitem">Show Top 500</a></td>
                    </tr>
                    <tr>
                        <th colspan="3">&nbsp;<br /><br /></th>
                    </tr>
                    <!-- END BLOCK : race -->
                </table>
            </td>
            <!-- END BLOCK : col -->
        </tr>
    </table>

    For security reasons this ranking is not live and only gets refreshed once every 2 hours<br />Next ranking update in <b>{rankupdate}</b>
</div><br />
<!-- END BLOCK : ranking -->

<!-- START BLOCK : racerank -->
<div class="color2" align="center" style="letter-spacing:15px; font-family: 'Archivo Narrow', sans-serif; margin-bottom:8px;" align="center">CLASS RANKING</div>
<div class="areaopac color3" style="padding:4px;">            
    <table id="ranktable" style="margin:0 auto;">
        <!-- START BLOCK : race2 -->
        <tr>
            <th colspan="3" style="border:1px solid #121212;">{racename}</th>
        </tr>
        <!-- START BLOCK : char2 -->
        <tr>
            <td width="20">{pos}</td>
            <td width="140">{name}</td>
            <td width="30">{level}</td>
        </tr>
        <!-- END BLOCK : char2 -->
        <tr>
            <td colspan="2"><a href="ranking.php" class="menuitem">Back to all race ranking</a></td>
        </tr>        
        <tr>
            <th colspan="3">&nbsp;<br /><br /></th>
        </tr>
        <!-- END BLOCK : race2 -->
    </table>
    For security reasons this ranking is not live and only gets refreshed once every 2 hours<br />Next ranking update in <b>{rankupdate}</b>
</div><br />
<!-- END BLOCK : racerank -->


<!-- START BLOCK : message -->
<div class="areaopac color3" style="padding:4px;">{msg}</div>
<div align="center"><img src="tpl/images/line.png" /></div>
<!-- END BLOCK : message -->

