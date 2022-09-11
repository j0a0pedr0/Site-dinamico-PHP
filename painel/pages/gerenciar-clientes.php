<?php
    $query = "";
    if(isset($_POST['acao'])){
        $buscar = $_POST['busca'];
        $query = "WHERE nome LIKE '%$buscar%' OR email LIKE '%$buscar%' OR cpf_cnpj LIKE '%$buscar%'";
    }
    $clientes = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.clientes` $query");
    $clientes->execute();
    $clientes = $clientes->fetchAll();

    $results = count($clientes);
    if($results > 1){
        $plural = 'resultados';
    }else{
        $plural = 'resultado';
    }
?>

<div class="box-content editarUsuario listar-depoimentos w100">

    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-table-list"></i>  Clientes Cadastradas</h2>

    <div class="busca w100">
        <h4 class="h2-mobile w100"><i class="fa fa-search"></i> Realizar busca por cliente específico</h4>
        <form method="post">
            <p>Escolha um parametro!</p>
            <select name="busca_parametro">
                <option value="nome">Nome</option>
                <option value="email">E-mail</option>
                <option value="cpf">CPF</option>
                <option value="cnpj">CNPJ</option>
            </select>
            <input type="text" name="busca" class="search" placeholder="Procure por: Nome, E-mail, CPF ou CNPJ"/>
            <input type="submit" name="acao" value="buscar"/>
        </form>
    </div><!--busca-->

    <div class="busca-results w100">
        <?php
            if(isset($_POST['acao'])){
                echo '<p>Sua busca obteve <b>'.$results.' '.$plural.'</b></p>';
            }
        ?>
    </div>

    <div class="boxes w100">
        
        <?php foreach($clientes as $key => $value){ ?>

        <div class="box-single-wraper w33">
            <div class="w100 box-single">
                <div class="w100 topo-box">
                    <?php if($value['imagem'] == ''){ ?>
                        <h2><i class="fa fa-user"></i></h2>
                    <?php }else{ ?>
                        <div class="img-cliente" style='background-image:url("./uploads/<?php echo $value['imagem']; ?>")'></div>
                    <?php } ?>
                </div><!--topo-box-->
                <div class="body-box">
                    <p><b><i class="fa fa-pencil"></i> Nome:</b> <?php echo $value['nome']; ?></p>
                    <p><b><i class="fa fa-pencil"></i> E-Mail:</b> <?php echo $value['email']; ?></p>
                    <p><b><i class="fa fa-pencil"></i> Tipo:</b> <?php echo ucfirst($value['tipo']); ?></p>
                    <p><b><i class="fa fa-pencil"></i> <?php
                        if($value['tipo'] == 'fisico'){
                            echo 'CPF:';
                        }else{
                            echo 'CNPJ:';
                        }
                    ?></b> <?php echo $value['cpf_cnpj']; ?></p>
                    <div class="group-btn">
                        <a class="btn edit" href="<?php INCLUDE_PATH_PAINEL; ?>editar-cliente?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
                        <a actionBtn="delete-cliente" item_id="<?php echo $value['id']; ?>" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-clientes"><i class="fa fa-times"></i> Excluir</a>
                    </div><!--group-btn-->
                </div><!--body-box-->
            </div><!--box-single-->
        </div><!--box-single-wraper-->
        <?php } ?>
        <div class="clear"></div>
    </div><!--boxes-->


</div><!--box-content-->