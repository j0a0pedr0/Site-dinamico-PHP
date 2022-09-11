<?php
    if(isset($_GET['pendentes']) == false){
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



        if(isset($_POST['adicionar'])){
            $quantidadeAdd = $_POST['quantidade'];
            $produtoId = $_POST['produto_id'];
            $nomeProduto = $_POST['nome_produto'];
            $sql = MySql::Conectar()->prepare("SELECT quantidade FROM `tb_admin.estoque` WHERE id = $produtoId ");
            $sql->execute();
            $quantidadeEstoque = $sql->fetch();
            $totalQuantidade = ($quantidadeAdd+$quantidadeEstoque['quantidade']);
            $adicionarEstoque = Mysql::Conectar()->prepare("UPDATE `tb_admin.estoque` SET quantidade = $totalQuantidade WHERE id=$produtoId");
            $adicionarEstoque->execute();
            if($adicionarEstoque->execute() && $quantidadeAdd > 0){
                Painel::alert("sucesso","Você adicionou Com sucesso, <b>$quantidadeAdd</b> unidades ao produto <b>$nomeProduto.</b>","margin-top:160px;");
            }else{
                Painel::alert("erro","OCORREU UM ERRO AO adicionar a $_POST[quantidade] de unidade do produto $_POST[nome_produto]","margin-top:160px;");
            }
        }

        //Conferindo se o estoque estar com falta de produto.
        $sql = MySql::Conectar()->prepare("SELECT quantidade FROM `tb_admin.estoque` WHERE quantidade = 0 ");
        $sql->execute();
        $quantidadeEstoque = $sql->rowCount();
        //print_r($quantidadeEstoque);
        if($quantidadeEstoque > 0){
            Painel::alert('alert','Você está com produtos em falta! Clique <a href="'.INCLUDE_PATH_PAINEL.'visualizar-produtos?pendentes">aqui</a> para visualiza-los!','margin-top:140px;');
        }
        


        $query = "";
        if(isset($_POST['acao_pesquisa'])){
            $pesquisa = $_POST['busca'];
            $query = "WHERE quantidade > 0 AND nome LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%'";
        }

        $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query");
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


    <div class="boxes w100">
        
        <?php
            foreach($produtos as $key => $value){
                if($value['quantidade'] == 0)
                    continue;
                $imagemSingle = Mysql::conectar()->prepare("SELECT imagem FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 2");
                $imagemSingle->execute();
                $imagemSingle = $imagemSingle->fetchAll();
                /*echo '<pre>';
                print_r ($imagemSingle);
                echo '<pre>';*/
        ?>
        

        <div class="box-single-wraper w50">

            <div class="w40 box-single">
                <div style="border-bottom:2px solid #ccc;"><div class="img-produto" style="background-image:url('uploads/<?php echo $imagemSingle[0]['imagem'] ?>');"></div></div>
                <div ><div class="img-produto" style="background-image:url('uploads/<?php echo $imagemSingle[1]['imagem'] ?>');"></div></div>
                
            </div>
            <div class="w60 box-single">
                <div class="body-box">
                    <p><b><i class="fa fa-pencil"></i> Nome do produto:</b> <?php echo $value['nome']; ?> </p>
                    <p><b><i class="fa fa-pencil"></i> Descricao:</b> <?php echo $value['descricao']; ?> </p>
                    <p><b><i class="fa fa-pencil"></i> Largura:</b> <?php echo $value['largura']; ?> cm</p>
                    <p><b><i class="fa fa-pencil"></i> Altura:</b> <?php echo $value['altura']; ?> cm</p>
                    <p><b><i class="fa fa-pencil"></i> Comprimento:</b> <?php echo $value['comprimento']; ?> cm</p>
                    <p><b><i class="fa fa-pencil"></i> Peso:</b> <?php echo $value['peso']; ?> g</p>

                    <div class="group-btn">
                        <form class="form-quantidade" method="POST">
                            <div class="form-group">
                                <p><b><i class="fa fa-pencil"></i> Quantidade:</b> <?php echo $value['quantidade'] ?></p>
                                <input type="number" name="quantidade" min="0" max="900" step="1" value="0"/>
                                <input type="hidden" name="nome_produto" value="<?php echo $value['nome']; ?>">
                                <input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
                                <input type="submit" name="adicionar" value="Adicionar"/>
                            </div><!--fomr-group-->
                        </form>
                    </div><!--group-btn-->
                    
                    <div class="group-btn">
                        <a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-produto?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
                        <a class="btn delete" actionBtn="delete-produto" item_count="<?php echo $value['quantidade']; ?>" item_name="<?php echo $value['nome']; ?>" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-produtos"><i class="fa fa-times"></i> Excluir</a>
                    </div><!--group-btn-->
                </div><!--body-box-->
            </div><!--box-single-->
        </div><!--box-single-wraper-->

        <?php } ?>
    </div><!--boxes-->

</div><!--box-content-->
<?php }else{ ?>

    <div class="box-content editarUsuario listar-depoimentos w100">
        <h2 class="w100 h2-mobile" ><i class="fa-solid fa-triangle-exclamation"></i>  Produtos Em Falta</h2>
        
    <div class="busca w100">
        <h4 class="h2-mobile w100"><i class="fa fa-search"></i> Realizar busca por Produtos</h4>
        <form method="post">
            <?php
                    if(isset($_POST['adicionar'])){
                        $quantidadeAdd = $_POST['quantidade'];
                        $produtoId = $_POST['produto_id'];
                        $nomeProduto = $_POST['nome_produto'];
                        $sql = MySql::Conectar()->prepare("SELECT quantidade FROM `tb_admin.estoque` WHERE id = $produtoId ");
                        $sql->execute();
                        $quantidadeEstoque = $sql->fetch();
                        $totalQuantidade = ($quantidadeAdd+$quantidadeEstoque['quantidade']);
                        $adicionarEstoque = Mysql::Conectar()->prepare("UPDATE `tb_admin.estoque` SET quantidade = $totalQuantidade WHERE id=$produtoId");
                        $adicionarEstoque->execute();
                        if($adicionarEstoque->execute() && $quantidadeAdd > 0){
                            Painel::alert("sucesso","Você adicionou Com sucesso, <b>$quantidadeAdd</b> unidades ao produto <b>$nomeProduto.</b>","margin-top:-60px;");
                        }else{
                            Painel::alert("erro","OCORREU UM ERRO AO adicionar a quantidade de <b>$quantidadeAdd</b> do produto <b>$nomeProduto.</b>","margin-top:-60px;");
                        }
                    }

                    $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
                    $sql->execute();
                    $produtos = $sql->fetchAll();

                    if(count($produtos) == 0){
                        Painel::alert('sucesso','Você não tem mais nenhum produto em falta!');
                        //header('location:'.INCLUDE_PATH_PAINEL.'visualizar-produtos?pendentes');
                    }else{
                        Painel::alert('alert','Atenção, Todos os itens abaixo então em falta em seu estoque!');
                    }
            ?>
        </form>
    </div><!--busca-->

<a href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-produtos">< voltar para o estoque</a>
    <div class="boxes w100">
        
        <?php
            foreach($produtos as $key => $value){
                $imagemSingle = Mysql::conectar()->prepare("SELECT imagem FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 2");
                $imagemSingle->execute();
                $imagemSingle = $imagemSingle->fetchAll();
                /*echo '<pre>';
                print_r ($imagemSingle);
                echo '<pre>';*/
        ?>
        

        <div class="box-single-wraper w50">

            <div class="w40 box-single">
                <div style="border-bottom:2px solid black;"><img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $imagemSingle[0]['imagem'] ?>" ></div>
                <div><img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $imagemSingle[1]['imagem'] ?>" ></div>
                
            </div>
            <div class="w60 box-single">
                <div class="body-box">
                    <p><b><i class="fa fa-pencil"></i> Nome do produto:</b> <?php echo $value['nome']; ?> </p>
                    <p><b><i class="fa fa-pencil"></i> Descricao:</b> <?php echo $value['descricao']; ?> </p>
                    <p><b><i class="fa fa-pencil"></i> Largura:</b> <?php echo $value['largura']; ?> cm</p>
                    <p><b><i class="fa fa-pencil"></i> Altura:</b> <?php echo $value['altura']; ?> cm</p>
                    <p><b><i class="fa fa-pencil"></i> Comprimento:</b> <?php echo $value['comprimento']; ?> cm</p>
                    <p><b><i class="fa fa-pencil"></i> Peso:</b> <?php echo $value['peso']; ?> g</p>

                    <div class="group-btn">
                        <form class="form-quantidade" method="POST">
                            <div class="form-group">
                                <p><b><i class="fa fa-pencil"></i> Quantidade:</b> <?php echo $value['quantidade'] ?></p>
                                <input type="number" name="quantidade" min="0" max="900" step="1" value="0"/>
                                <input type="hidden" name="nome_produto" value="<?php echo $value['nome']; ?>">
                                <input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
                                <input type="submit" name="adicionar" value="Adicionar"/>
                            </div><!--fomr-group-->
                        </form>
                    </div><!--group-btn-->
                    
                    <div class="group-btn">
                        <a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-produto?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
                        <a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-produtos?id=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
                    </div><!--group-btn-->
                </div><!--body-box-->
            </div><!--box-single-->
        </div><!--box-single-wraper-->

        <?php } ?>
    </div><!--boxes-->

<?php } ?>