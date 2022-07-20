<?php
    //pegando via get atributo excluir e validando acao
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        //metodo da classe painel com banco de dados
        $selectImagem = Mysql::Conectar()->prepare("SELECT slide FROM `tb_site.slides` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));

        $imagem = $selectImagem->fetch()['slide'];
        Painel::deleteFile($imagem);
        Painel::deletar('tb_site.slides',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        //Ordernando a posição do depoimento atraves da url
        PAINEL::orderItem('tb_site.slides',$_GET['order'],$_GET['id']);
    }



    //listando os depoimentos e tambem limitando itens por pagina
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3;
    $slides = Painel::selectAll('tb_site.slides',(($paginaAtual - 1) * $porPagina),$porPagina);
?>

<div class="box-content editarUsuario listar-depoimentos w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-table-list"></i>  Slides Cadastrados</h2>
    <div  class="w100 wraper">
        <table>
            <tr>
                <td><i class="fa-solid fa-user"></i> Nome</td>
                <td>Imagem</td>
                <td>Editar</td>
                <td>Deletar</td>
                <td><i class="fa-solid fa-angles-up"></i></td>
                <td><i class="fa-solid fa-angles-down"></i></td>
            </tr>

            <?php foreach($slides as $key =>$value){ ?>

            <tr>
                <td><?php echo $value['nome']; ?></td>
                <td><img style="width:50px;height:50px;" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $value['slide']; ?>"/></td>
                <td><a class="btn edit" href="<?php INCLUDE_PATH_PAINEL; ?>editar-slide?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                <td><a class="btn btn-order" href="<?php INCLUDE_PATH_PAINEL; ?>listar-slides?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>
                <td><a class="btn btn-order" href="<?php INCLUDE_PATH_PAINEL; ?>listar-slides?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
            </tr>

            <?php } ?>
        </table>
    </div><!--wraper-->

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.slides')) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
                }
                
            }

        ?>
    </div><!--paginacao-->
</div><!--box-content-->