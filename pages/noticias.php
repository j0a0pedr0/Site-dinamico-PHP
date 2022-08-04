<?php $adm = Painel::select('tb_site.config'); ?>

<?php 
    $url = explode('/',$_GET['url']);
    if(!isset($url[2])) {
    $categoria = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
    $categoria->execute(array(@$url[1]));
    $categoria = $categoria->fetch();
?>

<section class="header-noticias">
    <div class="center">
        <h2><i class="fa-solid fa-bell"></i></h2>
        <h2>Acompanhe os últimos Projetos do meu <p>Portfólio</p></h2>
    </div><!--center-->
</section><!--Header-noticias-->

<section class="container-portal">
    <div class="center">
        <div class="sidebar">
            <div class="content-box-sidebar">
                <h3><i class="fa-solid fa-magnifying-glass"></i>Realizar uma busca:</h3>
                <form method="POST">
                    <input type="text" name="parametro" placeholder="O que deseja procurar?" required/>
                    <input type="submit" name="buscar" value="Pesquisar"/>
                </form>
            </div><!--content-box-sidebar-->
            <div class="content-box-sidebar">
                <h3><i class="fa-solid fa-list-ul"></i>Selecione a Categoria:</h3>
                <form>
                    <select name="categoria">
                    <option value=""  selected="">Todas as categorias</option>
                    <?php
                        $categorias = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
                        $categorias->execute();
                        $categorias = $categorias->fetchAll();
                        foreach($categorias as $key => $value){
                    ?>
                        <option <?php if($value['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $value['slug']; ?>"><?php echo $value['nome']; ?></option>

                    <?php } ?>
                    <img src="../painel/uploads/<?php echo $adm['img']; ?>">
                    </select>
                </form>
            </div><!--content-box-sidebar-->

            <div class="content-box-sidebar">
                <h3><i class="fa-solid fa-user"></i>sobre o autor:</h3>
                <div class="autor-box-portal">
                    <div class="box-img-autor">
                    <?php if(isset($url[1])){ ?>    
                        <img src="../painel/uploads/<?php echo $adm['img']; ?>">
                    <?php } else { ?>
                        <img src="./painel/uploads/<?php echo $adm['img']; ?>">
                    <?php } ?>
                    
                        
                        <h3><?php echo $adm['nome_autor']; ?></h3>
                    </div><!--box-img-autor-->
                    <div class="texto-autor-portal">
                        <p><?php echo substr($adm['descricao'],0,70).'...'; ?><a href="<?php echo INCLUDE_PATH ?>?descricao_autor">mais</a></p>
                    </div><!--texto-autor-portal-->
                </div><!--autor-box-portal-->
            </div><!--content-box-sidebar-->
        </div><!--sidebar-->

        <div class="conteudo-portal">
            <div class="header-conteudo-portal">
                <?php
                    $porPagina = 2;
                    if(!isset($_POST['parametro'])){
                        if(@$categoria['nome'] == ''){
                            echo '<h2>Visualizando <span>todos os Projetos</span></h2>';
                        }else{
                            echo '<h2>Visualizando projetos do curso <span>'.$categoria['nome'].'</span></h2>';
                        }
                    }else{
                        echo '<h2><i class="fa fa-check"></i> Busca Realizada com  <span style="color:lightgreen;">Sucesso</span></h2>';
                    }

                    $query = ("SELECT * FROM `tb_site.noticias` ");
                    if(@$categoria['nome'] != ''){
                        $categoria['id'] = (int)$categoria['id'];
                        $query.="WHERE categoria_id=$categoria[id]";

                    }
                    $query2 = "SELECT * FROM `tb_site.noticias` ";
                    if(@$categoria['nome'] != ''){
                        $categoria['id'] = (int)$categoria['id'];
                        $query2.="WHERE categoria_id=$categoria[id]";
                    }

                    if(isset($_POST['parametro'])){
                        $buscar = $_POST['parametro'];
                        if(strstr($query,'WHERE') !== false){
                            $query.=" AND titulo LIKE '%$buscar%'";
                        }else{
                            $query.=" WHERE titulo LIKE '%$buscar%'";
                        }
                    }

                    if(isset($_POST['parametro'])){
                        $buscar = $_POST['parametro'];
                        if(strstr($query2,'WHERE') !== false){
                            $query2.=" AND titulo LIKE '%$buscar%'";
                        }else{
                            $query2.=" WHERE titulo LIKE '%$buscar%'";
                        }
                    }

                    $totalPaginas = Mysql::Conectar()->prepare($query2);
                    $totalPaginas->execute();
                    $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
                    if(!isset($_POST['parametro'])){
                        if(isset($_GET['pagina'])){
                            $pagina = (int)$_GET['pagina'];
                            if($pagina > $totalPaginas){
                                $pagina = 1;
                            }
                            $queryPg = ($pagina - 1) * $porPagina; 
                            $query.=" ORDER BY id DESC LIMIT $queryPg,$porPagina";
                        }else{
                            $pagina = 1;
                            $query.=" ORDER BY id DESC LIMIT 0,$porPagina";
                        }
                    }else{
                        $query.=" ORDER BY id DESC";
                        
                    }
                   
                    $sql = MySql::Conectar()->prepare($query);
                    $sql->execute();
                    $noticias = $sql->fetchAll();
                    
                    
                    if(isset($_POST['parametro'])){
                        $totalNoticias = $sql->rowCount();
                        if($totalNoticias === 1){
                            $resultados = 'resultado';
                            $apenas = 'apenas';
                        }else{
                            $resultados = 'resultados';
                            $apenas = 'Um Total de';
                        }
                        echo '<h2 style="font-size:15px;">'.$apenas.' <span style="color:darkblue;font-size:19px;">'.$totalNoticias.'</span> '.$resultados.'</h2>';
                    }
                    
                ?>
            </div><!--header-conteudo-portal-->
            <?php foreach($noticias as $key =>$value) { 
                
                $sql = MySql::Conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
                $sql->execute(array($value['categoria_id']));
                $categoriaNome = $sql->fetch()['slug']    
            ?>
                
                <div class="box-single-conteudo">
                    <div class="left w100 noticias">
                        <h3><?php echo date(('d/m/Y'),strtotime($value['data'])); ?> - <?php echo $value['titulo']; ?></h2>
                        <p><?php echo substr(strip_tags($value['conteudo']),0,400).'...' ?></p>
                        
                    </div>
                    <div class="left w100 noticias">
                        <div class="logo-noticias" style="background-image: url('<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $value['capa']; ?>'); background-size:100% 100%;width:100%;height:290px;border-radius:19px;"></div>
                        <a href="<?php echo $value['portfolio']; ?>">Acessar Site</a>
                    </div>
                    <div class="clear"></div>
                </div><!--box-single-conteudo-->
            <?php } ?>

            <?php
            
            ?>
        
            <div class="paginator">
                <?php
                    if(!isset($_POST['parametro'])){
                        for($i = 1;$i <= $totalPaginas;$i++){
                            $catStr = (@$categoria['nome'] != '') ? '/'.$categoria['slug'] : '';
                            if($pagina == $i){
                                echo "<a style='border-radius:8px;' class='active' href='".INCLUDE_PATH."noticias".$catStr."?pagina=".$i."'>".$i."</a>";
                            }else{
                                echo "<a style='border-radius:8px;' href='".INCLUDE_PATH."noticias".$catStr."?pagina=".$i."'>".$i."</a>";
                            }
                        }
                    }

                ?>
            </div><!--paginator-->

        </div><!--conteudo-portal-->
        <div class="clear"></div>
    </div><!--center-->
</section><!--container-portal-->

<?php } else{ 
    include('noticia_single.php');
}
?>
