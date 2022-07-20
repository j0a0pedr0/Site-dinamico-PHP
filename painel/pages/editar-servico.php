<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $servico = Painel::select('tb_site.servicos','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-square-pen"></i>  Editar Depoimento</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                if(Painel::update($_POST)){
                    PAINEL::alert('sucesso','O serviço foi editado com sucesso!');
                    $servico = Painel::select('tb_site.servicos','id = ?',array($id));
                }else{
                    PAINEL::alert('erro','Campos vázios não são permitidos!');
                    header("Refresh: 2.5");
                }
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Serviço</label>
            <textarea name="servico" style="height:170px;"><?php echo $servico['servico']; ?></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos" />
            <input type="submit" name="acao" value="Adicionar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->