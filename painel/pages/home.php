<?php
    $usuariosOnline = Painel::listarUsuariosOnline();

    $pegarVisitasTotais = MySql::Conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
    $pegarVisitasTotais->execute();

    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();
    //$data = date("Y-m-d");
    $pegarVisitasHoje = MySql::Conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
    $pegarVisitasHoje->execute(array(date('Y-m-d')));
    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>

<div class="w100 box-content">
    <h2 class="w100 h2-mobile"><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>

    <div class="box-metrica-single w33">
        <div class="box-metrica-wraper">
            <h2 class=" h2-mobile">Usuários Online</h2>
            <p><?php echo count($usuariosOnline); ?></p>
        </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div class="box-metrica-single w33">
        <div class="box-metrica-wraper">
            <h2 class=" h2-mobile">Total de visitas</h2>
            <p><?php echo $pegarVisitasTotais; ?></p>
        </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div class="box-metrica-single w33">
        <div class="box-metrica-wraper">
            <h2 class=" h2-mobile">Visitas Hoje</h2>
            <p><?php echo $pegarVisitasHoje; ?></p>
        </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
</div><!--box-content-->

<div class="usuariosOnline box-content gambiarra-displayflex w100">
    <h2 class="w100 h2-mobile"><i style="margin-right:6px;color:#8beb0d;height:0px!important;" class="fa-solid fa-signal"></i>Usuários Online</h2>
    <div class="table-resposive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div><!--col-->
            <div class="col">
                <span>Ùltima ação</span>
            </div><!--col-->
        </div><!--row-->

        <?php 
            foreach ($usuariosOnline as $key =>$value){
        ?>

        <div class="row">
            <div class="col">
                <span><?php echo $value['ip'] ?></span>
            </div><!--col-->
            <div class="col">
                <span><?php echo date('d/m/Y---H:i:s',strtotime($value['ultima_acao'])) ?></span>
            </div><!--col-->
        </div><!--row-->

        <?php } ?>
    </div><!--table-resposive-->
</div><!--box-content-->
 
<div class="usuariosPainel box-content gambiarra-displayflex w100">
    <h2  class="w100 h2-mobile" ><i style="margin-right:6px;color:#83c3e7;" class="fa-solid fa-address-book"></i>Usuários do Painel</h2>
    <div class="table-resposive">
        <div class="row">
            <div class="col">
                <span>Nome</span>
            </div><!--col-->
            <div class="col">
                <span>Cargo</span>
            </div><!--col-->
        </div><!--row-->

        <?php 
            $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
            $usuariosPainel->execute();
            $usuariosPainel = $usuariosPainel->fetchAll();

            foreach ($usuariosPainel as $key =>$value){
        ?>

        <div style="border-bottom:1px solid rgb(196, 196, 196);;" class="row">
            <div class="col">
                <span><?php echo $value['user'] ?></span>
            </div><!--col-->
            <div class="col">
                <span><?php echo pegarCargo($value['cargo']); ?></span>
            </div><!--col-->
            
        </div><!--row-->
            

        <?php } ?>
    </div><!--table-resposive-->
</div><!--box-content-->