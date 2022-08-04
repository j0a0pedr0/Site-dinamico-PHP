<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $noticias = Painel::select('tb_site.noticias','id = ?',array($id));
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
                $categoria_id = $_POST['categoria_id'];
                $titulo = $_POST['titulo'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $noticias['capa'];
                $conteudo = $_POST['conteudo'];
                $portfolio = @$_POST['portfolio'];
                
                $verificar = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo = ? AND id != ?");
                $verificar->execute(array($titulo,$id));
                if($verificar->rowCount() == 0){
                    if($imagem['name'] != ''){
                        //Existe um upload de imagens
                        if(PAINEL::imagemValida($imagem)){
                            PAINEL::deleteFile($imagem_atual);
                            $imagem = PAINEL::uploadFile($imagem);
                            $slug = Painel::generateSlug($titulo);
                            $arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'portfolio'=>$portfolio,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
                            Painel::update($arr);
                            $noticias = Painel::select('tb_site.noticias','id = ?',array($id));
                            Painel::alert('sucesso','A notícia foi editada com sucesso!');
                        }else{
                            Painel::alert('erro','O formato de imagem não é válido');
                        }
                    }else{
                        $slug = Painel::generateSlug($titulo);
                        $arr = ['categoria_id'=>$categoria_id,'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem_atual,'slug'=>$slug,'portfolio'=>$portfolio,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
                        Painel::update($arr);
                        $noticias = Painel::select('tb_site.noticias','id = ?',array($id));
                        Painel::alert('sucesso','A noticia foi editada com sucesso!');
                    }
                }else{
                    Painel::alert('erro','Já existe uma noticia com este nome!');
                }
                
            }
        ?>
        
        <div class="form-group">
        <label><i class="fa-solid fa-clapperboard"></i> Escolha uma Categoria:</label>
            <select name="categoria_id">
                <option value="">Categorias ...</option>
                <?php
                    $categorias = Painel::selectAll('tb_site.categorias');
                    foreach($categorias as $key => $value){
                ?>    
                    <option <?php if($value['id'] == $noticias['categoria_id']) echo 'selected' ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
                <?php } ?>

            </select>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Título:</label>
            <input type="text" name="titulo" value="<?php echo $noticias['titulo'] ?>" required/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Portfolio:</label>
            <input type="text" name="portfolio" value="<?php echo $noticias['portfolio'] ?>" required/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Conteúdo:</label>
            <textarea class="tinymce" name="conteudo"><?php echo $noticias['conteudo']; ?></textarea>
        </div><!--form-group-->

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem de Capa</label>
            <input type="file" name="imagem" />
            <input type="hidden" name="imagem_atual" value="<?php echo $noticias['capa'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->