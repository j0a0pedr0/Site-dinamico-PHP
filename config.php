<?php

    SESSION_START();

    $autoload = function($class){
        if($class == 'Email'){
            require_once('./classes/vendor/autoload.php');
        }
        include('./classes/'.$class.'.php');
    };

   
  

    spl_autoload_register($autoload);

    define('INCLUDE_PATH','http://localhost/criando_site_dinamico/');

    
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

    //Conectar com o banco de dados
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','criando_site_dinamico');


?>