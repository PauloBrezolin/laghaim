<?php

class Search
{
    private $_find;
    public $results = 0;
    
    function __construct($find)
    {
        $this->_find = '%' . trim($find) . '%';
    }
    
    private function _getResults($useridlist)
    {
        if(!$db = db::getConnection())
            return false;
        
        if(count($useridlist) <= 0)
            return false;
        
        $ids = implode(',', $useridlist);
        
        $query = sprintf
        ("
            SELECT
                b.user_code,
                b.user_id,
                b.email,
                u.a_enable,
                u.a_connect,
                c.a_index,
                c.a_name,
                c.a_level,
                c.a_enable as charenable,
                c.a_create_date,
                c.a_datestamp,
                c.a_race

            FROM %s.bg_user b
            LEFT JOIN %s.t_users u ON u.a_2p4p_user_code = b.user_code
            LEFT JOIN %s.t_characters c ON c.a_user_index = u.a_index

            WHERE b.user_code IN (%s)

            ORDER BY 
                b.user_code, 
                c.a_enable DESC, 
                c.a_level DESC", 
            
            Config::DB_USER, 
            Config::DB_USER,
            Config::DB_CHAR,
            $ids
        );
        
        if(!$dbh = $db->query($query))
            return false;
        
        return $dbh->fetchAll();
        
    }
    
    private function _showResults($results)
    {
        global $tpl, $admin;
        $uid = -1;
        
        foreach ($results as $r)
        {
            if ($uid != $r['user_code'])
            {
                $this->results++;
                
                $tpl->newBlock('userblock');

                $tpl->assign('email', $r['email']);

                $uid = $r['user_code'];

                $tpl->assign('onlineimg', 'tpl/img/offline.png');
                if ($r['a_connect'] > -1)
                    $tpl->assign('onlineimg', 'tpl/img/online.png');

                if ($r['a_enable'] != 1 && $r['a_enable'] != '')
                {
                    $tpl->assign('username', '<strike>' . $r['user_id'] . '</strike>');
                    $tpl->assign('banned', 'Banned');
                }
                else
                    $tpl->assign('username', $r['user_id']);

                $tpl->assign('url', 'user.php?uid=' . $r['user_code']);
            }


            if ($r['a_name'] != null && $r['a_name'] != '')
            {
                $tpl->newBlock('character');
                $tpl->assign('id', $r['a_index']);

                if ($r['charenable'] == 1)
                    $tpl->assign('name', $r['a_name']);
                else
                    $tpl->assign('name', '<strike>' . $r['a_name'] . '</strike>');

                $tpl->assign('level', $r['a_level']);
                $tpl->assign('create', $r['a_create_date']);
                $tpl->assign('last', $r['a_datestamp']);
                $tpl->assign('job', cj($r['a_race']));
                $tpl->assign('url', 'user.php?uid=' . $r['user_code'] . '&cid=' . $r['a_index']);
            }
            else
                $tpl->newBlock('nochar');
        }
        
    }
    
    private function _showNameChangeResults($results)
    {
        global $tpl;
        
        $tpl->newBlock('namechangeblock');
        foreach ($results as $r)
        {
            $tpl->newBlock('namechangelist');
            $tpl->assign('oldname', $r['a_old_name']);
            $tpl->assign('newname', $r['a_new_name']);
            $tpl->assign('url', 'user.php?uid=' . $r['a_2p4p_user_code'] . '&cid=' . $r['a_char_index']);
            $tpl->assign('date', $r['a_insert_time']);
            
            $this->results++;
        }        
    }
    
    private function _showGuildSeachResults($results)
    {
        global $tpl;
        $gid = -1;
        $guildPos = array('Guild Leader', 'Guild Advisor', 'Member', '3', '4', '5', '6', '7', '8');
        
        $tpl->newBlock('guildblock');
        foreach ($results as $r)
        {
            if ($gid != $r['guildid'])
            {
                $tpl->newBlock('guildlist');
                $tpl->assign('url', 'guild.php?gid=' . $r['guildid']);
                $tpl->assign('guildname', $r['guildname']);
                
                if ($r['enable'] != 1)
                    $tpl->assign('guildname', '<strike>' . $r['guildname'] . '</strike>');
                
                $gid = $r['guildid'];
                $this->results++;
            }

            $tpl->newBlock('gcharlist');
            $tpl->assign('id', $r['charid']);
            $tpl->assign('url', 'user.php?uid=' . $r['a_2p4p_user_code'] . '&cid=' . $r['charid']);
            $tpl->assign('name', $r['charname']);
            $tpl->assign('level', $r['charlevel']);
            $tpl->assign('position', $guildPos[$r['position']]);
        }        
    }
    
