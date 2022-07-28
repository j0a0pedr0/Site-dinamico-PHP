<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $categoria = Painel::select('tb_site.categorias','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-square-pen"></i>  Editar Categorias</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                $slug = Painel::generateSlug($_POST['nome']);
                $arr = array_merge($_POST,array('slug'=>$slug));
                $verificar = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ? AND id != ?");
                $verificar->execute(array($_POST['nome'],$id));

                if($verificar->rowcount() == 1){
                    Painel::alert('erro','Ops...já existe essa categoria.');
                }else{
                    if(Painel::update($arr)){
                        PAINEL::alert('sucesso','A categoria foi editada com sucesso!');
                        $categoria = Painel::select('tb_site.categorias','id = ?',array($id));
                    }else{
                        PAINEL::alert('erro','Campos vázios não são permitidos!');
                        header("Refresh: 2.5");
                    }
                }
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Categoria</label>
            <input type="text" name="nome" value="<?php echo $categoria['nome']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.categorias" />
            <input type="submit" name="acao" value="Adicionar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->