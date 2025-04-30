<script type="text/javascript" src="tpl/js/acpv2.js"></script>

<div class="contentheader">
    Admin Panel > Settings > Data List<br /><br /><br />
    <span>Data List</span><br /><br />
</div>

<div class="content">
    
    <table class="filltable">
        
        <!-- START BLOCK : item -->
        <h2>Item List</h2>
        <tr>
            <th width="22">&nbsp;</th>
            <th width="50">ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Shape</th>
            <th>MinLvl</th>
            <th>MaxLvl</th>
        </tr>
        <!-- START BLOCK : itemlist -->
        <tr>
            <td><img src="{icon}" width="20" /></td>
            <td>{id}</td>
            <td>{name}</td>
            <td>{type}</td>
            <td>{shape}</td>
            <td>{minlevel}</td>
            <td>{maxlevel}</td>
        </tr>
        <!-- END BLOCK : itemlist -->
        <!-- END BLOCK : item -->
        
        
        
        <!-- START BLOCK : npc -->
        <h2>NPC List</h2>
        <tr>
            <th width="50">ID</th>
            <th>Name</th>
            <th>Level</th>
            <th>Drops</th>
        </tr>
        <!-- START BLOCK : npclist -->
        <tr>
            <td>{id}</td>
            <td>{name}</td>
            <td>{level}</td>
            <td>{items}</td>
        </tr>
        <!-- END BLOCK : npclist -->        
        <!-- END BLOCK : npc -->
        
        
        
        <!-- START BLOCK : quest -->
        <h2>NPC List</h2>
        <tr>
            <th width="50">ID</th>
            <th>Name</th>
            <th>Text</th>
            <th>Levels</th>
        </tr>
        <!-- START BLOCK : questlist -->
        <tr>
            <td>{id}</td>
            <td>{name}</td>
            <td>{string0}</td>
            <td>{minlevel} - {maxlevel}</td>
        </tr>
        <!-- END BLOCK : questlist -->            
        <!-- END BLOCK : quest -->
        
    </table>
        
    <br />
    <div id="pagination">
        <ul>
            <!-- START BLOCK : pagination -->
            <li>{page}</li>
            <!-- END BLOCK : pagination -->
        </ul>
    </div>
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>
