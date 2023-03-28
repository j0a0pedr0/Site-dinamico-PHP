<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.min.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>fontawesome-free-6.1.1-web/css/all.css">
    <title>Portal de Imobiliário</title>
</head>
<body>
    <base base="<?php echo INCLUDE_PATH; ?>"></base>

    <header>
        <div class="center">
            <div class="logo"><a href="<?php echo INCLUDE_PATH; ?>">Portal Imobiliário</a></div>
            <nav class="desktop">
                <ul>
                    <?php
                        $empreendimento = (\Views\mainViews::$par);


                        $selectEmpreend = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` ORDER BY order_id ASC");
                        $selectEmpreend->execute();
                        $empreendimentos = $selectEmpreend->fetchAll();
                        foreach($empreendimentos as $key => $value){
                    ?>
                    <li><a href="<?php echo INCLUDE_PATH.$value['slug']; ?>"><?php echo $value['nome']; ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div><!--center-->
    </header>

    <section class="search1">
        <div class="center">
            <div class="w100"><h2>O que você procura?</h2></div>
            <div class="form-group w100">
                <input type="text" name="texto-busca"/>
            </div><!--form-group-->
        </div><!--center-->
    </section><!--search1-->

    <section class="search2">
        <div class="center">
            <form method="POST" action="<?php echo INCLUDE_PATH; ?>ajax/formularios.php">
                <div class="center">
                    <div class="form-group">
                        <label><i class="fa-solid fa-maximize"></i> Area Minima m²: </label>
                        <input type="number" name="area_minima" min="0" max="1000000" step="100">
                    </div><!--form-group-->
                    <div class="form-group">
                        <label><i class="fa-solid fa-maximize"></i> Area Maxima m²: </label>
                        <input type="number" name="area_maxima" min="0" max="1000000" step="100">
                    </div><!--form-group-->
                    <div class="form-group">
                        <label><i class="fa-solid fa-arrow-down-wide-short"></i> Preço Minimo: </label>
                        <input type="text" name="preco_minimo">
                    </div><!--form-group-->
                    <div class="form-group">
                        <label><i class="fa-solid fa-arrow-up-wide-short"></i> Preço Maximo: </label>
                        <input type="text" name="preco_maximo">
                        <?php 
                        if(isset($empreendimento['slug'])){
                            echo '<input name="slug_empreendimento" type="hidden" value="'.$empreendimento['slug'].'" />';
                        }
                    ?>
                    </div><!--form-group-->
                </div><!--center-->
            </form>
        </div><!--center-->
    </section><!--search2-->
