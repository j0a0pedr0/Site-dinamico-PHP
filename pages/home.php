<?php $adm = Painel::select('tb_site.config'); ?>
<?php $slides = Painel::selectAll('tb_site.slides'); ?>
<section class="banner-container">
    <div class="body">   
        <div class="nome-autor">
            
            <div class="base">
                <div class="base-top"></div>
                <div class="corda">
                <?php for($i = 2;$i <= 28;$i++){
                        echo "<span style='--i:$i;'></span>";
                    } ?>
                </div>
            </div>
            <div class="base">
            <div class="base-top"></div>
                <div class="corda">
                    <?php for($i = 0;$i <= 28;$i++){
                        echo '<span></span>';
                    } ?>
                </div>
            </div>
            <div>
                <div class="nome">
                <h2>João-Pedro </h2>
                <h2>João-Pedro </h2>
                </div>

                <div class="sobrenome"><h4>Barreto-Pereira-Alves</h4><span></span><h3>Desenvolvedor-Jr</h3></div>
            </div>
            

        </div><!--nome-autor-->

        <div class="cube">
            <div class="loops">
                <div class="top"></div>
                <span class="quadrado" style="--i:0;background-image: url('./painel/uploads/<?php echo $slides[2][2]; ?>');background-size:100% 100%;background-position:center;"></span>
                <span class="retangulo" style="--i:1;">
                    <h2>JP</h2>
                    <h2>JP</h2>
                    <p>code</p>
                    <p class="zz">code</p>
                </span>
                <span class="quadrado" style="--i:2;background-image: url('./painel/uploads/<?php echo $slides[1][2]; ?>');background-size:100% 100%;background-position:center;"></span>
                <span class="retangulo2" style="--i:3;">
                    <h2>JP</h2>
                    <h2>JP</h2>
                    <p>code</p>
                    <p class="zz">code</p>
                </span>
            </div>
            <div class="bottom"></div>
        </div><!--cube-->
    </div><!--body-->
</section><!--BANNER_PRINCIPAL-->

<section class="descricao-autor" id="descricao_autor">
    <div class="center">
        <div class="w100">
        <img  src="./painel/uploads/<?php echo $adm['img'] ?>"/><h2><?php echo $infoSite['nome_autor']; ?></h2><br><p class="criador">Desenvolvedor Jr</p>   
        </div><!--W50-->

        <div class="w100 descricao-autor-box">
            <p><?php echo $infoSite['descricao']; ?></p>
        </div><!--W50-->
        <div class="clear"></div>
    </div><!--center-->
</section><!--Descricao-autor-->

<section class="habilidades" id="habilidades">
    <div class="center">
    <h3 style="text-align:center;">Habilidades</h3>
        <div  class="w50 servicos-container left">
            <div class="servicos" style="text-align:center;">

                <ul style="text-align:left;">
                    <?php 
                        $sql = mysql::Conectar()->prepare("SELECT * FROM  `tb_site.servicos` ORDER BY order_id ASC LIMIT 5");
                        $sql->execute();
                        $servicos = $sql->fetchAll();
                        foreach ($servicos as $key => $value){
                    ?>
                    
                    <li><?php echo $value['servico'] ?></li>

                    <?php } ?>
                </ul>
            </div><!--servicos-->
        </div><!--w50-->

        <div  class="w50 servicos-container left">
            <div class="servicos" style="text-align:center;">

                <ul style="text-align:left;">
                    <?php 
                        $sql = mysql::Conectar()->prepare("SELECT * FROM  `tb_site.servicos` ORDER BY order_id DESC LIMIT 5");
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
</section><!--habilidades-->

<section class="especialidades">
    <div class="center">
        <h2 class="title">Cursos</h2>
        <div class="w100 left box-especialidades">
            <div class="w50 left" style="--i:0;background-image: url('./painel/uploads/<?php echo $slides[0][2]; ?>');background-size:100% 100%;background-position:center;height:340px;border-radius:16px;"></div>
            <div style="padding:24px 2% 40px 2%;" class="w50 left">
                <h3><i class="<?php echo $infoSite['icone1']; ?>"></i>Duração: 6h</h3>
                <p><?php echo $infoSite['descricao1']; ?></p>
                <div class="especialidades-status">
                    <h3 class="status">Status: <i style="color:green;" class="fa-solid fa-circle-check"></i>100% <a href="https://cursos.dankicode.com/certificados?view=10044">Certificado</a></h3>
                </div>
            </div>
        </div><!--especialidades-->

        <div class="w100 left box-especialidades">
            <div class="w50 left" style="--i:0;background-image: url('./painel/uploads/<?php echo $slides[3][2]; ?>');background-size:100% 100%;background-position:center;height:340px;border-radius:16px;"></div>
            <div style="padding:24px 2% 40px 2%;" class="w50 left">
                <h3><i class="<?php echo $infoSite['icone1']; ?>"></i>Duração: 81h</h3>
                <p><?php echo $infoSite['descricao2']; ?></p>

                <div class="especialidades-status">
                    <h3 class="status">Status: <i style="color:green;" class="fa-solid fa-circle-check"></i>100% <a href="https://cursos.dankicode.com/certificados?view=10044">Certificado</a></h3>
                </div>
            </div>
        </div><!--especialidades-->

        <div class="w100 left box-especialidades">
            <div class="w50 left" style="--i:0;background-image: url('./painel/uploads/<?php echo $slides[4][2]; ?>');background-size:100% 100%;background-position:center;height:340px;border-radius:16px;"></div>
            <div style="padding:24px 2% 40px 2%;" class="w50 left">
                <h3><i class="<?php echo $infoSite['icone1']; ?>"></i>Duração: ?h</h3>
                <p><?php echo $infoSite['descricao3']; ?></p>
                <div class="especialidades-status">
                    <h3 class="status">Status: 33% <i style="color:yellow;" class="fa-solid fa-spinner"></i><span style="color:yellow;">Em progresso</span> <a style="cursor:default;background:gray;">Certificado</a></h3>
                </div>
            </div>
        </div><!--especialidades-->
        <div class="clear"></div>
    </div><!--CENTER-->
</section><!--especialiadades-->
