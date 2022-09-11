<?php

SESSION_START();
date_default_timezone_set('America/Sao_Paulo');
ob_start();
$autoload = function($class){
    
    if($class == 'Email'){
        require_once('./classes/vendor/autoload.php');
    }
    include('classes/'.$class.'.php');
    //include('./../classes/'.$class.'.php');
};
spl_autoload_register($autoload);

//Variaveis para o painel de controle
define('NOME_EMPRESA','JP CODE');

define('INCLUDE_PATH','http://localhost/criando_site_dinamico/');
define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

define('BASE_DIR_PAINEL',__DIR__.'/painel');

//Conectar com o banco de dados
define('HOST','localhost');
define('USER','root');
define('PASSWORD','');
define('DATABASE','criando_site_dinamico');


?>