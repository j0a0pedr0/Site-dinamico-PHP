<?php
    include("../includeConstants.php");
?>

<style type="text/css">
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    h2{
        background:#333;
        color:white;
        padding:8px;
    }

    .box{
        width:900px;
        margin:0 auto;
    }
    table{
        width:100%;
        border-collapse:collapse;
    }
    table td{
        border:1px solid #ccc;
        padding: 4px 3px 4px 6px;
        font-size:18px;
    }
</style>

<?php 
    $nome = (isset($_GET['pagamento']) && $_GET['pagamento'] == 'concluidos') ? 'concluidos' : 'pendentes';
    $nomestatus = '';
?>

<div class="box">
    <div class="box-content w100 editarUsuario listar-depoimentos">
        <h2 class="w100" ><i class="fa-solid fa-money-check-dollar"></i> Pagamentos <?php echo ucfirst($nome); ?></h2>
        <div  class="w100 wraper">
            <table>
                <tr  style="font-weight:600;">
                    <td>Nome do pagamento</td>
                    <td>Cliente</td>
                    <td>Valor</td>
                    <td>Vencimento</td>
                    <?php if($nome == 'concluidos'){ ?>
                                <td>Data de Pagamento</td>
                    <?php }else{ ?>
                        
                    <?php } ?>
                </tr>       
                
                <?php
                    if($nome == 'concluidos'){
                        $nomestatus = 1;
                    }else{
                        $nomestatus = 0;
                    }
                    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    $porPagina = 10;
                    $start = (($paginaAtual - 1) * $porPagina);
                    $end = $porPagina;
                    $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE `status`=$nomestatus ORDER BY `data_pagamento` DESC LIMIT 20");
                    $sql->execute();
                    $pendentes = $sql->fetchAll();

                    foreach($pendentes as $key => $value){
                        $clienteNome = Mysql::Conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
                        $clienteNome->execute();
                        $clienteNome = $clienteNome->fetch()['nome'];
                ?>

                <tr  >
                    <td><?php echo $value['nome']; ?></td>
                    <td><?php echo $clienteNome; ?></td>
                    <td><?php echo $value['valor']; ?></td>
                    <td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
                    
                    <?php if($nome == 'concluidos'){ ?>
                        <td><?php echo date('d/m/Y -- H:i',strtotime($value['data_pagamento'])); ?></td>
                    <?php } ?>
                </tr>   

                <?php } ?>
            </table>
        </div><!--wraper-->
    </div><!--box-content-->
</div><!--box-->

