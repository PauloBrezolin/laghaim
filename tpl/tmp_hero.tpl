<script src="tpl/js/globals.js" type="text/javascript"></script>

<!-- START BLOCK : choosereward -->
<form id="stdform" method="post" action="tmp_hero.php">
<div class="areaopac color3">
    <div class="normal_title">HERO Event Rewards</div>
    <div style="padding-left:20px; padding-right:20px;">
        <p>Congratulations {username}, your {race} {charname} is able to receive the reward for the HERO Event. To receive the reward you first have to choose which item you choose to receive. If it only shows 1 item to choose for you then just choose that one.</p><br />
        <!-- START BLOCK : highlevels -->
        <b>Please choose 1 of the following:</b>
        <ul>
            <!-- START BLOCK : opt_list -->
            <li><input type="radio" name="chosenopt" value="{val}" {opt}> 1x {name} {plus}</li>                       
            <!-- END BLOCK : opt_list -->
        </ul>
            <br /><b>You will also receive all of the following:</b><br />
        <ul>
            <!-- START BLOCK : normal_list -->
            <li>{amount}x {name} {plus}</li>
            <!-- END BLOCK : normal_list -->
        </ul>
        <!-- END BLOCK : highlevels -->
        
        <!-- START BLOCK : lowlevels -->
        <b>Please choose 1 of the following weapons:</b>
        <ul>
            <!-- START BLOCK : opt_weap_list -->
            <li><input type="radio" name="chosenweap" value="{val}" {opt}> 1x {name} +7</li>                       
            <!-- END BLOCK : opt_weap_list -->
        </ul>
            
        <br /><br />
        <b>Please choose 1 of the following 2 sets:</b>
        <!-- START BLOCK : opt_set_list -->
        <div style="width:200px; padding:2px; border:1px solid #cccccc;">
            <input type="radio" name="chosenset" value="{val}" {opt}>
            <ul>
                <!-- START BLOCK : part_list -->
                <li>1x {name} + 8</li>
                <!-- END BLOCK : part_list -->
            </ul>
        </div>
        <br />
        <!-- END BLOCK : opt_set_list -->
        
        <!-- END BLOCK : lowlevels -->
    </div>
</div>
<div align="center"><input type="submit" value="Send me my reward, NOW!" class="btn"/></div><br />
<input type="hidden" name="action" value="sendreward" />
</form>
<!-- END BLOCK : choosereward -->


<!-- START BLOCK : error -->
<div class="areaopac color3" style="background-color:#FFD4D4;">
    <div id="padding">
        <div id="error">{title}</div>
        <div id="content_page">{msg}</div>
    </div>
</div>
<!-- END BLOCK : error -->

<!-- START BLOCK : success -->
<div class="areaopac color3" style="background-color:#D4FFD4;">
    <div id="padding">
        <div id="success">{title}</div>
        <div id="content_page">{msg}</div>
    </div>
</div>
<!-- END BLOCK : success -->