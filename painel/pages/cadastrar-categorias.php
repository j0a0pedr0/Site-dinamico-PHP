<div class="box-content editarUsuario w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-clapperboard"></i>  Cadastrar Categoria</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                $categoria = $_POST['nome'];

                //verificação de inputs
                if($categoria == ''){
                    Painel::alert('erro','o Nome está vázio',);
                }else{
                    $verificar = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ?");
                    $verificar->execute(array($_POST['nome']));
                    if($verificar->rowCount() == 1){
                        Painel::alert('erro','Ops..Essa categoria já existe');
                    }else{
                        //Apenas cadastrar no banco de dados!
                        $slug = Painel::generateSlug($categoria);
                        $arr = ['nome'=>$categoria,'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'tb_site.categorias'];
                        Painel::insert($arr);
                        PAINEL::alert('sucesso','O Cadastro da categoria foi realizado com sucesso!');
                    }
                }

            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-clapperboard"></i> Nome da Categoria:</label>
            <input type="text" name="nome" />
        </div><!--form-group-->

        
        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.slides">
            <input type="hidden" name="order_id" value="0">
            <input type="submit" name="acao" value="Adicionar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->