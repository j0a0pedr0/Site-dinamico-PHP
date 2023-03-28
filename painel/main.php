<?php
    if(isset($_GET['loggout'])){
        Painel::loggout();
    }
    
?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/jquery-ui.min.css">
    <title>Painel de Controle</title>
</head>
<body>

<base base="<?php echo INCLUDE_PATH_PAINEL; ?>" />

<div class="menu">
    <div class="menu-wraper">
        <div class="box-usuario">
            <?php 
                if($_SESSION['img'] == ''){
            ?>
            <div class="avatar-usuario">
                    <i class="fa fa-user"></i>
            </div><!--avatar-usuario-->

            <?php }else{ ?>

                <div class="imagem-usuario">
                    <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img']; ?>"/>
                </div><!--avatar-usuario-->
            <?php }?>
            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome']; ?></p>
                <p><?php echo pegarCargo($_SESSION['cargo']);?></p>
            </div><!--nome-usuario-->
        </div><!--box-usuario-->
        <div class="items-menu">
            <h2>Cadastro</h2>
            <a <?php selecionadoMenu('cadastrar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-depoimentos">Cadastrar depoimento</a>
            <a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-servico">Cadastrar Serviço</a>
            <a <?php selecionadoMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-slides">Cadastrar Slides</a>

            <h2>Gestão</h2>
            <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-depoimentos">Listar Depoimentos</a>
            <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos">Listar Serviços</a>
            <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides">Listar Slides</a>

            <h2>Administração do painel</h2>
            <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-usuario">Editar Usuário</a>
            <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificarPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>adicionar-usuario">Adicionar Usuários</a>

            <h2>Gestão Das Notícias</h2>
            <a <?php selecionadoMenu('cadastrar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-categorias">Cadastrar Categorias</a>
            <a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias">Gerênciar Categorias</a>
            <a <?php selecionadoMenu('cadastrar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-noticias">Cadastrar Notícias</a>
            <a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-noticias">Gerênciar Notícias</a>

            <h2>Gestão De Clientes</h2>
            <a <?php selecionadoMenu('cadastrar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-clientes">Cadastrar Clientes</a>
            <a <?php selecionadoMenu('gerenciar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-clientes">Gerênciar Clientes</a>

            <h2>Controle Financeiro</h2>
            <a <?php selecionadoMenu('visualizar-pagamentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-pagamentos">Visualizar Pagamentos</a>

            <h2>Controle de Estoque</h2>
            <a <?php selecionadoMenu('cadastrar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-produtos">Cadastrar Produtos</a>
            <a <?php selecionadoMenu('visualizar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-produtos">Visualizar Produtos</a>

            <h2>Gestão de imóveis</h2>
            <a <?php selecionadoMenu('cadastrar-empreeedimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-empreendimento">Cadastrar Empreendimento</a>
            <a <?php selecionadoMenu('listar-empreeedimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-empreendimentos">Listar Empreendimentos</a>
            

            <h2>Configuração Geral</h2>
            <a <?php selecionadoMenu('editar-site'); ?>  href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-site">Editar Site</a>
        </div><!--items-menu-->
    </div><!--menu-wraper-->    
</div><!--Menu-->
<div class="topo-painel">
    <div class="container">
        <header>
            <div class="center">
                <div class="menu-btn">
                    <i class="fa fa-bars"></i>
                </div><!--menu-btn-->
                <div class="menu-btn">
                     <a style="margin-left:16px;color:#010235" href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fa fa-home"></i></a><a style="margin-left:5px;color:#010235;text-decoration:none;<?php if(@$_GET['url'] == ''){?> border-bottom:3px solid #0a5989;<?php }?> " href="<?php echo INCLUDE_PATH_PAINEL; ?>">Pagina inicial</a>
                </div>
                <div class="loggout">
                    <a style="padding-right:1px;color:#010235;text-decoration:none;" href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout">Sair</a>
                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i></a>
                </div><!--loggout-->

                <div class="loggout" style="margin-right:49px;">
                    <a style="margin-left:0px;color:#010235;text-decoration:none;<?php if(@$_GET['url'] == 'chat-online'){?> border-bottom:3px solid #0a5989;<?php }?> " href="<?php echo INCLUDE_PATH_PAINEL; ?>chat-online">Chat Online</a>
                    <a style="margin-left:16px;color:#010235" href="<?php echo INCLUDE_PATH_PAINEL; ?>chat-online"><i class="fa-solid fa-comments"></i></a>
                </div><!--chat-online-->

                <div class="loggout" style="margin-right:49px;">
                    <a style="margin-left:0px;color:#010235;text-decoration:none;<?php if(@$_GET['url'] == 'calendario'){?> border-bottom:3px solid #0a5989;<?php }?> " href="<?php echo INCLUDE_PATH_PAINEL; ?>calendario">Calendário</a>
                    <a style="margin-left:16px;color:#010235" href="<?php echo INCLUDE_PATH_PAINEL; ?>calendario"><i class="fa-solid fa-calendar"></i></a>
                </div><!--chat-online-->
            </div>
            <div class="clear"></div>
        </header>
        <div class="content">
            <?php
            
            Painel::carregarPagina(); 
            
            ?>
        </div><!--content-->
        <div class="clear"></div>
    </div><!--container-->
</div><!--topo-painel-->

<!--FUNCOES DO MAIN-->
<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/jquery-migrate-1.4.1.min.js" type="text/javascript"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/jquery-migrate-3.3.2.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@1.9.13/dist/zebra_datepicker.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.mask.js" type="text/javascript"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.form.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/main.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>

<!--FUNCOES DO TYNIMCE-->
<?php if(@$_GET['url'] == 'cadastrar-noticias' || @$_GET['url'] == 'editar-noticia') { ?>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/tinymce/tinymce.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/tinymce/icons/default/icons.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/tinymce/plugins"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/tinymce/plugins/autolink/plugin.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/tinymce/plugins/importcss/plugin.min.js"></script>
<script>
       tinymce.init({
      selector: '.tinymce',
      language:'pt_BR',
      
    });
</script>
<?php } ?>



<?php if(@$_GET['url'] == 'cadastrar-clientes' || @$_GET['url'] == 'gerenciar-clientes' || @$_GET['url'] == 'editar-cliente'
        || @$_GET['url'] == 'visualizar-produtos' || @$_GET['url'] == 'editar-produto' || @$_GET['url'] == 'cadastrar-produtos' 
        || @$_GET['url'] == 'cadastrar-empreendimento' || @$_GET['url'] == 'editar-empreendimento' || @$_GET['url'] == 'editar-imovel'){ ?>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/helperMask.js"></script>
<?php } ?>

<?php Painel::loadJS(array('ajax.js'),'cadastrar-clientes'); ?>
<?php Painel::loadJS(array('ajax.js'),'gerenciar-clientes'); ?>
<?php Painel::loadJS(array('ajax.js'),'editar-cliente'); ?>
<?php Painel::loadJS(array('financeiroCliente.js'),'editar-cliente'); ?>
<?php Painel::loadJS(array('maskMoney.js'),'editar-cliente'); ?>
<?php Painel::loadJS(array('ajax.js'),'visualizar-produtos'); ?>
<?php Painel::loadJS(array('ajax.js'),'editar-produto'); ?>
<!--FUNCOES DO SISTEMA DE IMÒVEIS-->
<?php Painel::loadJS(array('financeiroCliente.js'),'cadastrar-empreendimento'); ?>
<?php Painel::loadJS(array('maskMoney.js'),'cadastrar-empreendimento'); ?>
<?php Painel::loadJS(array('ajax.js'),'listar-empreendimentos'); ?>
<?php Painel::loadJS(array('jquery-ui.min.js'),'listar-empreendimentos'); ?>
<?php Painel::loadJS(array('empreendimentos.js'),'listar-empreendimentos'); ?>
<?php Painel::loadJS(array('ajax.js'),'editar-imovel'); ?>

<!--FUNCOES DO SISTEMA DE IMÒVEIS-->
<?php Painel::loadJS(array('chat.js'),'chat-online'); ?>

<!--FUNCOES DO SISTEMA DE IMÒVEIS-->
<?php Painel::loadJS(array('calendario.js'),'calendario'); ?>



</body>
</html>