<section class="banner-container">
    <?php $slide = Painel::selectAll('tb_site.slides'); ?>
    <?php $adm = Painel::select('tb_site.config'); ?>
    <?php foreach($slide as $key =>$value){

        ?>
        <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $value['slide']; ?>');" class="banner-single"></div><!--BANNER_SINGLE-->
    <?php }?>
        <div class="overlay"></div>
        <div class="center">

            <form class="ajax-form" method="post">
                <h2>Qual o seu melhor e-mail?</h2>
                <input type="email" name="email" required />
                <input type="hidden" name="identificador" value="form_homsde"/>
                <input type="submit" value="Enviar" name="acao"/>
            </form>

            <div class="bullets">
            </div><!--BULLETS-->

        </div><!--center-->
    </section><!--BANNER_PRINCIPAL-->

    <section class="descricao-autor" id="descricao_autor">
        <div class="center">
            <div class="w100">
            <img  src="./painel/uploads/<?php echo $adm['img'] ?>"/><h2><?php echo $infoSite['nome_autor']; ?></h2><br><p class="criador">Criador Ceo</p>   
            </div><!--W50-->

            <div class="w100 descricao-autor-box">
                <p><?php echo $infoSite['descricao']; ?></p>
            </div><!--W50-->
            <div class="clear"></div>
        </div><!--center-->
    </section><!--Descricao-autor-->

    <section class="especialidades">
        <div class="center">
        <h2 class="title">Especialidades</h2>
            <div class=" w33 left box-especialidades">
                <h3><i class="<?php echo $infoSite['icone1']; ?>"></i></h3>
                <h3>CSS3</h3>
                <p><?php echo $infoSite['descricao1']; ?></p>
            </div><!--especialidades-->

            <div class="w33 left box-especialidades">
                <h3><i class="<?php echo $infoSite['icone2']; ?>"></i></h3>
                <h3>HTML5</h3>
                <p><?php echo $infoSite['descricao2']; ?></p>
            </div><!--especialidades-->

            <div class="w33 left box-especialidades">
                <h3><i class="<?php echo $infoSite['icone3']; ?>"></i></h3>
                <h3>JAVASCRIPT</h3>
                <p><?php echo $infoSite['descricao3']; ?></p>
            </div><!--especialidades-->
            <div class="clear"></div>
        </div><!--CENTER-->
    </section><!--especialiadades-->

    <section class="extras">
        <div class="center">
            <div id="sobre" class="w50 depoimentos-container left">
                <h3>Depoimentos dos nossos clientes</h3>
                <?php   
                    $sql = mysql::Conectar()->prepare("SELECT * FROM  `tb_site.depoimentos` ORDER BY order_id ASC LIMIT 3");
                    $sql->execute();
                    $depoimentos = $sql->fetchAll();
                    foreach ($depoimentos as $key => $value){

                ?>

                    <div class="depoimento-single">
                        <p class="depoimento-descricao"><?php echo $value['depoimento']; ?></p>
                        <p class="nome-autor"><?php echo $value['nome'] ?> <?php echo $value['data'] ?></p>
                    </div><!--depoimento-single-->
                <?php } ?>
            </div><!--w50-->

            <div id="servicos" class="w50 servicos-container left">
                <h3>Serviços</h3>
                <div class="servicos">

                    <ul>
                        <?php 
                            $sql = mysql::Conectar()->prepare("SELECT * FROM  `tb_site.servicos` ORDER BY order_id ASC LIMIT 3");
                            $sql->execute();
                            $servicos = $sql->fetchAll();
                            foreach ($servicos as $key => $value){
                        ?>
                        
                        <li><?php echo $value['servico'] ?></li>

                        <?php } ?>
                    </ul>
                </div><!--servicos-->
            </div><!--w50-->
            <div class="clear"></div>
        </div><!--center-->
    </section><!--Extras-->