<?php 

    include('../config.php');
    $data = array();
    $data = "";

    $preco_max = \Painel::formatarMoeda(str_replace('R$','',$_POST['preco_maximo']));
    $preco_min = \Painel::formatarMoeda(str_replace('R$','',$_POST['preco_minimo']));
    $area_max = $_POST['area_maxima'];
    $area_min = $_POST['area_minima'];
    $nome_imovel = $_POST['nome_imovel'];

    
    if($preco_max === ''){
        $preco_max = 1000000000.00;
    }
    if($preco_min === ''){
        $preco_min = 10.00;
    }
    if($area_max === ''){
        $area_max = 900;
    }
    if($area_min === ''){
        $area_min = 10;
    }

    if(isset($_POST['slug_empreendimento'])){
        $slug_empreendimento = $_POST['slug_empreendimento'];
        
        $infoEmpreendimento = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE slug = ?");
        $infoEmpreendimento->execute(array($slug_empreendimento));
        $infoEmpreendimento = $infoEmpreendimento->fetch();

        $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE (preco >= ? AND preco <= ?) AND (area >= ? AND area <= ?) AND nome LIKE ? AND empreend_id = ?");
        $sql->execute(array($preco_min,$preco_max,$area_min,$area_max,"%$nome_imovel%",$infoEmpreendimento['id']));
        //$sql->execute(array($preco_min,$preco_max,$area_min,$area_max,"%$nome_imovel%",$slug_empreendimento));
        /*$sql = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.imoveis`");
        $sql->execute();*/
        $imoveis = $sql->fetchAll();
        /*echo '<pre>';
        print_r($retorno);
        echo '</pre>';*/
        $data = '<div class="center"><div class="w100 title-list"><h3>Listando <b>'.count($imoveis).' imoveis</b> de</h3></div></div>';

        foreach($imoveis as $key => $value){
            $imagens = \Mysql::Conectar()->prepare("SELECT imagem FROM `tb_admin.imoveis_imagens` WHERE imovel_id = $value[id]");
            $imagens->execute();
            $imagens = $imagens->fetch()['imagem'];
            

            $data.='<div class="row-imoveis w100">
                        <div class="r1">
                            <img class="img-imovel" src="'.INCLUDE_PATH_PAINEL.'uploads/'.$imagens.'" alt="">
                        </div>
                        <div class="r2">
                            <p><i class="fa fa-info"></i> Nome dp imovel:'.$value['nome'].'</p>
                            <p><i class="fa fa-info"></i> Area:'.$value['area'].'m²</p>
                            <p><i class="fa fa-info"></i> Andar:'.$value['andar'].'º</p>
                            <p><i class="fa fa-info"></i> Preço: R$'.\Painel::convertMoney($value['preco']).'</p>
                        </div>
                    </div>';
        }


    }else{
        $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE (preco >= ? AND preco <= ?) AND (area >= ? AND area <= ?) AND nome LIKE ?");
        $sql->execute(array($preco_min,$preco_max,$area_min,$area_max,"%$nome_imovel%"));
        $imoveis = $sql->fetchAll();

        $data = '<div class="center"><div class="w100 title-list"><h3>Listando <b>'.count($imoveis).' imoveis</b> de</h3></div></div>';

        foreach($imoveis as $key => $value){
            $imagens = \Mysql::Conectar()->prepare("SELECT imagem FROM `tb_admin.imoveis_imagens` WHERE imovel_id = $value[id]");
            $imagens->execute();
            $imagens = $imagens->fetch()['imagem'];
            

            $data.='<div class="row-imoveis w100">
                        <div class="r1">
                            <img class="img-imovel" src="'.INCLUDE_PATH_PAINEL.'uploads/'.$imagens.'" alt="">
                        </div>
                        <div class="r2">
                            <p><i class="fa fa-info"></i> Nome dp imovel:'.$value['nome'].'</p>
                            <p><i class="fa fa-info"></i> Area:'.$value['area'].'m²</p>
                            <p><i class="fa fa-info"></i> Andar:'.$value['andar'].'º</p>
                            <p><i class="fa fa-info"></i> Preço: R$'.\Painel::convertMoney($value['preco']).'</p>
                        </div>
                    </div>';
        }
    }
    //print_r($_POST);

    echo $data;
?>