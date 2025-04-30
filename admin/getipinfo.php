<?php

    session_start();

    if(isset($_GET['ip']))
    {
        
        if(isset($_SESSION['ip_' . $_GET['ip']]))
            echo $_SESSION['ip_' . $_GET['ip']];
        else
        {
            $ip = $_GET['ip'];
            $ipd = json_decode(file_get_contents("http://freegeoip.net/json/{$ip}"));

            $_SESSION['ip_' . $_GET['ip']] = $ipd->country_name . ' - ' . $ipd->region_name . ' - <img src="data/flags/'.$ipd->country_code.'.gif" />';

            echo $_SESSION['ip_' . $_GET['ip']];        
        }
    }
?>
