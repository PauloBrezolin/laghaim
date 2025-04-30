<?php

class tNote
{

    var $id;
    var $gm;
    var $msg;
    var $date;
    var $user;

}

class Notes
{

    function Add($uid, $msg)
    {
        global $s, $db, $admin, $user;

        $query = sprintf("INSERT INTO %s.t_usernote (a_user_index, a_gm, a_note, a_timestamp) VALUES(:uid, :gm, :msg, :time)", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $user->id, PDO::PARAM_INT);
        $dbh->bindParam(':gm', $admin->name, PDO::PARAM_STR);
        $dbh->bindParam(':msg', $msg, PDO::PARAM_STR);
        $dbh->bindParam(':time', time(), PDO::PARAM_STR);

        if ( $dbh->execute() )
            return true;
        else
        {
            print_r($dbh->errorInfo());
            return false;
        }
    }
    
    
    function GetAll($uid)
    {
        global $s, $db, $admin, $user;

        $query = sprintf('SELECT * FROM %s.t_usernote WHERE a_user_index = :uid', Config::DB_WEB);

        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        $vals = array();

        if ( $dbh->execute() )
        {
            $result = $dbh->fetchAll();
            foreach ( $result as $r )
            {
                $val = new tNote();
                $val->id = $r['a_index'];
                $val->date = date('l, d F Y - H:i:s', $r['a_timestamp']);
                $val->gm = $r['a_gm'];
                $val->msg = nl2br(htmlspecialchars($r['a_note']));

                $vals[ ] = $val;
            }
        }

        return $vals;
    }

    function Get($id)
    {
        global $s, $db, $admin, $user;

        $note = new tNote();

        $query = sprintf('SELECT * FROM %s.t_usernote WHERE a_index = :id', Config::DB_WEB);

        $dbh = $db->prepare($query);
        $dbh->bindParam(':id', $id, PDO::PARAM_INT);


        $dbh->execute();
        $r = $dbh->fetch();

        if ( $r != null )
        {
            $note->id = $r['a_index'];
            $note->date = date('l, d F Y - H:i:s', $r['a_timestamp']);
            $note->gm = $r['a_gm'];
            $note->msg = nl2br(htmlspecialchars($r['a_note']));
            $note->user = $r['a_user_index'];
        }

        return $note;
    }
    
    function Edit($id, $msg)
    {
        global $s, $db, $admin, $user;
        
        $query = sprintf('UPDATE %s.t_usernote SET a_note = :note WHERE a_index = :id', Config::DB_WEB);
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':note', $msg, PDO::PARAM_STR);
        $dbh->bindParam(':id', $id, PDO::PARAM_INT);
        
        $dbh->execute();
    }
    
    function Delete($id)
    {
        global $s, $db;
        
        $query = sprintf('DELETE FROM %s.t_usernote WHERE a_index = :id', Config::DB_WEB);
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':id', $id, PDO::PARAM_INT);
        
        $dbh->execute();        
    }

}

?>
