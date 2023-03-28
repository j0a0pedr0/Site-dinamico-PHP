<?php 

    include('config.php');
    include('./classes/Site.php'); 
    include('./classes/MySql.php');
    SITE::updateUsuarioOnline(); 
    SITE::contador(); 

    $homeController = new Controller\homeController;
    $empreendimentoController = new Controller\empreendimentoController;

    Router::get('', function() use ($homeController){
        $homeController->index();
    });
    Router::get('?',function($par) use ($empreendimentoController){
        $empreendimentoController->index($par);
    });
    Router::get('?/?',function($par) use ($empreendimentoController){
        $empreendimentoController->index($par);
    });
    /*
    Router::get('login',function(){
        echo 'login';
    });*/
    



?>