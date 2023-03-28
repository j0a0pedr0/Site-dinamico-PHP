<?php
    $id = (int)$_GET['id'];
    $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE id=?");
    $sql->execute(array($id));
    if($sql->rowCount() == 0){
        painel::alert('erro','O Produto que você que editar não existe!','margin-top:80px;');
        die();
    }

    $infoProduto = $sql->fetch();

    $pegarImagens = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.imoveis_imagens` WHERE imovel_id=$id");
    $pegarImagens->execute();
    $pegarImagens = $pegarImagens->fetchAll();
        
?>

<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-box"></i>  Editar Produto: <?php echo $infoProduto['nome']; ?></h2>
    
    <form method="POST" enctype="multipart/form-data">
    <h4 class="w100" ><i class="fa-solid fa-file-lines"></i>  Informações do Produto: <?php echo $infoProduto['nome']; ?></h2>
        <div class="form-group">
            <label><i class="fa-solid fa-gifts"></i> Nome do Produto:</label>
            <input type="text" name="nome" value="<?php echo $infoProduto['nome']; ?>"/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-barcode"></i> Descrição do Produto:</label>
            <textarea name="descricao"><?php echo $infoProduto['preco']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-horizontal"></i> Largura do Produto:</label>
            <input type="number" name="largura" min="0" max="900" step="1" value="<?php echo $infoProduto['area']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-vertical"></i> Altura do Produto:</label>
            <input type="number" name="altura" min="0" max="900" step="1" value="<?php echo $infoProduto['andar']; ?>">
        </div><!--form-group-->

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-images"></i> Selecione as Imagens:</label>
            <input type="file" name="imagem[]" multiple>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar Produto!"/>
        </div><!--form-group-->
    </form>


    <div class="w100 box-content">
        <h4 class="w100" ><i class="fa-solid fa-image"></i>  Imagens do Produto: <?php echo $infoProduto['nome']; ?></h2>
        <?php foreach($pegarImagens as $key => $value){ ?>
            <div class="box-single-wraper w33" style="padding:4px;">

                <div style="border:2px solid #ccc;" class="w100 box-single">
                <div class="img-produto" style="background-image:url('uploads/<?php echo $value['imagem'] ?>');"></div>
                    <div class="body-box">
                        <div class="group-btn" style="text-align: center;">
                            <a style="display:inline-block;text-decoration:none;margin:8px;" class="btn delete" actionBtn="delete-imagem-imovel" item_name="<?php echo $value['imagem']; ?>" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-imovel"><i class="fa fa-times"></i> Excluir</a>
                        </div><!--group-btn-->
                    </div><!--body-box-->          
                </div><!--box-single-->
            </div><!--box-single-wraper-->
            
        <?php } ?>

    </div><!--box-content-->

    
</div><!--box-content-->