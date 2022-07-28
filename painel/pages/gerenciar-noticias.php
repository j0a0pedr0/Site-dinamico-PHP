<?php
    //pegando via get atributo excluir e validando acao
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        //metodo da classe painel com banco de dados
        $selectImagem = Mysql::Conectar()->prepare("SELECT capa FROM `tb_site.noticias` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));

        $imagem = $selectImagem->fetch()['capa'];
        Painel::deleteFile($imagem);
        Painel::deletar('tb_site.noticias',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticias');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        //Ordernando a posição do depoimento atraves da url
        PAINEL::orderItem('tb_site.noticias',$_GET['order'],$_GET['id']);
    }



    //listando os depoimentos e tambem limitando itens por pagina
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3;
    $noticias = Painel::selectAll('tb_site.noticias',(($paginaAtual - 1) * $porPagina),$porPagina);
    
?>

<div class="box-content editarUsuario listar-depoimentos w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-table-list"></i>  Notícias Cadastradas</h2>
    <div  class="w100 wraper">
        <table>
            <tr>
                <td><i class="fa-solid fa-user"></i> Título</td>
                <td>Categoria</td>
                <td>Imagem</td>
                <td>Editar</td>
                <td>Deletar</td>
                <td><i class="fa-solid fa-angles-up"></i></td>
                <td><i class="fa-solid fa-angles-down"></i></td>
            </tr>

            <?php foreach($noticias as $key =>$value){
                $nomeCategoria = Painel::select('tb_site.categorias','id=?',array($value['categoria_id']))['nome'];
            ?>
                
            <tr>
                <td><?php echo $value['titulo']; ?></td>
                <td><?php echo $nomeCategoria ?></td>
                <td><img style="width:50px;height:50px;" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $value['capa']; ?>"/></td>
                <td><a class="btn edit" href="<?php INCLUDE_PATH_PAINEL; ?>editar-noticia?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-noticias?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                <td style="max-width:20px;"><a class="btn btn-order" href="<?php INCLUDE_PATH_PAINEL; ?>gerenciar-noticias?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>
                <td style="max-width:20px;"><a class="btn btn-order" href="<?php INCLUDE_PATH_PAINEL; ?>gerenciar-noticias?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
            </tr>

            <?php } ?>
        </table>
    </div><!--wraper-->

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.noticias')) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
                }
                
            }
        ?>
    </div><!--paginacao-->
</div><!--box-content-->