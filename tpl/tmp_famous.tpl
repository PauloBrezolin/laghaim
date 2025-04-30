<script src="tpl/js/globals.js" type="text/javascript"></script>


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

<!-- START BLOCK : choosereward -->
<form id="stdform" method="post" action="tmp_famous.php">
<div class="areaopac color3">
    <div class="normal_title">FAMOUS Event Rewards</div>
    <div style="padding-left:20px; padding-right:20px;">
        <p>Congratulations <b>{username}</b>, your <b>{race} {charname}</b> is able to receive the reward for the FAMOUS Event.<br />To receive the reward you first have to choose which item you choose to receive.<br />If it only shows 1 item to choose for you then just choose that one.</p><br />
        <b>Please choose 1 of the following weapons:</b>
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
    </div>
</div>
<div align="center"><input type="submit" value="Send me my reward, NOW!" class="btn"/></div><br />
<input type="hidden" name="cid" value="{cid}" />
<input type="hidden" name="action" value="sendreward" />
</form>
<!-- END BLOCK : choosereward -->

