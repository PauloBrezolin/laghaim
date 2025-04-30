<?php

    session_start();
    require_once 'inc/globals.php';
    
    
    if(apc_exists('lhtmpserial'))
        $ser = apc_fetch ('lhtmpserial');
    else
    {
        $ser = array();
    }
    
    function checkSerial($parts, &$ser)
    {
      
        $ret = array();
        foreach($parts as $serial)
        {
            if(isset($ser[$serial]))
                $ret[] = '<span style="font-weight:bold; color:red;">' . $serial . '</span>';
            else
            {
                $ret[] = $serial;
                $ser[$serial] = 1;
            }
            
        }
        
        return implode(' ', $ret);
        
    }    

    if($admin->login)
    {
        if(isset($_GET['type']) && isset($_GET['type_num']) && isset($_GET['id']) && isset($_GET['num']))
        {
            
            if(!ctype_alpha($_GET['type']))
                die('Wrong data 1');
            
            if(!ctype_digit($_GET['type_num']))
                die('Wrong data 2');
            
            if(!ctype_digit($_GET['id']))
                die('Wrong data 3');
            
            if(!ctype_digit($_GET['num']))
                die('Wrong data 4');
            
            
            if($_GET['type'] == 'inven')
            {
                $query = sprintf
                ("
                    SELECT 
                        u.a_2p4p_user_code, 
                        c.a_index, 
                        c.a_name, 
                        i.a_plus_point, 
                        i.a_serial1 
                        
                    FROM 
                        %s.t_inven0%d i,
                        %s.t_characters c, 
                        %s.t_users u
                        
                    WHERE i.a_item_idx = :id 
                    AND c.a_index = i.a_char_idx 
                    AND u.a_index = c.a_user_index",
                
                Config::DB_CHAR,
                $_GET['type_num'],
                Config::DB_CHAR,
                Config::DB_USER);
                
                $dbh = $db->prepare($query);
                $dbh->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                if(!$dbh->execute())
                    print_r($dbh->errorInfo());
                
                while($r = $dbh->fetch())
                {
                    $serials = explode(' ', $r['a_serial1']);
                    if(count($serials) < $_GET['num'])
                        continue;                    
                    
                    echo '        
                        <tr>
                            <td><a href="user.php?uid='. $r['a_2p4p_user_code'] .'" class="menuitem">'. $r['a_name'] .'</a></td>
                            <td>'. count($serials) .'</td>
                            <td>'. $r['a_plus_point'] .'</td>
                            <td style="font-size:10px;">'. checkSerial($serials, $ser) .'</td>
                        </tr>';
                }
            }
            
            if($_GET['type'] == 'warehouse')
            {
                $query = sprintf
                ("
                    SELECT 
                        u.a_2p4p_user_code, 
                        u.a_2p4p_user_id, 
                        s.a_plus, 
                        s.a_count, 
                        s.a_serial 
                    FROM 
                        %s.t_stash0%d s, 
                        %s.t_users u 

                    WHERE s.a_item_vnum = :id 
                    AND s.a_count >= :num 
                    AND u.a_index = s.a_user_index", 
                        
                Config::DB_CHAR, 
                $_GET['type_num'], 
                Config::DB_USER);
                
                $dbh = $db->prepare($query);
                $dbh->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                $dbh->bindParam(':num', $_GET['num'], PDO::PARAM_INT);
                if(!$dbh->execute())
                    print_r($dbh->errorInfo());
                
                while($r = $dbh->fetch())
                {
                    echo '        
                        <tr>
                            <td><a href="user.php?uid='. $r['a_2p4p_user_code'] .'" class="menuitem">'. $r['a_2p4p_user_id'] .'</a></td>
                            <td>'. $r['a_count'] .'</td>
                            <td>'. $r['a_plus'] .'</td>
                            <td style="font-size:10px;">'. checkSerial(explode(' ', trim($r['a_serial'])), $ser) .'</td>
                        </tr>';
                }                
            }
            
            apc_delete('lhtmpserial');
            apc_add('lhtmpserial', $ser);
                
            if(apc_exists('lhtmpserial'))
                echo '<tr><td colspan="4">Done loading inventory '.$_GET['type_num'].'/9  Total items: '. count($ser) .'</td></tr>';
        }
    }
    else 
        die('notlogin');
    
?>

