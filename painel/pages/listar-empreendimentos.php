<?php
        ob_start();
?>


<div class="box-content editarUsuario listar-depoimentos w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-table-list"></i> Estoque de Produtos</h2>

    <div class="busca w100">
        <h4 class="h2-mobile w100"><i class="fa fa-search"></i> Realizar busca por Produtos</h4>
        <form method="post">
            <input type="text" name="busca" class="search" placeholder="Procure pelo o nome do produto"/>
            <input type="submit" name="acao_pesquisa" value="buscar"/>
        </form>
    </div><!--busca-->

    <?php 

        if(isset($_GET['deletar'])){

        }

        $query = "";
        if(isset($_POST['acao_pesquisa'])){
            $pesquisa = $_POST['busca'];
            $query = "WHERE nome LIKE '%$pesquisa%' OR tipo LIKE '%$pesquisa%'";
        }

        $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` $query ORDER BY order_id ASC");
        $sql->execute();
        $produtos = $sql->fetchAll();
        $results = count($produtos);
        if($results > 1){
            $plural = 'resultados';
        }else{
            $plural = 'resultado';
        }
        if(isset($_POST['acao_pesquisa'])){
            echo '<p>Sua busca obteve <b>'.$results.' '.$plural.'</b></p>';
        }
    ?>

    
    <div class="boxes w100" style="overflow-x:hidden;overflow-y:hidden;">
        
        <?php
            foreach($produtos as $key => $value){
        ?>
        

        <div id='item-<?php echo $value['id']; ?>' class="box-single-wraper empreendimentos w50">

            <div class="w40 box-single" style="padding:0!important;">
                <div><div class="img-produto-empreendimento" style="background-image:url('uploads/<?php echo $value['imagem'] ?>');"></div></div>
            </div>
            <div class="w60 box-single">
                <div class="body-box">
                    <p><b><i class="fa fa-pencil"></i> Nome do produto:</b> <?php echo $value['nome']; ?> </p>
                    <p><b><i class="fa fa-pencil"></i> Descricao:</b> <?php echo ucfirst($value['tipo']); ?> </p>                 
                    <div class="group-btn">
                        <a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-empreendimento?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
                        <a class="btn delete" actionBtn="delete-empreendimento" item_img="<?php echo $value['imagem'] ?>" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-empreendimentos"><i class="fa fa-times"></i> Excluir</a>
                        <a class="btn normal" href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-empreendimento/<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Visualizar</a>
                    </div><!--group-btn-->
                </div><!--body-box-->
            </div><!--box-single-->
        </div><!--box-single-wraper-->

        <?php } ?>
    </div><!--boxes-->

</div><!--box-content-->