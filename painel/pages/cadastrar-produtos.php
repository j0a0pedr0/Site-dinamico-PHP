<div class="box-content editarUsuario w100">
    <h2 class="w100"><i class="fa-solid fa-user-pen"></i> Cadastrar Produto</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $descricao = $_POST['descricao'];
                $largura = $_POST['largura'];
                $altura = $_POST['altura'];
                $comprimento = $_POST['comprimento'];
                $peso = $_POST['peso'];
                $quantidade = $_POST['quantidade'];

                $imagens = array();
                $amountFiles = count($_FILES['imagem']['name']);
                $sucesso = true;


                if($_FILES['imagem']['name'][0] != ''){
                    for($i=0;$i < $amountFiles;$i++){
                        $imagemAtual = ['type'=>$_FILES['imagem']['type'][$i],'size'=>$_FILES['imagem']['size'][$i]];
                        if(Painel::imagemValida($imagemAtual) == false){
                            $sucesso = false;
                            Painel::alert('erro','Uma das imagens selecionadas é INVÀLIDA');
                            break;
                        }
                    }    
                }else{
                    $sucesso = false;
                    Painel::alert('erro','Você precisa selecionar pelo menos uma imagem');
                }

                if($sucesso){
                    //TODO: cadastrar informacoes e imagens e realizar upload
                    for($i=0;$i < $amountFiles;$i++){
                        $imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],'name'=>$_FILES['imagem']['name'][$i]];
                        $imagens[] = Painel::uploadFile($imagemAtual);
                    }   

                    $sql = Mysql::Conectar()->prepare("INSERT INTO `tb_admin.estoque` VALUES (null,?,?,?,?,?,?,?)");
                    $sql->execute(array($nome,$descricao,$largura,$altura,$comprimento,$peso,$quantidade));
                    $lastId = MySql::conectar()->lastInsertId();
                    foreach ($imagens as $key => $value){
                        $sql = Mysql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$lastId,'$value')");
                    }

                    Painel::alert('sucesso','Produto cadastrado com sucesso');
                    echo '<script>window.history.pushState({}, document.title, "?" + "");</script>';
                }
            }
        ?>
        <div class="form-group">
            <label><i class="fa-solid fa-gifts"></i> Nome do Produto:</label>
            <input type="text" name="nome" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-barcode"></i> Descrição do Produto:</label>
            <textarea name="descricao"></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-horizontal"></i> Largura do Produto:</label>
            <input type="number" name="largura" min="0" max="900" step="1" value="0">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-vertical"></i> Altura do Produto:</label>
            <input type="number" name="altura" min="0" max="900" step="1" value="0">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-ruler-combined"></i> Comprimento do Produto:</label>
            <input type="number" name="comprimento" min="0" max="900" step="1" value="0">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-scale-unbalanced-flip"></i> Peso do Produto:</label>
            <input type="number" name="peso" min="0" max="900" step="1" value="0">
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-arrow-down-wide-short"></i> Quantidade atual do Produto:</label>
            <input type="number" name="quantidade" min="0" max="900" step="1" value="0">
        </div><!--form-group-->

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-images"></i> Selecione as Imagens:</label>
            <input type="file" name="imagem[]" multiple>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar Produto!"/>
        </div><!--form-group-->
    </form>

</div><!--box-content-->