<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-envelope-open-text"></i>  Cadastar Depoimento</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                if(Painel::insert($_POST)){
                    PAINEL::alert('sucesso','O cadastro do depoimento foi realizado com sucesso!');
                }else{
                    painel::alert('erro','Campos vazios não são permitidos!');
                }
                
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome da pessoa:</label>
            <input type="text" name="nome" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-envelope-open-text"></i> Depoimento</label>
            <textarea name="depoimento" style="height:170px;"></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-calendar-days"></i> Data</label>
            <input formato="data" type="text" name="data" />
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="order_id">
            <input type="hidden" name="nome_tabela" value="tb_site.depoimentos" />
            <input type="submit" name="acao" value="Cadastrar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->