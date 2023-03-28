<?php
    $id = $par[1];
    $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE id=?");
    $sql->execute(array($id));

    $infoEmpreend = $sql->fetch();

    if($infoEmpreend['nome'] == ''){
        header('Location: '.INCLUDE_PATH_PAINEL);
        die();
    }

    
?>
<?php Painel::loadJS(array('jquery.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('jquery-migrate-1.4.1.min.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('jquery-migrate-3.3.2.min.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('jquery.form.min.js.map'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('ajax.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('jquery.form.min.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('jquery.mask.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('financeiroCliente.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('maskMoney.js'),'visualizar-empreendimento'); ?>
<?php Painel::loadJS(array('helperMask.js'),'visualizar-empreendimento'); ?>
<script src="<?php echo INCLUDE_PATH ?>js/constants.js"></script>

<div class="box-content editarUsuario listar-depoimentos w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-building-ngo"></i> Empreendimento: <?php echo $infoEmpreend['nome']; ?></h2>
    <div class="info-item">
        <div class="row1">
            <h3 class="w100 h2-mobile" style="background-color:lightblue;"><i class="fa-solid fa-building-ngo" style="background-color:lightblue;"></i> Imagem do Empreendimento: </h3>
            <br>
            <div class="img-produto-empreendimento" style="background-image:url('../uploads/<?php echo $infoEmpreend['imagem']; ?>');"></div>
        </div><!--row1-->
        <div class="row2">
            <h3 class="w100 h2-mobile" style="background-color:lightblue;"><i class="fa-solid fa-building-ngo" style="background-color:lightblue;"></i> Informações do Empreendimento: </h3>
            <br>
            <p><b><i class="fa fa-pencil"></i> Nome do Empreendimento:</b> <?php echo $infoEmpreend['nome']; ?> </p>
            <p><b><i class="fa fa-pencil"></i> Tipo:</b> <?php echo $infoEmpreend['tipo']; ?> </p>
        </div><!--row2-->
    </div><!--info-item-->


    <h3 class="w100 h2-mobile" style="background-color:lightblue;"><i class="fa-solid fa-plus"></i> Cadastrar mais Imóveis: </h3>
    <form method="POST" enctype="multipart/form-data">
        
    <?php
            if(isset($_POST['adicionar_imovel'])){
                $idEmprend = $id;
                $nome = $_POST['nome'];
                $andar = $_POST['andar'];
                $area = $_POST['area'];

                $preco = Painel::formatarMoeda($_POST['valor']);

                

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
                    
                    for($i=0;$i < $amountFiles;$i++){
                        $imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],'name'=>$_FILES['imagem']['name'][$i]];
                        $imagens[] = Painel::uploadFile($imagemAtual);
                    }   

                    $sql = Mysql::Conectar()->prepare("INSERT INTO `tb_admin.imoveis` VALUES (null,?,?,?,?,?)");
                    $sql->execute(array($idEmprend,$nome,$preco,$area,$andar));
                    $lastId = MySql::conectar()->lastInsertId();
                    foreach ($imagens as $key => $value){
                        $sql = Mysql::conectar()->exec("INSERT INTO `tb_admin.imoveis_imagens` VALUES (null,$lastId,'$value')");
                    }

                    Painel::alert('sucesso','Imóvel cadastrado com sucesso');
                    echo '<script>window.history.pushState({}, document.title, "?" + "");</script>';
                }
            }
        ?>
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome">
        </div><!--form-group-->

        <div class="form-group">
            <label>Preco</label>
            <input type="text" name="valor">
        </div><!--form-group-->

        <div class="form-group">
            <label>Andar</label>
            <input type="number" name="andar">
        </div><!--form-group-->

        <div class="form-group">
            <label>Área em m²</label>
            <input id="area" type="number" name="area">
        </div><!--form-group-->

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem</label>
            <input type="file" name="imagem[]" multiple/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="adicionar_imovel" value="Cadastrar"/>
        </div><!--form-group-->


    </form>


    <h3 class="w100 h2-mobile" style="background-color:lightblue;"><i class="fa-solid fa-building-ngo" style="background-color:lightblue;"></i> Imóveis do Empreendimento: </h3>
    <div  class="w100 wraper">
        <table>
            <tr>
                <td><i class="fa-solid fa-user"></i> Nome</td>
                <td><i class="fa-solid fa-calendar-days"></i> Preço</td>
                <td>Area</td>
                <td>Andar</td>
                <td>Detalhes</td>
                <td>Excluir</td>
            </tr>

            <?php
                $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE empreend_id=?");
                $sql->execute(array($id));
                $empreendImoveis = $sql->fetchAll();
                foreach($empreendImoveis as $key => $value){ 
                    $value['preco'] = Painel::convertMoney($value['preco']);

                    /*  JEITO AMADOR DE FORMATAR CAMPOS DE PRECOS!!
                    preg_replace('/(.*?)\.(.*?)$/','$1,$2',$value['preco']);
                    $contagemCaracter = strlen($value['preco']);
                    if($contagemCaracter == 10){
                        $value['preco'] = substr_replace($value['preco'],'.',1,0);
                        $value['preco'] = substr_replace($value['preco'],'.',5,0);
                    }else if($contagemCaracter == 9){
                        $value['preco'] = substr_replace($value['preco'],'.',3,0);
                    }else if($contagemCaracter == 8){
                        $value['preco'] = substr_replace($value['preco'],'.',2,0);
                    }else if($contagemCaracter == 7){
                        $value['preco'] = substr_replace($value['preco'],'.',1,0);
                    }*/
                
            ?>

            <tr>
                <td><?php echo $value['nome'] ?></td>
                <td>R$<?php echo $value['preco'] ?></td>
                <td><?php echo $value['area'] ?>m²</td>
                <td><?php echo $value['andar'] ?>º</td>
                <td><a class="btn normal" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-imovel?id=<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Visualizar</a></td>
                <td><a style="display:inline-block;text-decoration:none;margin:8px;" class="btn delete" actionBtn="delete-imovel" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-empreendimento"><i class="fa fa-times"></i> Excluir</a></td>
            </tr>
            <?php } ?>
        </table>
    </div><!--wraper-->

</div><!--box-content-->