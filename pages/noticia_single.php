<?php
    $url = explode('/',$_GET['url']);

    $verifica_categoria = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug=?");
    $verifica_categoria->execute(array($url[1]));

    if($verifica_categoria->rowCount() == 0){
        PAinel::redirect(INCLUDE_PATH.'noticias');
    }

    $categoria_info = $verifica_categoria->fetch();

    $post = Mysql::Conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug =? AND categoria_id =?");
    $post->execute(array($url[2],$categoria_info['id']));

    if($post->rowCount() == 0){
        Painel::redirect(INCLUDE_PATH.'noticias');
    }

    $post = $post->fetch();
?>

<section class="noticia-single">
    <div class="center">
        <header>
            <h1><i class="fa-solid fa-calendar-days"></i> <?php echo $post['data']; ?> - <?php echo $post['titulo']; ?></h1>
        </header>
        
        <article>
            <?php echo $post['conteudo']; ?>
        </article>
    </div><!--center-->
</section><!--noticia0single-->