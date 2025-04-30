<?php
        
	$conf['db']['server'] = '1.1.1.1';
	$conf['db']['user'] = 'a';
	$conf['db']['pass'] = 'a';
     
	
	$conf['dbname']['data'] =  'kor_ndev_neogeo_data';
	$conf['dbname']['event'] = 'kor_ndev_2pan4pan_event_db';
	$conf['dbname']['db'] =    'kor_ndev_neogeo_char';
	$conf['dbname']['user'] =  'kor_2pan4pan_user_db';
	

	class Strings
	{
		var $data;
		var $db;
		var $user;
		var $event;
		
		function strings()
		{
			global $conf;
			
			$this->data = $conf['dbname']['data'];
			$this->db = $conf['dbname']['db'];
            $this->user = $conf['dbname']['user'];
			$this->event = $conf['dbname']['event'];
		}
	}
	
	$s = new Strings();	
	
	// Create the DSN
	$conf['db']['dsn'] = sprintf("mysql:host=%s", $conf['db']['server'] );
	
	
	// Try to connect to the database
	try 
	{
		$db = new PDO($conf['db']['dsn'], $conf['db']['user'], $conf['db']['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	} 
	catch(PDOException $e)
	{
		die('Error connecting to the database');
	}
	
	
	
	if(isset($_POST['action']) && $_POST['action'] == 'ctsa')
	{
		
		if(strlen($_POST['username']) < 3 || strlen($_POST['username']) > 30)
			echo 'Username have to be between 3 and 30 long';
		if(!ctype_alnum($_POST['username']))
			echo 'Username is not valid, use only letters and numbers';
		else if(strlen($_POST['password']) < 3 || strlen($_POST['password']) > 30)
			echo 'Password have to be between 3 and 30 long';
		else
		{
			$dbh = $db->prepare(sprintf("SELECT count(*) FROM %s.bg_user WHERE user_id = :uname", $s->user));
			$dbh->bindParam(':uname', $_POST['username']);
			$dbh->execute();
			$result = $dbh->fetch();
			if($result[0] == 0)
			{
				$dbh = $db->prepare
				("
					INSERT INTO kor_2pan4pan_user_db.bg_user 
					(
						user_id, 
						passwd, 
						old_passwd, 
						name,
						email
						
					) 
					VALUES
					(
						LOWER(:username), 
						password(:password), 
						old_password(:password), 
						'Test Team',
						:ip
					)
				");

				$dbh->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
				$dbh->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
				$dbh->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
				
				if($dbh->execute())
				{
					$index = $db->lastInsertId();  
					
					$dbh = $db->prepare
					("
						INSERT INTO kor_ndev_2pan4pan_event_db.TBL_LaghaimPointUser
						(
							lpu_user_idx, 
							lpu_user_idname, 
							lpu_user_lag_point, 
							lpu_update_date
						) 
						VALUES
						(
							:uid,
							LOWER(:username),
							8388607,
							NOW()
						)
					");
					
					$dbh->bindParam(':uid', $index, PDO::PARAM_INT);
					$dbh->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
				
					if($dbh->execute())
					{
						echo 'Account created';
					}
					else
						echo 'Account created but error adding L.P.';
				}
				else
					echo 'Error creating account';
			}
			else
				echo 'Username already taken, please use another one';
		
			
		}
	}
else
{	
	
	
	
	echo '
    <form method="post" action="createAccount.php" id="ctsa">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" value="Create TestServer Account" />
                <input type="hidden" name="action" value="ctsa" />
            </td>
        </tr>
    </table>
    </form>
';	
}