
<?php include('config.php');?>

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
    <title>Site-dinamico</title>
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
    ?>

    <header>
        <div class="center">
            <div class="logo left"><a href="<?php echo INCLUDE_PATH; ?>contato">JP-CODE</a></div>
            <nav class="desktop right">  
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
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
                $pagina404 = true;
                include('pages/404.php');
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

<?php
if($url == 'contato'){
?>


<?php } ?>


<?php
    if($url == 'home' || $url = ''){
?>

<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
<?php }?>

</body>
</html>