<?php

    define('ERROR_WRONG_LOGIN', 'loginerr1');
    define('ERROR_WRONG_VALIDATION_CODE', 'cr_1');    
    define('ERROR_NO_USER', 'NU3');
    define('ERROR_WRONG_CODE', 'DFSD3');

    class user
    {
        /**
         *
         * @var user
         */
        protected static $user;
        
        public $id;
        public $name;
        public $login;
        public $cash;
        public $email;
        
        protected function __construct()
        {
            $this->id = -1;
            $this->name = '';
            $this->login = false;
            $this->cash = 0;
            
            self::checkLogin();
        }
        
       /**
        * 
        * @return user;
        */
        public static function getInstance() 
        {
            if (!self::$user) 
                self::$user = new user();
            
            return self::$user;
        }          
        
        public function doLogin($username, $password, $code) 
        {
            if(!isset($_SESSION['security_answer']))
                return ERROR_WRONG_CODE;
            
            if($_SESSION['security_answer'] != $code)
                return ERROR_WRONG_CODE;    
            
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            $query = sprintf
            ("
                SELECT user_code, user_id, email
                FROM %s.bg_user 
                WHERE user_id = :username 
                AND passwd = password(:password)
                
             ", Config::DB_AUTH);
            
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':username', $username, PDO::PARAM_STR);
            $dbh->bindParam(':password', $password, PDO::PARAM_STR);
            
            if(!$dbh->execute())
            {
                print_r($dbh->errorInfo());
                return ERROR_NO_DATABASE;
            }
            
            if(!$r = $dbh->fetch())
                return ERROR_WRONG_LOGIN;
            
            $this->id = $r['user_code'];
            $this->name = $r['user_id'];
            $this->email = $r['email'];
            $this->login = true;
            
            $query = sprintf("SELECT lpu_user_lag_point FROM %s.TBL_LaghaimPointUser WHERE lpu_user_idx = :uid", Config::DB_EVENT);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            $dbh->execute();
            
            if(!$r = $dbh->fetch())
                $this->cash = 0;
            else            
                $this->cash = $r['lpu_user_lag_point'];
            
            self::updateSession();            
            
            return ERROR_SUCCESS;
            
        }
        
        public function logout()
        {
            $this->id = -1;
            $this->name = '';
            $this->email = '';
            $this->login = false;
            $this->cash = 0;            
            
            $_SESSION[Config::SESSION_NAME . 'user_info'] = '';
            $_SESSION[Config::SESSION_NAME . 'user_ip'] = '';
            $_SESSION[Config::SESSION_NAME . 'user_update'] = 0;
        }
        
        public function checkLogin()
        {
            if(isset($_SESSION[Config::SESSION_NAME . 'user_info']) && isset($_SESSION[Config::SESSION_NAME . 'user_ip']))
            {
                if($_SESSION[Config::SESSION_NAME . 'user_ip'] == $_SERVER['REMOTE_ADDR'])
                {
                    $vars = explode(':', $_SESSION[Config::SESSION_NAME . 'user_info']);
                    if(count($vars) == 4)
                    {
                        $this->id = $vars[0];
                        $this->name = $vars[1];
                        $this->cash = $vars[2];
                        $this->email = $vars[3];
                        $this->login = true;
                        
                        return true;
                    }
                }
            }
            
            return false;
            
        }
        
        private function updateSession()
        {
            $_SESSION[Config::SESSION_NAME . 'user_ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION[Config::SESSION_NAME . 'user_info'] = sprintf('%d:%s:%d:%s', $this->id, $this->name, $this->cash, $this->email);
            $_SESSION[Config::SESSION_NAME . 'user_update'] = time();
        }
        
        public function updateCash($force = false)
        {
            if(!$this->login)
                return false;
            
            if(!$db = db::getConnection())
                return false;
            
            if(!$force)
            {
                if($_SESSION[Config::SESSION_NAME . 'user_update'] == 0 || (time() - $_SESSION[Config::SESSION_NAME . 'user_update']) < (60*5))
                    return false;
            }
            
            $query = sprintf("SELECT lpu_user_lag_point FROM %s.TBL_LaghaimPointUser WHERE lpu_user_idx = :uid", Config::DB_EVENT);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                $this->cash = 0;
            else            
                $this->cash = $r['lpu_user_lag_point'];
            
            self::updateSession();
            
            return true;            
        }
        
        public function isBanned()
        {
            if(!$this->login)
                return false;
            
            if(!$db = db::getConnection())
                return false;
            
            $query = sprintf("SELECT a_enable FROM %s.t_users WHERE a_2p4p_user_code = :uid", Config::DB_AUTH);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            if($r['a_enable'] == 1)
                return false;           
            
            return true;            
        }
        
        public function isOnlineIngame()
        {
            if(!$this->login)
                return false;
            
            if(!$db = db::getConnection())
                return false;
            
            $query = sprintf("SELECT a_connect FROM %s.t_users WHERE a_2p4p_user_code = :uid", Config::DB_AUTH);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            if($r['a_zone_num'] == -1)
                return false;           
            
            return true;              
        }
        
        public function isPassword($password)
        {
            if(!$this->login)
                return false;
            
            if(!$db = db::getConnection())
                return false;
            
            $query = sprintf("SELECT count(*) FROM %s.bg_user WHERE user_code = :uid AND passwd = password(:pwd)", Config::DB_AUTH);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            $dbh->bindParam(':pwd', $password, PDO::PARAM_STR);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            if($r[0] != 1)
                return false;           
            
            return true;            
        }        
        
        public function setPassword($password)
        {
            if(!$this->id == -1)
                return false;
            
            if(!$db = db::getConnection())
                return false;
            
            $query = sprintf
            ("
                UPDATE %s.bg_user 
                SET 
                    passwd = password(:password), 
                    old_passwd = old_password(:password)
                WHERE user_code = :uid"
                    
            , Config::DB_AUTH);
            
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            $dbh->bindParam(':password', $password, PDO::PARAM_STR);
            
            if(!$dbh->execute())
                return false;
            
            return true;
        }
        
        public function setPasswordFromCode($code, $password)
        {
            if(!$this->id == -1)
                return ERROR_NO_USER;
            
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;      
            
            $query = sprintf
            ("
                SELECT count(*) 
                FROM %s.t_requestpass 
                WHERE a_username = :uname 
                AND a_code = :code 
                AND a_used = 0"
                    
            , Config::DB_WEB);
            
            $dbh = $db->prepare($query);

            $dbh->bindParam(':uname', $this->name, PDO::PARAM_STR, 15);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR, 8);

            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            if(!$r = $dbh->fetch())
                return ERROR_WRONG_CODE;

            if($r[0] != 1)
                return ERROR_WRONG_CODE;
            
            if(!$this->setPassword($password))
                return  ERROR_NO_DATABASE;
            
            
            $query = sprintf
            ("
                UPDATE %s.t_requestpass 
                SET a_used = 1 
                WHERE a_username = :uname 
                AND a_code = :code 
                AND a_used = 0"
                    
            , Config::DB_WEB);
            $dbh = $db->prepare($query);

            $dbh->bindParam(':uname', $this->name, PDO::PARAM_STR, 15);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR, 8);

            $dbh->execute();
            
            
            // Set all open other password requests of same user to 3
            $query = sprintf
            ("
                UPDATE %s.t_requestpass 
                SET a_used = 3 
                WHERE a_username = :uname 
                AND a_used = 0"
                    
            , Config::DB_WEB);
            $dbh = $db->prepare($query);

            $dbh->bindParam(':uname', $this->name, PDO::PARAM_STR, 15);

            $dbh->execute();                 
            
            return ERROR_SUCCESS;
                          
        }
        
        public function setEmailForValidation($email)
        {
            if(!$this->login)
                return false;
            
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            $validationcode = hash('sha512', time() . 'SALT');
            
            $query = sprintf
            ("
                INSERT INTO %s.t_user_validation
                (
                    a_username,
                    a_email,
                    a_ip,
                    a_validationcode,
                    a_for_reg
                )
                VALUES
                (
                    :username,
                    :email,
                    :ip,
                    :validationcode,
                    0
                )"
                    
            , Config::DB_WEB);
            
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':username', $this->name, PDO::PARAM_STR);
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            $dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
            $dbh->bindParam(':validationcode', $validationcode, PDO::PARAM_STR);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            if(!SendMail::ChangeEMailValidation($this->name, $email, 'http://www.lhgenericname01.lc/?do=validate_changemail&code=' . $validationcode))
                return ERROR_NO_SENDMAIL;
            
            return ERROR_SUCCESS;
                    
        }
        
        public function setEmailFromCode($code)
        {
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            $query = sprintf("SELECT * FROM %s.t_user_validation WHERE a_validationcode = :code AND a_for_reg = 0", Config::DB_WEB);
            $dbh = $db->prepare($query);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR, 128);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            if(!$r = $dbh->fetch())
                return ERROR_WRONG_VALIDATION_CODE;
            
            $email = $r['a_email'];
            $username = $r['a_username'];
            $uid = $this->GetId($username);
            
            if($uid == -1)
                return ERROR_NO_DATABASE;
            
            $query = sprintf
            ("
                UPDATE %s.bg_user 
                SET email = :email
                WHERE user_code = :uid"
                    
            , Config::DB_AUTH);
            
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            
            $query = sprintf
            ("
                INSERT INTO %s.t_mailchange
                (
                    a_user_index, 
                    a_time, 
                    a_ip, 
                    a_newmail
                )
                VALUES
                (
                    :uid,
                    NOW(),
                    :ip,
                    :email
                )"
                    
            , Config::DB_WEB);
            
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);
            $dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;            
            
            $query = sprintf("DELETE FROM %s.t_user_validation WHERE a_username = :username", Config::DB_WEB);
            $dbh = $db->prepare($query);
            $dbh->bindParam(':username', $username, PDO::PARAM_STR);
            $dbh->execute();            
            
            // Delete from t_request_pass also to prevent getting password back
            $query = sprintf("UPDATE %s.t_requestpass SET a_used = 3 WHERE a_username = :username", Config::DB_WEB);
            $dbh = $db->prepare($query);
            $dbh->bindParam(':username', $username, PDO::PARAM_STR);
            $dbh->execute();
            
            
            return ERROR_SUCCESS;
            
        }
        
        public function isSecurityCode($code)
        {
            if(!$this->id == -1)
                return false;
            
            if(!$db = db::getConnection())
                return false;
            
            $query = sprintf("SELECT count(*) FROM %s.bg_user WHERE user_code = :uid AND pin = :pin", Config::DB_AUTH);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            $dbh->bindParam(':pin', $code, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            if($r[0] != 1)
                return false;           
            
            return true;            
        }
        
        public function getUserFromName($username)
        {
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            $query = sprintf
            ("
                SELECT user_code, user_id, email
                FROM %s.bg_user 
                WHERE user_id = :username 
                
             ", Config::DB_AUTH);
            
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':username', $username, PDO::PARAM_STR);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            if(!$r = $dbh->fetch())
                return ERROR_WRONG_LOGIN;
            
            $this->id = $r['user_code'];
            $this->name = $r['user_id'];
            $this->cash = 0;
            $this->email = $r['email'];
            $this->login = false;
            
            return ERROR_SUCCESS;            
        }
        
        
        public function isEmail($email)
        {
            if(!$this->login)
                return false;
            
            if(!$db = db::getConnection())
                return false;
            
            $query = sprintf("SELECT count(*) FROM %s.bg_user WHERE user_code = :uid AND email = :email", Config::DB_AUTH);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
            $dbh->bindParam(':email', $email, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            if($r[0] == 1)
                return true;           
            
            return false;             
        }
        
        public function GetId($username)
        {
            if(!$db = db::getConnection())
                return -1;
            
            $query = sprintf("SELECT user_code FROM %s.bg_user WHERE user_id = :uname", Config::DB_AUTH);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uname', $username, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return -1;
            
            if(!$r = $dbh->fetch())
                return -1;
            
            return $r[0];             
        }
        

        function requestPassword()
        {
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            // Remove all old requests for this user before we continue
            $query = sprintf("UPDATE %s.t_requestpass SET a_used = 3 WHERE a_username = :username", Config::DB_WEB);
            $dbh = $db->prepare($query);
            $dbh->bindParam(':username', $this->name, PDO::PARAM_STR);
            $dbh->execute();            
            
            $code = substr(hash('whirlpool', time()), 0, 12);

            $query = sprintf
            ("
                INSERT INTO %s.t_requestpass 
                (
                    a_username, 
                    a_code, 
                    a_addtime
                ) 
                VALUES
                (
                    :uname, 
                    :code, 
                    UNIX_TIMESTAMP()
                )"
                    
            , Config::DB_WEB);
            
            $dbh = $db->prepare($query);

            $dbh->bindParam(':uname', $this->name, PDO::PARAM_STR, 18);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR, 8);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            if(!SendMail::LostPasswordEmail($this->name, $this->email, 'http://www.lhgenericname01.lc/?do=request_pass&code=' . $code))
                return ERROR_NO_SENDMAIL;
            
            return ERROR_SUCCESS;
        }
        
        function getMaxLevel()
        {
            if(!$db = db::getConnection())
                return 0;   

            if ($this->id == -1)
                return 0;

            $query = sprintf
            ("
                SELECT max(a_level) 
                FROM 
                    %s.t_characters c, 
                    %s.t_users u 
                WHERE u.a_2p4p_user_code = :uid 
                AND c.a_user_index = u.a_index"

            , Config::DB_CHAR,
              Config::DB_AUTH);
            
            $dbh = $db->prepare($query);
            $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);

            if ($dbh->execute())
            {
                $r = $dbh->fetch();
                if ($r != null)
                    return $r[0];
            }
            
            return 0;
        }
        
        function addUnstuck()
        {
            if(!$db = db::getConnection())
                return 0;   

            if ($this->id == -1)
                return 0;

            $query = sprintf("INSERT INTO %s.t_unstuck (a_idname) VALUES(:idname)", Config::DB_USER);
            $dbh = $db->prepare($query);
            $dbh->bindParam(':idname', strtolower($this->name), PDO::PARAM_STR);

            if ($dbh->execute())
            {
                $query = sprintf("INSERT INTO %s.t_unstuck_log (a_user_index, a_ip) VALUES(:uid, :ip)", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);
                $dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $dbh->execute();

                return true;
            }

            return false;
        }   

    }
