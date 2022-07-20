<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $depoimento = Painel::select('tb_site.depoimentos','id = ?',array($id));
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
                    PAINEL::alert('sucesso','O depoimento foi editado com sucesso!');
                    $depoimento = Painel::select('tb_site.depoimentos','id = ?',array($id));
                }else{
                    PAINEL::alert('erro','Campos vázios não são permitidos!');
                    header("Refresh: 2.5");
                }
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome da pessoa:</label>
            <input type="text" name="nome" value="<?php echo $depoimento['nome']; ?>"/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Depoimento</label>
            <textarea name="depoimento" style="height:170px;"><?php echo $depoimento['depoimento']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-calendar-days"></i> Data</label>
            <input formato="data" type="text" name="data" value="<?php echo $depoimento['data']; ?>"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $depoimento['id']; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.depoimentos" />
            <input type="submit" name="acao" value="Adicionar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->