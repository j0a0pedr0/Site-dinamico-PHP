<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $slide = Painel::select('tb_site.slides','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.','top:50px;');
        die();
    }
?>

<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-user-pen"></i>  Editar Usuário</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];

                if($imagem['name'] != ''){
                    //Existe um upload de imagens
                    if(PAINEL::imagemValida($imagem)){
                        PAINEL::deleteFile($imagem_atual);
                        $imagem = PAINEL::uploadFile($imagem);
                        $arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.slides'];
                        Painel::update($arr);
                        Painel::alert('sucesso','Slide editado com sucesso!');
                    }else{
                        Painel::alert('erro','O formato de imagem não é válido');
                    }
                }else{
                    $imagem = $imagem_atual;
                    $arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.slides'];
                    Painel::update($arr);
                    Painel::alert('sucesso','Slide editado com sucesso!');
                }
                
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome:</label>
            <input type="text" name="nome" value="<?php echo $slide['nome'] ?>" required/>
        </div><!--form-group-->


        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem</label>
            <input type="file" name="imagem" />
            <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->