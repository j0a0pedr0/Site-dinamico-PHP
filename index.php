
<?php include('config.php');?>
<?php include('./classes/Site.php'); ?>
<?php include('./classes/MySql.php') ?>
<?php SITE::updateUsuarioOnline(); ?>
<?php SITE::contador(); ?>
<?php 
    $infoSite = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.config`");
    $infoSite->execute();
    $infoSite = $infoSite->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="palavras chave do meu site">
    <meta name="description" content="descrição do meu site">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>js/funcoes-mobile/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
    <meta>
    <title><?php echo $infoSite['titulo']; ?></title>
</head>
<body>
    <base base="<?php echo INCLUDE_PATH ?>"/>
    <?php        
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        switch ($url) {
            case 'sobre':
                echo '<target target="sobre" />';
                break;
            
            case'servicos':
                echo '<target target="servicos" />';
                break;
        }
        $descricao_autor = isset($_GET['descricao_autor']);
        if($descricao_autor != ''){
            echo '<target target="descricao_autor" />';
        }
    ?>

    <?php error_reporting(E_ALL);
ini_set('display_errors', 'On') ?>

    <div class="erro">Erro ao enviar o Formulário</div>
    <div class="sucesso">Formulário enviado com sucesso!</div>
    <div class="overlay-loading">
        <img src="<?php echo INCLUDE_PATH; ?>image/ajax-loader2.gif">
    </div>
  

    <header>
        <div class="center">
            <div class="logo left"><a href="<?php echo INCLUDE_PATH; ?>">JP-CODE</a></div>
            <nav class="desktop right">  
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
                    <li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                </ul>
            </nav><!--DESKTOP-->

            <nav class="mobile right">  
                <div onclick="Menu_click()"  id="icone" class="botao-mobile"><i class="fa-solid fa-bars-staggered"></i></div>
                <div id="mobile-menu" class="mobile-menu hide">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
                    <li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                </ul>
                </div><!--mobile-menu-->
            </nav><!--MOBILE-->
            <div class="clear"></div>
        </div><!--center-->
    </header>

    <div class="container-principal">
        <?php

            if(file_exists('pages/'.$url.'.php')){
                include('pages/'.$url.'.php');
            }else{
                if($url != 'sobre' && $url != 'servicos'){
                    $urlPar = explode('/',$url);
                    if($urlPar[0] != 'noticias'){
                        $pagina404 = true;
                        include('pages/404.php');
                       
                    }else{
                        include('pages/noticias.php');
                    }
                }else{
                    include('pages/home.php');   
                }
            }

        ?>
    </div><!--container-principal-->

    <footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed";' ?>>
        <div class="center">
            <p>Todos os direitos reservados</p>
        </div><!--center-->
    </footer>

<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/jquery-migrate-1.4.1.min.js" type="text/javascript"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/jquery-migrate-3.3.2.min.js" type="text/javascript"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/funcoes-mobile/Menu-mobile.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
<script src="<?php echo INCLUDE_PATH; ?>js/Map.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>

<?php
    if(is_array($url) && strstr($url[0],'noticias') !== false){
        
?>
    <script>
        $(function(){
            $('select').change(function(){
                location.href=include_path+"noticias/"+$(this).val();
            });
        });
    </script>
<?php } ?>


<?php
if($url == 'contato'){
?>


<?php } ?>


<?php
    if($url == 'home' || $url = ''){
?>


<?php }?>


</body>
</html>