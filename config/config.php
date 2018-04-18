<?php

require_once'consts.php';
require_once'conection.php';
//----------------------------------------------------

require_once LAYOUT_ADMIN_PATH.'app.admin.php';
require_once LAYOUT_PATH.'app.view.php';
require_once LIB_PATH .'user.php';


if(session_status()==PHP_SESSION_NONE){
    session_start();
}






