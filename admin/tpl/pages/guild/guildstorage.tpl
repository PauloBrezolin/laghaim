<!-- START BLOCK : showpage -->
<div class="contentheader">
    {guildname} > Guild Storage<br /><br />
    <span>Guild Storage</span> {disband}<br /><br />
</div>

<div class="content">

    <!-- START BLOCK : guildstorage -->
    <table class="filltable">
        <tr>
            <th width="40">&nbsp;</th>
            <th width="75">Id</th>
            <th width="300">Name</th>
            <th width="150">Amount</th>
            <th width="100">Plus</th>
            <th width="150">Dura</th>
            <th>Serial</th>
            <th></th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td><span title="header=[{popup_title}] body=[{popup_body}]"><img src="{icon}" /></span></td>
            <td>{id}</td>
            <td>{name}</td>
            <td>{amount}</td>
            <td>{plus}</td>
            <td>{dura1}/{dura2}</td>
            <td>{serial}</td>
            <td align="right"><a href="{delete}" class="menulink"><img src="tpl/img/delete.png"></a></td>
        </tr>
        <!-- END BLOCK : list -->
    </table>
    <!-- END BLOCK : guildstorage -->

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      