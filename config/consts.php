<?php

define('APP_NAME', 'APP1');
//define('APP_NAME', 'APP1');
//connections

//$dsn ="mysql:host=localhost;dbname=session21";
$dbname = "app1";
$driver = "mysql";
$host = "localhost";

$dsn ="$driver:host=$host;dbname=$dbname";
$username="root";

$password="";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];



//define('ds', DIRECTORY_SEPARATOR);
define('ds', DIRECTORY_SEPARATOR);

//PATH

define('APP_PATH', dirname(__DIR__) . ds);
define('CONFIG_PATH', APP_PATH . 'config' . ds);
define('LIB_PATH', APP_PATH . 'libs' . ds);
//define('LIBS_PATH', APP_PATH . 'libs' . ds);
define('TEMP_PATH',APP_PATH.'templates'.ds);
define('LAYOUT_PATH',TEMP_PATH.'layout'.ds);

// admin path


define('ADMIN_PATH',APP_PATH.'admin'.ds);
define('TEMP_ADMIN_PATH',ADMIN_PATH.'templates'.ds);
define('LAYOUT_ADMIN_PATH',TEMP_ADMIN_PATH.'layout'.ds);


//base url

define('BASE_URL',"http://".$_SERVER['HTTP_HOST']."/app1".'/');
define('CSS_URL',BASE_URL."templates/css".'/');
define('IMAGES_URL',BASE_URL."templates/images".'/');

 //admin url
define('ADMIN_BASS',BASE_URL."admin".'/');
define('CSS_ADMIN_URL',BASE_URL."admin/templates".'/');
define('IMAGES_ADMIN_URL',BASE_URL."admin/templates/images".'/');

