<?php

    require_once 'conf/config.php';
    require_once 'class/class_db.php';
    require_once 'inc/functions.php';
        
    require_once 'class/class_message.php';
    require_once 'class/class_admin.php';
    require_once 'class/class_log.php';
	
    $log = new Log();       
    $db = db::getConnection();