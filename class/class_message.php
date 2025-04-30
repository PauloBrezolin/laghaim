<?php

    class ErrorMessage
    {
        function error($var1, $var2 = 'notused')
        {
            global $tpl;
            
            $tpl->newBlock('error');
            if($var2 == 'notused')
            {
                $tpl->assign('msg', $var1);
                $tpl->assign('title', 'Error');
            }
            else
            {
                $tpl->assign('msg', $var2);
                $tpl->assign('title', $var1);            
            }
        }
        
        function success($var1, $var2 = 'notused')
        {
            global $tpl;

            $tpl->newBlock('success');
            if($var2 == 'notused')
            {
                $tpl->assign('msg', $var1);
                $tpl->assign('title', 'Success');
            }
            else
            {
                $tpl->assign('msg', $var2);
                $tpl->assign('title', $var1);            
            }
        }
    }
    
    $msg = new ErrorMessage();

?>
