<?php 
    $site = Painel::select('tb_site.config',false);
?>

<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-square-pen"></i>  Editar Configurações do Site</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                $imagem_atual = $_POST['imagem_atual'];
                $imagem = $_FILES['img'];
                
                //Enviei o meu formulário
                if($imagem['name'] !=''){
                    if(PAINEL::imagemValida($imagem)){
                        PAINEL::deleteFile($imagem_atual);
                        $_POST['img']= PAINEL::uploadFile($imagem);
                        Painel::update($_POST,true);
                        Painel::alert('sucesso','Site editado com sucesso!');
                        $site = Painel::select('tb_site.config',false);
                    }else{
                        Painel::alert('erro','O formato de imagem não é válido');
                    }
                }else{
                   $imagem = $imagem_atual;
                    if(Painel::update($_POST,true)){

                        PAINEL::alert('sucesso','O site foi editado com sucesso!');
                        $site = Painel::select('tb_site.config',false);
                    }else{
                        PAINEL::alert('erro','Campos vázios não são permitidos!');
                        header("Refresh: 2.5");
                    }
                }
            }
        ?>
        
        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Titulo do site:</label>
           <input type="text" name="titulo" value="<?php echo $site['titulo']; ?>" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Nome Autor:</label>
           <input type="text" name="nome_autor" value="<?php echo $site['nome_autor']; ?>" />
        </div><!--form-group-->
        <div style="border:1px solid #0277bd;padding:7px"  class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Imagem Autor:</label>
           <input style="width:calc(100% - 75px);" type="file" name="img"/><img  style="display:inline-block;width:55px;height:55px;" src="./uploads/<?php echo $site['img']; ?>">
           <p style="position:relative;left:86%;top:-9px;color:#094283;">atual</p>
           <input type="hidden" name="imagem_atual" value="<?php echo $site['img']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Descrição do Autor:</label>
            <textarea name="descricao" style="height:170px;"><?php echo $site['descricao']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Icone-1:</label>
           <input type="text" name="icone1" value="<?php echo $site['icone1']; ?>" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Descrição do Icone-1:</label>
            <textarea name="descricao1" style="height:170px;"><?php echo $site['descricao1']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Icone-2:</label>
           <input type="text" name="icone2" value="<?php echo $site['icone2']; ?>" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Descrição do Icone-2:</label>
            <textarea name="descricao2" style="height:170px;"><?php echo $site['descricao2']; ?></textarea>
        </div><!--form-group-->


        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Icone-3:</label>
           <input type="text" name="icone3" value="<?php echo $site['icone3']; ?>" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Descrição do Icone-3:</label>
            <textarea name="descricao3" style="height:170px;"><?php echo $site['descricao3']; ?></textarea>
        </div><!--form-group-->


        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.config" />
            <input type="submit" name="acao" value="Atualizar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->