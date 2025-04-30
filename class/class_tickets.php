<?php

    define('TICKET_TYPE_WAITUSER', 0);
    define('TICKET_TYPE_NEW', 1);
    define('TICKET_TYPE_WAITGM', 2);
    define('TICKET_TYPE_CLOSED', 3);

    class Tickets
    {

        private $_db;

        function __construct()
        {
            $this->_db = NULL;

            try
            {
                $this->_db = new PDO('mysql:host=' . Config::TICKET_DBCON_URL . ';dbname=' . Config::TICKET_DBCON_DB, Config::TICKET_DBCON_USER, Config::TICKET_DBCON_PASS);
                $this->_db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
            }
            catch (PDOException $e) 
            {
                $this->_db = NULL;
            }
        }

        public function isDbConnect()
        {
            if($this->_db == NULL)
                return false;

            return true;
        }

        function Create($email, $title, $msg, $code, $username, $charname)
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;

            $dbh = $this->_db->prepare
            ("
                INSERT INTO
                    t_ticket
                    (
                        a_create_date,
                        a_username,
                        a_charactername,
                        a_email,
                        a_passcode,
                        a_type,
                        a_message,
                        a_ip
                    )
                VALUES
                (
                    UNIX_TIMESTAMP(),
                    :username,
                    :charname,
                    :email,
                    MD5(:code),
                    :title,
                    :msg,
                    :ip
                );

            ");

            $dbh->bindParam(':username', $username, PDO::PARAM_STR);
            $dbh->bindParam(':charname', $charname, PDO::PARAM_STR);
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR);
            $dbh->bindParam(':title', $title, PDO::PARAM_STR);
            $dbh->bindParam(':msg', $msg, PDO::PARAM_STR);
            $dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);

            return $dbh->execute();

        }

        function TicketCount($email, $code)
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;

            $dbh = $this->_db->prepare("SELECT count(*) FROM t_ticket WHERE a_email = :email AND a_passcode = md5(:code);");
            $dbh->bindParam(':email', $email);
            $dbh->bindParam(':code', $code);

            if($dbh->execute())
            {
                $result = $dbh->fetch();
                if($result != null)
                    return $result[0];           
            }

            return 0;
        }

        function AddReply($tid, $msg)
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;

            $dbh = $this->_db->prepare
            ("
                INSERT INTO t_ticket_reply
                (
                    a_date,
                    a_user,
                    a_ip,
                    a_ticket,
                    a_msg
                )
                VALUES
                (
                    UNIX_TIMESTAMP(),
                    'Player',
                    :ip,
                    :tid,
                    :msg
                );

            ");

            $dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
            $dbh->bindParam(':tid', $tid, PDO::PARAM_INT);
            $dbh->bindParam(':msg', $msg, PDO::PARAM_STR);

            if($dbh->execute())
            {
                $dbh = $this->_db->prepare("UPDATE t_ticket SET a_replys = a_replys + 1, a_lastpost_user = 'Player' WHERE a_index = :tid");
                $dbh->bindParam(':tid', $tid, PDO::PARAM_INT);
                $dbh->execute();           
            }

        }

        function UpdateStatus($tid, $status)
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;

            $dbh = $this->_db->prepare("UPDATE t_ticket SET a_state = :state WHERE a_index = :tid");
            $dbh->bindParam(':state', $status, PDO::PARAM_INT);
            $dbh->bindParam(':tid', $tid, PDO::PARAM_INT);

            $dbh->execute();

        }

        function SetState($id, $email, $code, $state)
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;

            $dbh = $this->_db->prepare("UPDATE t_ticket SET a_state = :state WHERE a_email = :email AND a_passcode = md5(:code) AND a_index = :id;");
            $dbh->bindParam(':state', $state, PDO::PARAM_INT);
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            $dbh->bindParam(':code', $code);
            $dbh->bindParam(':id', $id, PDO::PARAM_INT);                        
            $dbh->execute();        
        }
        
        function GetTicket($id, $email, $code) 
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;            
            
            $dbh = $this->_db->prepare("SELECT a_index, a_username, a_charactername, a_state, a_type, a_message, a_replys
                                        FROM t_ticket 
                                        WHERE a_email = :email 
                                        AND a_passcode = md5(:code) 
                                        AND a_index = :id;");
                                            
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR);
            $dbh->bindParam(':id', $id, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return null;
            
            $r = $dbh->fetch();
            if($r == null)
                return null;
            
            $ticket = new stTicket();
            $ticket->id = $r['a_index'];
            $ticket->username = $r['a_username'];
            $ticket->charname = $r['a_charactername'];
            $ticket->state = $r['a_state'];
            $ticket->type = $r['a_type'];
            $ticket->message = $r['a_message'];
            $ticket->replys = $r['a_replys'];
            
            return $ticket;
        }
        
        function GetReplys($id)
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;
            
            $replys = array();
            
            $dbh = $this->_db->prepare("SELECT * FROM t_ticket_reply WHERE a_ticket = :id ORDER BY a_index");
            $dbh->bindParam(':id', $id, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return $replys;
            
            while($r = $dbh->fetch())
            {
                $reply = new stTicketReply();
                $reply->id = $r['a_index'];
                $reply->date = $r['a_date'];
                $reply->user = $r['a_user'];
                $reply->message = $r['a_msg'];
                $reply->ip = $r['a_ip'];
                $replys[] = $reply;
            }
            
            return $replys;
        }
        
        function getTicketList($email, $code)
        {
            if(!$this->isDbConnect())
                return ERROR_NO_DATABASE;
            
            $tlist = array();
            
            $dbh = $this->_db->prepare("SELECT a_index, a_state, a_type, a_replys FROM t_ticket WHERE a_email = :email AND a_passcode = md5(:code) ORDER BY a_state, a_index;");
            
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR);

            if(!$dbh->execute())
                return $tlist;
            
            while($r = $dbh->fetch())
            {
                $cur = new stTicket();
                $cur->id = $r['a_index'];
                $cur->state = $r['a_state'];
                $cur->type = $r['a_type'];
                $cur->replys = $r['a_replys'];
                
                $tlist[] = $cur;
            }
            
            return $tlist;
        }          
    }

    class stTicket
    {
        public $id;
        public $create_date;
        public $lastpost;
        public $username;
        public $charname;
        public $email;
        public $passcode;
        public $state;
        public $type;
        public $message;
        public $ip;
        public $replys;
        public $needadmin;
        public $category;
        
        public function getIcon()
        {
            switch($this->state)
            {
                case TICKET_TYPE_WAITUSER:
                    return 'tpl/images/ticket_new.png';
                    break;
                case TICKET_TYPE_CLOSED:
                    return 'tpl/images/ticket_closed.png';
                    break;
                default:
                    return 'tpl/images/ticket_normal.gif';
                    break;
            }
        }
    
    }
    
    class stTicketReply
    {
        public $id;
        public $date;
        public $user;
        public $message;
        public $ip;
    }

?>
