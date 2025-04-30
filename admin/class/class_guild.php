<?php

class Guild
{
    
    var $name = '';
    var $id = 0;
    var $enable = 1;
    
    function isGuild($gid)
    {
        global $db, $s, $tpl, $admin, $msg;
        
        $query = sprintf
        ("
            SELECT 
                a_index,
                a_name,
                a_enable
                
            FROM 
                %s.t_guild_2007 
            
            WHERE 
                a_index = :gid
                
        ", Config::DB_CHAR);
        
        $dbh = $db->prepare($query);

        $dbh->bindParam(':gid', $gid, PDO::PARAM_INT);

        if(!$dbh->execute())
        {
            $msg->error('Database Error');
            return false;
        }
        else
        {
            
            $r = $dbh->fetch();
            if($r != null)
            {
                $tpl->assignGlobal('guildname', $r['a_name']);
                $tpl->assignGlobal('gid', $r['a_index']);

                if($r['a_enable'] == 0)
                {
                    $vars = explode('_', $r['a_name']);
                    
                    $year = 1900 + intval(substr($vars[1], 0, 3));
                    $month = substr($vars[1], 3,2);
                    $day = substr($vars[1], 5,2);
                    $hour = substr($vars[1], 7,2);
                    $min = substr($vars[1], 9,2);
                    $sec = substr($vars[1], 11,2);
                    
                    $time = mktime($hour, $min, $sec, $month, $day, $year);
                    
                    $tpl->assignGlobal('disband', '<span class="bantext"><br />This guild was disbanded at '. date('l, d F Y - H:i:s' , $time) .'</span>');            
                }
                
                $this->id = $r['a_index'];
                $this->name = $r['a_name'];
                $this->enable = $r['a_enable'];
                
                return true;
                
            }
            else
            {
                return false;               
            }
            
        }
        
    }
    
    function delItem($slot)
    {
        global $db, $s;
        
        $query = sprintf
        ("
            UPDATE %s.t_guild_stash
            SET
                a_item_vnum = -1,
                a_plus = 0,
                a_addflag = 0,
                a_addflag2 = 0,
                a_ext_flag = '0 0 0 0 0',
                a_dura0 = 0,
                a_dura1 = 0,
                a_count = 0,
                a_serial = ''
            WHERE a_guild_index = :gid
            AND a_slot = :slot"
                
        , Config::DB_CHAR);
        
        $dbh = $db->prepare($query);
        $dbh->bindParam(':gid', $this->id, PDO::PARAM_INT);
        $dbh->bindParam(':slot', $slot, PDO::PARAM_INT);
        
        return $dbh->execute();
    }
}

?>
