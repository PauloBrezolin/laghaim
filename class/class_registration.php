<?php

    class registration
    {
        
        var $username;
        var $password;
        var $email;
        var $securitycode;
        
        function registerForValidation($username, $password, $email, $securitycode)
        {
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            $validationcode = hash('sha512', time() . 'SALT');
            
            $query = sprintf
            ("
                INSERT INTO %s.t_user_validation
                (
                    a_username,
                    a_password,
                    a_email,
                    a_securitycode,
                    a_ip,
                    a_validationcode,
                    a_for_reg
                )
                VALUES
                (
                    :username,
                    :password,
                    :email,
                    :securitycode,
                    :ip,
                    :validationcode,
                    1
                )"
                    
            , Config::DB_WEB);
            
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':username', $username, PDO::PARAM_STR);
            $dbh->bindParam(':password', $password, PDO::PARAM_STR);
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            $dbh->bindParam(':securitycode', $securitycode, PDO::PARAM_STR);
            $dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
            $dbh->bindParam(':validationcode', $validationcode, PDO::PARAM_STR);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            if(!SendMail::RegistrationValidation($username, $email, 'http://www.laghaimfusion.com/?do=validate&code=' . $validationcode))
                return ERROR_NO_SENDMAIL;
            
            return ERROR_SUCCESS;
            
        }
        
        function ValidateFromCode($code)
        {
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            $query = sprintf("SELECT * FROM %s.t_user_validation WHERE a_validationcode = :code AND a_for_reg = 1", Config::DB_WEB);
            $dbh = $db->prepare($query);
            $dbh->bindParam(':code', $code, PDO::PARAM_STR, 128);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            if(!$r = $dbh->fetch())
                return ERROR_WRONG_VALIDATION_CODE;
            
            $this->username = $r['a_username'];
            $this->password = $r['a_password'];
            $this->email = $r['a_email'];
            $this->securitycode = $r['a_securitycode'];
            
            $register = self::registerFinal($this->username, $this->password, $this->email, $this->securitycode);
            if($register == ERROR_SUCCESS || $register == ERROR_NO_SENDMAIL)
            {
                $query = sprintf("DELETE FROM %s.t_user_validation WHERE a_validationcode = :code AND a_for_reg = 1", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':code', $code, PDO::PARAM_STR, 128);
                $dbh->execute();
            }

            return $register;
            
            
        }
        
        function registerFinal($username, $password, $email, $securitycode)
        {
            if(!$db = db::getConnection())
                return ERROR_NO_DATABASE;
            
            $query = sprintf
            ("
                INSERT INTO %s.bg_user
                (
                    user_id,
                    name,
                    passwd,
                    old_passwd,
                    email,
                    regmail,
                    regdate,
                    regip,
                    pin
                )
                VALUES
                (
                    LOWER(:username),
                    LOWER(:username),
                    password(:password),
                    old_password(:password),
                    :email,
                    :email,
                    NOW(),
                    :ip,
                    :securitycode
                )"
                    
            , Config::DB_AUTH);
            
            $dbh = $db->prepare($query);
            $dbh->bindParam(':username', $username, PDO::PARAM_STR);
            $dbh->bindParam(':password', $password, PDO::PARAM_STR);
            $dbh->bindParam(':email', $email, PDO::PARAM_STR);
            $dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
            $dbh->bindParam(':securitycode', $securitycode, PDO::PARAM_STR, 4);
            
            if(!$dbh->execute())
                return ERROR_NO_DATABASE;
            
            
            if(!SendMail::RegistrationComplete($username, $password, $email, $securitycode))
                return ERROR_NO_SENDMAIL;
            
            
            return ERROR_SUCCESS;
        }
        
    }
