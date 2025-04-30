<?php
    if(isset($_GET['ip']))
        echo @gethostbyaddr($_GET['ip'])
?>
