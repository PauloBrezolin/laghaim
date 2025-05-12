<?php

class Admin
{

    var $login = false;
    var $name;
    var $username;
    var $flag = 0;
    var $id = -1;
    var $rights = '';

    function CheckLogin()
    {
        global $tpl;
        
        if (!$db = db::getConnection())
            return false;
        
        if(isset($_SESSION['admin02login']) || isset($_COOKIE['admin02login']))
        {
            
            $secure = '';
            if(isset($_COOKIE['admin02login']))
                $secure = $_COOKIE['admin02login'];
            
            if(isset($_SESSION['admin02login']))
                $secure = $_SESSION['admin02login'];
                
                       
            $vars = explode(':', $secure);
            
            if(count($vars) != 2)
                return false;
            
            $id = $vars[0];
            $key = $vars[1];
            
            if(!ctype_digit($id) || strlen($key) != 128)
                return false;
            
            $query = sprintf
            ("
                SELECT 
                    a.a_index,
                    a.a_displayname,
                    a.a_username,
                    a.a_password,
                    r.a_rights

                FROM 
                    %s.t_admininfo a,
                    %s.t_roles r

                WHERE a.a_index = :id
                AND a.a_enable = 1
                AND r.a_index = a.a_role", 

            Config::DB_WEB, 
            Config::DB_WEB);

            $dbh = $db->prepare($query);
            $dbh->bindParam(':id', $id, PDO::PARAM_INT);

            if(!$dbh->execute())
                return false;

            $r = $dbh->fetch();
            if($r == null)
                return false;

            if (hash('sha512', $r['a_index'] . $r['a_username'] . $r['a_password']) == $key)
            {
                $this->login = true;
                $this->name = $r['a_displayname'];
                $this->username = $r['a_username'];
                $this->rights = $r['a_rights'];
                $this->id = $r['a_index'];

                if (isset($tpl))
                    $tpl->assignGlobal('adminname', $r['a_displayname']);
                
                return true;
            }
        }
        
        return false;
    }
    
