<div class="box-content editarUsuario w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-clapperboard"></i>  Cadastrar Slides</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];
            

                //verificação de inputs
                if($nome == ''){
                    Painel::alert('erro','o Nome está vázio',);
                }else if($imagem['name'] == '' ){
                    Painel::alert('erro','A imagem precisa estar selecionada');
                }else if(PAINEL::imagemValida($imagem) == false){
                    Painel::alert('erro','O formato de imagem não é suportado!111');
                }else{
                    //Apenas cadastrar no banco de dados!
                    $imagem = PAINEL::uploadFile($imagem);
                    $arr = ['nome'=>$nome,'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'tb_site.slides'];
                    Painel::insert($arr);
                    PAINEL::alert('sucesso','O Cadastro do slide foi realizado com sucesso!');
                }


            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-clapperboard"></i> Nome do Slide:</label>
            <input type="text" name="nome" />
        </div><!--form-group-->


        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem</label>
            <input type="file" name="imagem"/>
        </div><!--form-group-->



        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.slides">
            <input type="hidden" name="order_id" value="0">
            <input type="submit" name="acao" value="Adicionar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->