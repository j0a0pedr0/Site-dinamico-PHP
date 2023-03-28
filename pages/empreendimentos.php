
<?php
    $empreendimento = (\Views\mainViews::$par);
    $contagemImoveis = count($empreendimento['imoveis']);
?>

<section class="lista-imoveis">
    <div class="center w100">
    <div class="w100 title-list"><h3>Listando <b><?php echo $contagemImoveis; ?> imoveis</b> de <?php echo $empreendimento['nome_empreendimento']; ?></h3></div>

        <?php foreach($empreendimento['imoveis'] as $key => $value){ 
                $imagem = \Mysql::Conectar()->prepare("SELECT imagem FROM `tb_admin.imoveis_imagens` WHERE imovel_id=?");
                $imagem->execute(array($value['id']));
                $imagem = $imagem->fetch();
                
            ?>
            
            <div class="row-imoveis w100">
                <div class="r1">
                    <img class="img-imovel" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $imagem['imagem']; ?>" alt="">
                </div>
                <div class="r2">
                    <p><i class="fa fa-info"></i> Nome dp imovel: <?php echo $value['nome']; ?></p>
                    <p><i class="fa fa-info"></i> Area: <?php echo $value['area']; ?>m²</p>
                    <p><i class="fa fa-info"></i> Andar: <?php echo $value['andar']; ?>º</p>
                    <p><i class="fa fa-info"></i> Preço: R$<?php echo \Painel::convertMoney($value['preco']); ?></p>
                </div><!--R2-->
            </div><!--row-imoveis-->
        <?php } ?>
    </div><!--center-->
</section><!--lista-imoveis-->