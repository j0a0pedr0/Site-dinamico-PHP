<div class="box-content editarUsuario w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-clapperboard"></i>  Cadastrar Notícia</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                $categoria_id = $_POST['categoria_id'];
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $capa = $_FILES['capa'];
                $portfolio = $_POST['portfolio'];
            
                if($titulo == '' || $conteudo == ''){
                    Painel::alert('erro','Campos Vázios não são permitidos!');
                }else if($capa['tmp_name'] == ''){
                    Painel::alert('erro','A imagem de capa precisa ser selecionada');
                }else{
                    $verificar = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo=?");
                    $verificar->execute(array($titulo));
                    if($verificar->rowcount() == 0){
                        if(Painel::imagemValida($capa)){
                            $imagem = Painel::uploadFile($capa);
                            $slug = Painel::generateSlug($titulo);
                            $arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'portfolio'=>$portfolio,'order_id'=>0,'nome_tabela'=>'tb_site.noticias'];
                            if(Painel::insert($arr))
                            Painel::alert('sucesso','Notícia cadastrada com sucesso');
                        }else{
                            Painel::alert('erro','Selecione uma Imagem Válida.--tipo: jpeg--jpg--png');
                        }
                    }else{
                        Painel::alert('erro','Título da notícia já existe! --  '.$titulo.'  --');
                    }       
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
                    <option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected' ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
                <?php } ?>

            </select>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-clapperboard"></i> Título</label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>"/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-clapperboard"></i> portfolio</label>
            <input type="text" name="portfolio" value="<?php recoverPost('portfolio'); ?>"/>
        </div><!--form-group-->


        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem de Capa</label>
            <input type="file" name="capa"/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-brands fa-black-tie"></i> Descreava a Notícia:</label>
            <textarea class="tinymce" name="conteudo" style="height:170px;"><?php recoverPost('conteudo'); ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.noticias">
            <input type="hidden" name="order_id" value="0">
            <input type="submit" name="acao" value="Adicionar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->