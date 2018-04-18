<?php

require_once '../config/config.php';

if(isset($_SESSION['user'])){
    
    unset($_SESSION['user']);
}

exit(header("Location:".ADMIN_BASS.'login.php'));
//exit(header("Location:" . BASE_ADMIN . 'login.php'));