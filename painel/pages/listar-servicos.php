<?php
    //pegando via get atributo excluir e validando acao
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        //metodo da classe painel com banco de dados
        Painel::deletar('tb_site.servicos',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        //Ordernando a posição do depoimento atraves da url
        PAINEL::orderItem('tb_site.servicos',$_GET['order'],$_GET['id']);
    }



    //listando os depoimentos e tambem limitando itens por pagina
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3;
    $servicos = Painel::selectAll('tb_site.servicos',(($paginaAtual - 1) * $porPagina),$porPagina);
?>

<div class="box-content editarUsuario listar-depoimentos w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-table-list"></i>  Serviços Cadastrados</h2>
    <div  class="w100 wraper">
        <table>
            <tr>
                <td><i class="fa-solid fa-user"></i> Serviço</td>
                <td>Editar</td>
                <td>Deletar</td>
                <td><i class="fa-solid fa-angles-up"></i></td>
                <td><i class="fa-solid fa-angles-down"></i></td>
            </tr>

            <?php foreach($servicos as $key =>$value){ ?>

            <tr>
                <td style="max-width:600px;overflow:hidden;"><?php echo $value['servico']; ?></td>
                <td><a class="btn edit" href="<?php INCLUDE_PATH_PAINEL; ?>editar-servico?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                <td><a class="btn btn-order" href="<?php INCLUDE_PATH_PAINEL; ?>listar-servicos?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>
                <td><a class="btn btn-order" href="<?php INCLUDE_PATH_PAINEL; ?>listar-servicos?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
            </tr>

            <?php } ?>
        </table>
    </div><!--wraper-->

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.servicos')) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
                }
                
            }

        ?>
    </div><!--paginacao-->
</div><!--box-content-->