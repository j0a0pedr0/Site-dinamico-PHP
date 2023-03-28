<?php

    /*
        TODO: Variavel global com os cargos.
    */


    SESSION_START();
    date_default_timezone_set('America/Sao_Paulo');

    $autoload = function($class){
        if($class == 'Email'){
            require_once('classes/vendor/autoload.php');
        }
        include('classes/'.$class.'.php');
    };

   
  

    spl_autoload_register($autoload);

    define('INCLUDE_PATH','http://localhost/criando_site_dinamico_imobiliaria_project/');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

    define('BASE_DIR_PAINEL',__DIR__.'/painel');

    //Conectar com o banco de dados
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','criando_site_dinamico');

    //Variaveis para o painel de controle
    define('NOME_EMPRESA','JP CODE');

    //Função para determinar o cargo
    function pegarCargo($indice){

        return Painel::$cargos[$indice];
    }

    function selecionadoMenu($par){
        $url = explode('/',@$_GET['url'])[0];
        //<i class="fa-solid fa-angle-right"></i>
        if($url == $par){
            echo 'class="menu-active" ';
        }
    }

    function verificarPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return ;
        }else{
            echo 'style="display:none;"';
        }
    }

    function verificarPermissaoPagina($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return ;
        }else{
            include('painel/pages/permissao_negada.php');
            die();
        }
    }

    function recoverPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }