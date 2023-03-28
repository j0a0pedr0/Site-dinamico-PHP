
<div class="box-content editarUsuario listar-depoimentos w100">

    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-table-list"></i>  Cadastrar Empreendimento</h2>

    <form method="POST" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $tipo = $_POST['tipo'];
                $imagem = $_FILES['imagem'];
               
                if($nome === '' || $tipo == '' || $imagem == ''){
                    Painel::alert('erro','Não permitimos campos vazíos nessa ação!');
                    die();
                }

                if(Painel::imagemValida($imagem) != true){
                    Painel::alert('erro','A Imagem Escolhida é inválida!--Apenas Tipo: JPG--JPEG--PNJ');
                    die();
                }else{
                    //Imagem Válida e podemos cadastrar no banco de dados
                    $idImagem = Painel::uploadFile($imagem);
                    $slug = Painel::generateSlug($nome);
                    $sql = Mysql::Conectar()->prepare("INSERT INTO `tb_admin.empreendimentos` VALUES (null,?,?,?,?,?)");
                    $sql->execute(array($nome,$tipo,$idImagem,$slug,0));
                    $lastId = mysql::conectar()->lastInsertId();
                    Mysql::Conectar()->exec("UPDATE `tb_admin.empreendimentos` SET order_id = $lastId WHERE id = $lastId");
                    
                    Painel::alert('sucesso','O Empreendimento foi cadastrado com sucesso!');
                }
                
            }
        ?>

        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome"/>
        </div><!--form-group-->

        <div class="form-group">
            <label>Tipo:</label>
            <select name="tipo">
                <option value="residecial">Residencial</option>
                <option value="comercial">Comercial</option>
            </select>
        </div><!--form-group-->


        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label>Imagem do Imóvel:</label>
            <input type="file" name="imagem" required/>
        </div><!--form-group-->
        
        <div class="form-group">
            <input type="submit" name="acao" value="cadastrar"/>
        </div><!--form-group-->
    </form>

</div><!--box-content-->