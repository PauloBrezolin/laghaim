<?php

    class Config
    {
        const DBCON_URL = '127.0.0.1'; //'1.1.1.1'; 
        const DBCON_USER = 'root'; //'jane';
        const DBCON_PASS = '@*#457654@*#'; //'password..';

        const DB_AUTH = 'kor_ndev_neogeo=_user';
        const DB_USER = 'kor_ndev_neogeo_user';
        const DB_CHAR = 'kor_ndev_neogeo_char';
        const DB_DATA = 'kor_ndev_kaos_data';
        const DB_WEB  = 'neogeo_web';
        const DB_EVENT = 'kor_ndev_neogeo_event';

        const TICKET_DBCON_URL = '127.0.0.1';
        const TICKET_DBCON_USER = 'root';
        const TICKET_DBCON_PASS = '@*#457654@*#';
        const TICKET_DBCON_DB = 'zadmin_lhgn01web';  
        
        const SESSION_NAME = 'lhgn01new';
    }

    define('RACE_BULKAN', 0);
    define('RACE_KAILIPTON', 1);
    define('RACE_AIDIA', 2);
    define('RACE_HUMAN', 3);
    define('RACE_HIBRIDER', 4);
    define('RACE_PEROM', 5);