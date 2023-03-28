<?php
    $id = (int)$_GET['id'];
    $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id=?");
    $sql->execute(array($id));
    if($sql->rowCount() == 0){
        painel::alert('erro','O Produto que você que editar não existe!','margin-top:80px;');
        die();
    }

    $infoProduto = $sql->fetch();

    $pegarImagens = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id=$id");
    $pegarImagens->execute();
    $pegarImagens = $pegarImagens->fetchAll();
        
?>

<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-box"></i>  Editar Produto: <?php echo $infoProduto['nome']; ?></h2>
    
    <form method="POST" enctype="multipart/form-data">
    <h4 class="w100" ><i class="fa-solid fa-file-lines"></i>  Informações do Produto: <?php echo $infoProduto['nome']; ?></h2>
    <?php
        if(isset($_POST['acao'])){
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $largura = (int)$_POST['largura'];
            $altura = (int)$_POST['altura'];
            $comprimento = (int)$_POST['comprimento'];
            $peso = (int)$_POST['peso'];
            $quantidade = (int)$_POST['quantidade'];
            $imagens = array();
            $amountFiles = count($_FILES['imagem']['name']);
            $sucesso = true;

            if($_FILES['imagem']['name'][0] != ''){
                for($i=0;$i < $amountFiles;$i++){
                    $imagemAtual = ['type'=>$_FILES['imagem']['type'][$i],'size'=>$_FILES['imagem']['size'][$i]];
                    if(Painel::imagemValida($imagemAtual) == false){
                        $sucesso = false;
                        Painel::alert('erro','Uma das imagens selecionadas é INVÀLIDA');
                        break;
                    }
                }    
            }

            if($sucesso){
                if($_FILES['imagem']['name'][0] != ''){
                    for($i=0;$i < $amountFiles;$i++){
                        $imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],'name'=>$_FILES['imagem']['name'][$i]];
                        $imagens[] = Painel::uploadFile($imagemAtual);
                    } 
                    foreach ($imagens as $key => $value){
                        $sql = Mysql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$id,'$value')");
                    }
                }
                $sql = Mysql::Conectar()->prepare("UPDATE `tb_admin.estoque` SET nome=?, descricao=?, largura=?, altura=?, comprimento=?, peso=?, quantidade=? WHERE id=$id");
                $sql->execute(array($nome,$descricao,$largura,$altura,$comprimento,$peso,$quantidade));
                Painel::alert('sucesso','Seu produto foi atualizado com sucesso!','margin-top:-10px;');
                echo '<script>window.history.pushState({}, document.title, "?" + "id='.$id.'");</script>';
            }
    
        }
        $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id=?");
        $sql->execute(array($id));
        $infoProduto = $sql->fetch();
        $pegarImagens = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id=$id");
        $pegarImagens->execute();
        $pegarImagens = $pegarImagens->fetchAll();
            
    ?>

        <div class="form-group">
            <label><i class="fa-solid fa-gifts"></i> Nome do Produto:</label>
            <input type="text" name="nome" value="<?php echo $infoProduto['nome']; ?>"/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-barcode"></i> Descrição do Produto:</label>
            <textarea name="descricao"><?php echo $infoProduto['descricao']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-horizontal"></i> Largura do Produto:</label>
            <input type="number" name="largura" min="0" max="900" step="1" value="<?php echo $infoProduto['largura']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-vertical"></i> Altura do Produto:</label>
            <input type="number" name="altura" min="0" max="900" step="1" value="<?php echo $infoProduto['altura']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-combined"></i> Comprimento do Produto:</label>
            <input type="number" name="comprimento" min="0" max="900" step="1" value="<?php echo $infoProduto['comprimento']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-scale-unbalanced-flip"></i> Peso do Produto:</label>
            <input type="number" name="peso" min="0" max="900" step="1" value="<?php echo $infoProduto['peso']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-arrow-down-wide-short"></i> Quantidade atual do Produto:</label>
            <input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $infoProduto['quantidade']; ?>">
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
                            <a style="display:inline-block;text-decoration:none;margin:8px;" class="btn delete" actionBtn="delete-imagem" item_name="<?php echo $value['imagem']; ?>" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-produto"><i class="fa fa-times"></i> Excluir</a>
                        </div><!--group-btn-->
                    </div><!--body-box-->          
                </div><!--box-single-->
            </div><!--box-single-wraper-->
            
        <?php } ?>

    </div><!--box-content-->

    
</div><!--box-content-->