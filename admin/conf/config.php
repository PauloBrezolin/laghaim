<?php

$config["server"]    = 'local';
$config["pagetitle"] = 'Admin Panel - Laghaim Universe';
$config["salt"]      = '(@)DJxajDMxlaalq<vbn</.';

if (isset($tpl)) {
    $tpl->assignGlobal('servername', $config['pagetitle']);
}

class Config
{
    // Conexão MySQL local
    const DBCON_URL  = 'localhost';  // ou 'localhost'
    const DBCON_USER = 'root';
    const DBCON_PASS = '';          // sem senha no XAMPP

    // Schemas / databases já importados
    const DB_DATA  = 'kor_ndev_kaos_data';
    const DB_CHAR  = 'kor_ndev_neogeo_char';
    const DB_USER  = 'kor_ndev_neogeo_user';
    const DB_EVENT = 'kor_ndev_neogeo_event';
    const DB_WEB   = 'neogeo_web';

    const SESSION_NAME = 'Laghaim Universe';
    const SALT         = 'DFSADF@#r12rq4fdsaaf!@!@#%DSA}{<';
}