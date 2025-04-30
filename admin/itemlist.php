<style>
    body {font-family: sans-serif;}
    table { width:600px; border-collapse: collapse;}
    td {  font-size:12px; border:1px dotted #cccccc; padding:2px;}
    th { text-align: left; border:1px dotted #cccccc; padding:2px;}
    
</style>

<?php

    include 'conf/config.php';
    
    $types = array('WEAR', 'ARMOR', 'WEAPON', 'ETC', 'PET', 'SUB', 'NUM');
    
    $subtypes = array(
        array('Body', 'Legs', 'Num'),
        array('Helmet', 'Armor', 'Pants', 'Cloak', 'Shoes', 'Shield', 'Necklace', 'Ring', 'Bracelet', 'Num','','','','',''),
        array('Sword','Axe', 'Staff', 'Ring', 'Gun', '', '', 'Hammer', 'Dualsword', 'Spear', 'Num','','','','',''),
        array('GEM_STONE', 'PART', 'POWER', 'GEM', 'GIFT', 'QUICK', 'ETC', 'GEMCHIP', 'MAGICSTONE', 'WARP', 'BUFF', 'QUEST', 'PET', 'PREMINUM', 'SKILL', 'RESOURCE', 'EFFECT', 'USING', 'SCROLL', 'SUMMON', 'SHELL', 'CHARGE', 'MOBSUMMON', 'CUBE', 'RECIPE', 'MATERIAL','SUMMONNPC','NUM','','','','',''),
        array('HORN','HEAD','BODY', 'WINGS', 'LEGS', 'TAIL', 'NUM','','','','',''),
        array('SLAYER', 'CHAKRAM', 'WAND', 'SCROLL', 'BOOK', 'SUMMON', 'COMPONENT', 'COLLECT', 'S_EQUIP', 'L_EQUIP', 'SHELL', 'ETC', 'BLASTER', 'D_STONE','','','','',''),
    );
    
    $dbh = $db->prepare(sprintf("SELECT a_index, a_name, a_min_level, a_type_idx, a_shape_idx FROM %s.t_item WHERE a_enable = 1 ORDER BY a_type_idx, a_shape_idx, a_min_level, a_name", Config::DB_DATA));
    $dbh->execute();
    $result = $dbh->fetchAll();
    
    echo '
        <h2>LHGenericName01 ItemList</h2>
        <table>
        ';

    $curType = -1;
    $first = true;
    foreach($result as $r)
    {
        if($curType != $r['a_type_idx'])
        {
            
            if(!$first)
            {
                echo '<tr><td style="border:0;">&nbsp;</td></tr>';
            }
            else
                $first = false;
            
            echo 
            '
                <tr>
                    <th colspan="4" style="border:1px dotted #cccccc; font-size:20px;">'. $types[$r['a_type_idx']].'</th>
                </tr>
                <tr>
                    <th width="50">ID</th>
                    <th>Name</th>
                    <th>Subtype</th>
                    <th>Level</th>
                </tr>
            ';
            
            $curType = $r['a_type_idx'];
        }
        echo '
            <tr>
                <td>'. $r['a_index'] .'</td>
                <td>'. $r['a_name_tha'] .'</td>
                <td>'. $subtypes[$r['a_type_idx']][$r['a_shape_idx']].'</td>
                <td>'. $r['a_min_level'] .'</td>
            </tr>
            ';
    }
    
    echo '</table>';
    
?>
