<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/notes.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    require_once 'class/class_notes.php';
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_VIEWNOTES))
        {
            $user = new User();
            $note = new Notes();
            
            if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
            {

                if($user->isUser($_GET['uid']))
                {
                    
                    // Do actions like Add, Edit, Delete
                    if(isset($_POST['action']) || isset($_GET['del']))
                    {
                        if($_POST['action'] == 'addnote' && $admin->Can(RIGHT_ADDNOTES))
                            if(!$note->Add($user->id, $_POST['msg']))
                                    $msg->error('Failed to add note');
                        
                        if($_POST['action'] == 'editnote' && $admin->Can(RIGHT_EDITNOTES))
                        {
                            $curNote = $note->Get($_POST['id']);
                            if($curNote->gm == $admin->name || $admin->Can(RIGHT_ISADMIN))
                                $note->Edit($_POST['id'], $_POST['msg']);
                        }
                    
                        if(ctype_digit($_GET['del']))
                        {
                            $curNote = $note->Get($_GET['del']);
                            if(($admin->Can(RIGHT_DELETENOTES) && $curNote->gm == $admin->name) || $admin->Can(RIGHT_ISADMIN))
                            {
                                $note->Delete($curNote->id);                        
                                
                            }
                        }
                    }
                    
                    
                    
                    // Get current notes
                    $notes = $note->GetAll($user->id);
                    foreach($notes as $cur)
                    {
                        $tpl->newBlock('list');
                        $tpl->assign('gm', $cur->gm);
                        $tpl->assign('msg', $cur->msg);
                        $tpl->assign('date', $cur->date);   
                        $tpl->assign('id', $cur->id);
                        
                        if(($admin->Can(RIGHT_DELETENOTES) && $cur->gm == $admin->name) || $admin->Can(RIGHT_ISADMIN))
                            $tpl->assign('delete', '<a href="notes.php?uid='.$user->id.'&del=' . $cur->id .'" class="menulink"><img src="tpl/img/delete.png" /></a>');
                        
                        if(($admin->Can(RIGHT_EDITNOTES) && $cur->gm == $admin->name) || $admin->Can(RIGHT_ISADMIN))
                            $tpl->assign('edit', '<a href="javascript:getNoteEdit('.$cur->id.', \'note'.$cur->id.'\', \''.addslashes($cur->msg).'\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
                    }
                    
                    
                    // Show add note form
                    if($admin->Can(RIGHT_ADDNOTES))
                    {
                        $tpl->newBlock('addnotes');
                        $tpl->assign('gm', $admin->name);
                        $tpl->assign('date', date('l, d F Y - H:i:s' , time()));                        
                        $tpl->assign('uid', $user->id);
                    }


                }
                else
                    $msg->error('No user found with this id');
            }
            else
                $msg->error('No user id given');    
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

