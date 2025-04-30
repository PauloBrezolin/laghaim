<!-- START BLOCK : showpage -->
<div class="contentheader">
    {guildname} > Guild Members<br /><br />
    <span>Guild Members</span> {disband}<br /><br />
</div>

<div class="content">

    <!-- START BLOCK : guildmember -->
    <table class="filltable">
        <tr>
            <th>Name</th>
            <th>Level</th>
            <th>Class</th>
            <th>Position</th>
            <th>Join Date</th>
            <th>Position</th>
            <th>Cont exp</th>
            <th>Cont fame</th>
            <th>Points</th>
            <th>Can use stash</th>
        </tr>
        <!-- START BLOCK : list -->
        <tr>
            <td><a href="{url}">{name}</a></td>
            <td>{level}</td>
            <td>{class}</td>
            <td>{position}</td>
            <td>{regdate}</td>
            <td>{posname}</td>
            <td>{cexp}</td>
            <td>{cfame}</td>
            <td>{points}</td>
            <td>{stash}</td>
        </tr>        
        <!-- END BLOCK : list -->
    </table>
       
    <!-- END BLOCK : guildmember -->


    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->      