    private function _search($query)
    {
        if(!$db = db::getConnection())
            return false;
        
        $dbh = $db->prepare($query);
        $dbh->bindParam(':find', $this->_find);
        
        if(!$dbh->execute())
        {
            print_r($dbh->errorInfo());        
            return false;
        }
        
        $users = array();
        while($r = $dbh->fetch(PDO::FETCH_NUM))
                $users[] = $r[0];        
        
        if(!$results = $this->_getResults($users))
            return false;
        else
            $this->_showResults($results);      
        
    }
    
    public function findUsername()
    {
        $query = sprintf("SELECT user_code FROM %s.bg_user WHERE LOWER(user_id) LIKE LOWER(:find)", Config::DB_USER);
        $this->_search($query);
    }
    
    public function findCharname()
    {
        $query = sprintf("SELECT u.a_2p4p_user_code
                          FROM %s.t_characters c, %s.t_users u 
                          WHERE LOWER(c.a_name) LIKE LOWER(:find) 
                          AND u.a_index = c.a_user_index", 
                Config::DB_CHAR, Config::DB_USER);
        
        $this->_search($query);        
    }

    public function findEmail()
    {
        $query = sprintf("SELECT user_code FROM %s.bg_user WHERE LOWER(email) LIKE LOWER(:find) OR LOWER(regmail) like LOWER(:find)", Config::DB_USER);
        $this->_search($query);        
    }

    public function findNamechange()
    {
        $query = sprintf
        ("
            SELECT 
                a_old_name,
                a_new_name,
                a_insert_time,
                a_char_index,
                a_2p4p_user_code

            FROM 
                %s.t_char_name_change_log l,
                %s.t_characters c,
                %s.t_users u

            WHERE (LOWER(a_new_name) like LOWER(:find)
            OR LOWER(a_old_name) like LOWER(:find))
            AND c.a_index = l.a_char_index
            AND u.a_index = c.a_user_index

        ", Config::DB_CHAR, Config::DB_CHAR, Config::DB_USER);
        
        if(!$db = db::getConnection())
            return false;      

        $dbh = $db->prepare($query);
        $dbh->bindParam(':find', $this->_find, PDO::PARAM_STR, 50);

        if ($dbh->execute())
        {
            $result = $dbh->fetchAll();
            $this->_showNameChangeResults($result);
        }
    }

    public function findIP()
    {
        $query = sprintf
        ("SELECT distinct(u.user_code)
          FROM %s.t_connect_log l, %s.bg_user u 
          WHERE l.a_ip like :find 
          AND u.user_id = l.a_idname",
                
        Config::DB_USER,
        Config::DB_USER);
        
        $this->_search($query);            
    }

    public function findMac()
    {
        $query = sprintf
        ("SELECT distinct(u.user_code)
          FROM %s.t_connect_log l, %s.bg_user u 
          WHERE l.a_mac like :find 
          AND u.user_id = l.a_idname",
                
        Config::DB_AUTH,
        Config::DB_AUTH);
        
        $this->_search($query);            
    }

    public function findGuild()
    {
        $query = sprintf("SELECT a_index FROM %s.t_guild_2007 WHERE  LOWER(a_name) like LOWER(:find)", Config::DB_CHAR);
        if(!$db = db::getConnection())
            return false;      

        $dbh = $db->prepare($query);
        $dbh->bindParam(':find', $this->_find, PDO::PARAM_STR, 50); 
        $dbh->execute();
        
        $guilds = array();
        while($r = $dbh->fetch(PDO::FETCH_NUM))
                $guilds[] = $r[0];
        
        $ids = implode(',', $guilds);        
        
        $query = sprintf
        ("
            select
                g.a_index as guildid,
                g.a_name as guildname,
                g.a_level as guildlevel,
                g.a_enable as enable,

                m.a_index as charid,
                m.a_jointype as position,

                c.a_user_index as userid,
                c.a_level as charlevel,
                c.a_name as charname,
                
                u.a_2p4p_user_code

            FROM
                %s.t_guild_2007 g
                LEFT JOIN %s.t_guild_member m ON m.a_guildindex = g.a_index
                LEFT JOIN %s.t_characters c ON c.a_index = m.a_index
                LEFT JOIN %s.t_users u ON u.a_index = c.a_user_index

            WHERE
                g.a_index IN (%s)

            ORDER BY 
                g.a_index", 
                
        Config::DB_CHAR,
        Config::DB_CHAR,
        Config::DB_CHAR,
        Config::DB_USER,
                $ids);
        
        if(!$db = db::getConnection())
            return false;      

        $dbh = $db->prepare($query);

        if ($dbh->execute())
        {
            $result = $dbh->fetchAll();
            $this->_showGuildSeachResults($result);
        }
    }
    
    public function findItem()
    {
        
    }

}