    public function doLogin($username, $password, $cookie = false)
    {
        if (!$db = db::getConnection()) {
            return false;
        }

        $sql = "
        SELECT a_index, a_username, a_password
            FROM " . Config::DB_WEB . ".t_admininfo
        WHERE a_username = :username
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            return false;
        }

        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$r) {
            $this->_failLog($username, $password);
            return false;
        }

        if (md5($password) !== $r['a_password']) {
            $this->_failLog($username, $password);
            return false;
        }

        $id  = $r['a_index'];
        $key = hash('sha512', $id . $r['a_username'] . $r['a_password']);
        $_SESSION['admin02login'] = $id . ':' . $key;
        if ($cookie) {
            setcookie('admin02login', $_SESSION['admin02login'], time() + 86400 * 365, '/');
        }

        $this->_loginLog($r['a_username']);
        return true;
    }
    
    private function _loginLog($username)
    {
        if(!$db = db::getConnection())
            return false; 
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $host = gethostbyaddr($ip);        
        
        $query = sprintf
        ("
            INSERT INTO %s.t_adminlog 
            (
                a_admin, 
                a_time, 
                a_ip, 
                a_hostname
            ) 

            VALUES
            ( 
                :admin,
                UNIX_TIMESTAMP(),
                :ip,
                :hostname
            )",
                
        Config::DB_WEB);
        
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':admin',    $username, PDO::PARAM_STR);
        $dbh->bindParam(':ip',       $ip,       PDO::PARAM_STR);
        $dbh->bindParam(':hostname', $host,     PDO::PARAM_STR);
        $dbh->execute();  
    }
    
    private function _failLog($username, $password)
    {
        if(!$db = db::getConnection())
            return false; 
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $host = gethostbyaddr($ip);           

        $query = sprintf
        ("
            INSERT INTO %s.t_failedadminlogin 
            (
                a_timestamp,
                a_username,
                a_password,
                a_ip,
                a_hostname
            )

            VALUES
            (
                UNIX_TIMESTAMP(),
                :username,
                :password,
                :ip,
                :hostname
            )", 
                
        Config::DB_WEB);

        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':username', $username);
        $dbh->bindParam(':password', $password);
        $dbh->bindParam(':ip', $ip);
        $dbh->bindParam(':hostname', $host);
        
        //var_dump($username, $password,$ip, $host); die;
        $dbh->execute();
        
    }
    
    function NoPermission()
    {
        global $tpl;
        $tpl->newBlock('noperm');
    }

    function Permission($flag)
    {
        global $tpl;

        if (is_array($flag))
        {
            foreach ($flag as $f)
            {
                if ($this->Can($f))
                {
                    $tpl->newBlock('showpage');
                    return true;
                }
            }

            $tpl->newBlock('noperm');
            return false;
        }
        else
        {
            if ($this->Can($flag))
            {
                $tpl->newBlock('showpage');
                return true;
            }
            else
            {
                $tpl->newBlock('noperm');
                return false;
            }
        }
    }

    function Can($flag)
    {
        if (strlen($this->rights) < $flag)
            return false;
        else
            return ($this->rights[$flag] == 1);
    }

    function ShowMenu($name, $text, $right, $url)
    {
        global $tpl;
        if ($right === false or $this->can($right))
            $tpl->assignGlobal($name, '<li><a href="' . $url . '" class="menulink">' . $text . '</a></li>');
    }

    function Value($name, $value, $right)
    {
        global $tpl;
        if ($this->can($right))
            $tpl->assign($name, $value);
        else
            $tpl->assign($name, 'hidden');
    }

    function TicketStatus($ticket, $status)
    {
        global $tpl;
        if (!$db = db::getConnection())
            return false;

        $query = sprintf("UPDATE %s.t_ticket_view SET a_ticket = :ticket, a_type = :type, a_timestamp = UNIX_TIMESTAMP() WHERE a_gm = :gm", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':ticket', $ticket, PDO::PARAM_INT);
        $dbh->bindParam(':type', $status, PDO::PARAM_INT);
        $dbh->bindParam(':gm', $this->name, PDO::PARAM_STR);

        $dbh->execute();
    }

}

    $admin = new Admin();
    $admin->CheckLogin();

    define('GTS_READING', 1);
    define('GTS_WRITING', 2);
    define('GTS_NONE', 0);


    define('RIGHT_SEARCHUSER', 0);
    define('RIGHT_SEARCHCHAR', 1);
    define('RIGHT_SEARCHGUILD', 2);
    define('RIGHT_SEARCHEMAIL', 3);
    define('RIGHT_SEARCHIP', 4);
    define('RIGHT_SEARCHNAMECHANGE', 5);
    define('RIGHT_VIEWUSERCASH', 6);
    define('RIGHT_VIEWUSERIP', 7);
    define('RIGHT_VIEWUSERBDAY', 8);
    define('RIGHT_VIEWUSERSECCODE', 9);
    define('RIGHT_VIEWUSERCHARACTERS', 10);
    define('RIGHT_EDITUSERNAME', 11);
    define('RIGHT_EDITUSERPASSWORD', 12);
    define('RIGHT_EDITUSEREMAIL', 13);
    define('RIGHT_EDITUSERBDAY', 14);
    define('RIGHT_EDITUSERSECCODE', 15);
    define('RIGHT_VIEWCHARGMLEVEL', 16);
    define('RIGHT_EDITFIRSTNAME', 17);
    define('RIGHT_EDITCHARNAME', 18);
    define('RIGHT_EDITLEVEL', 19);
    define('RIGHT_EDITCLASS', 20);
    define('RIGHT_EDITGOLD', 21);
    define('RIGHT_EDITSTATS', 22);
    define('RIGHT_EDITEXP', 23);
    define('RIGHT_EDITSP', 24);
    define('RIGHT_EDITREP', 25);
    define('RIGHT_EDITPK', 26);
    define('RIGHT_EDITTITLE', 27);
    define('RIGHT_EDITGUILDOUTDATE', 28);
    define('RIGHT_EDITGMLEVEL', 29);
    define('RIGHT_VIEWSKILLS', 30);
    define('RIGHT_EDITSKILLS', 31);
    define('RIGHT_VIEWINVENTORY', 32);
    define('RIGHT_DELETEINVENTORY', 33);
    define('RIGHT_EDITINVENTORY', 34);
    define('RIGHT_VIEWWAREHOUSE', 35);
    define('RIGHT_EDITWAREHOUSE', 36);
    define('RIGHT_DELETEWAREHOUSE', 37);
    define('RIGHT_VIEWFRIENDLIST', 38);
    define('RIGHT_DELETEFRIENDLIST', 39);
    define('RIGHT_VIEWQUESTS', 40);
    define('RIGHT_DELETEQUESTS', 41);
    define('RIGHT_VIEWAFFINITY', 42);
    define('RIGHT_EDITAFFINITY', 43);
    define('RIGHT_VIEWGUILDS', 44);
    define('RIGHT_VIEWPETS', 45);
    define('RIGHT_EDITPETS', 46);
    define('RIGHT_VIEWGIVEITEM', 47);
    define('RIGHT_DOGIVEITEM', 48);
    define('RIGHT_VIEWLASTLOGIN', 49);
    define('RIGHT_VIEWMALLHISTORY', 50);
    define('RIGHT_VIEWEMAILCHANGES', 51);
    define('RIGHT_VIEWNOTES', 52);
    define('RIGHT_ADDNOTES', 53);
    define('RIGHT_EDITNOTES', 54);
    define('RIGHT_DELETENOTES', 55);
    define('RIGHT_BANUNBAN', 56);
    define('RIGHT_UNBANOTHERBAN', 57);
    define('RIGHT_UNBANADMINBAN', 58);
    define('RIGHT_VIEWPASSWORDREQUESTS', 59);
    define('RIGHT_IPBAN', 60);
    define('RIGHT_IPUNBAN', 61);
    define('RIGHT_VIEWDONATIONS', 62);
    define('RIGHT_ADDCASH', 63);
    define('RIGHT_VIEWTOP100DONATOR', 64);
    define('RIGHT_VIEWONLINEPLAYERS', 65);
    define('RIGHT_EDITGMS', 66);
    define('RIGHT_ISADMIN', 67);
    define('RIGHT_ISHGM', 68);
    define('RIGHT_ISGM', 69);
    define('RIGHT_ISTGM', 70);
    define('RIGHT_EDITROLE', 71);
    define('RIGHT_VIEWTITLES', 72);
    define('RIGHT_VIEWHACKLOGS', 73);
    define('RIGHT_VIEWTRADEAGENT', 74);