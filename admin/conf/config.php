<?php

    $config["server"] = 'live';
    $config["pagetitle"] = 'Admin Panel - Laghaim Universe';
    $config["salt"] = '(@)DJxajDMxlaalq<vbn</.';

    if(isset($tpl))
        $tpl->assignGlobal('servername', $config['pagetitle']);	       
        
    class Config
    {
        const DBCON_URL = '127.0.0.1';
        const DBCON_USER = 'root';
        const DBCON_PASS = '@*#457654@*#';

        const DB_DATA = 'kor_ndev_kaos_data';
        const DB_CHAR = 'kor_ndev_neogeo_char';
        const DB_USER = 'kor_ndev_neogeo_user';
        const DB_EVENT = 'kor_ndev_neogeo_event';
        const DB_WEB = 'neogeo_web';
        
        const SESSION_NAME = 'Laghaim Universe';
        const SALT = 'DFSADF@#r12rq4fdsaaf!@!@#%DSA}{<';
        }	
	

?>
