<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-brands fa-black-tie"></i>  Adicionar Serviço</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                if(Painel::insert($_POST)){
                    PAINEL::alert('sucesso','O serviço foi adicionado com sucesso!');
                }else{
                    painel::alert('erro','Campos vazios não são permitidos!');
                }
                
            }
        ?>

        <div class="form-group">
            <label><i class="fa-brands fa-black-tie"></i> Descreava o serviço:</label>
            <textarea name="depoimento" style="height:170px;"></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="order_id">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos" />
            <input type="submit" name="acao" value="Cadastrar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->