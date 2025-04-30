<?php

    class ErrorMessage
    {
        function error( $msg )
        {
            global $tpl;

            $tpl->newBlock('error');
            $tpl->assign('msg' , $msg );
        }
    }

    $msg = new ErrorMessage();