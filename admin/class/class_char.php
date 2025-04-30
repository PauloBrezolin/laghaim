<?php

class Character
{
    var $name = '';
    var $id = 0;
    var $uid = 0;
    var $enable = 1;
    
    function isChar($cid)
    {
        global $db, $s, $tpl;
        
        $query = sprintf
        ("
            SELECT 
                a_index,
                a_user_index,
                a_enable,
                a_name as a_nick
            FROM 
                %s.t_characters c
            
            WHERE 
                c.a_index = :cid

        ", Config::DB_CHAR );
        
        $dbh = $db->prepare($query);

        $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);

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
                $tpl->assignGlobal('charname', $r['a_nick']);
                $tpl->assignGlobal('cid', $r['a_index']);

                $this->id = $r['a_index'];
                $this->name = $r['a_nick'];
                $this->enable = $r['a_enable'];
                $this->uid = $r['a_user_index'];

                return true;
                
            }
            else
            {
                return false;               
            }
            
        }
        
    }
    
    function GetUser($cid)
    {
        global $db, $s;
        
        $query = sprintf("SELECT a_user_index FROM %s.t_characters WHERE a_index = :cid", Config::DB_CHAR);
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);
        
        if($dbh->execute())
        {
            $result = $dbh->fetch();
            if($result != null)
                return $result[0];
            else
                return false;
        }
        else
            return false;             
        
        
    }
}

?>
