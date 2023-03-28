<?php
    namespace Controller;

    Class empreendimentoController
    {

        public static function index($par){
            $slug = $par[0];

            $empreendId = \Models\empreendimentoModel::pegarEmpreend($slug);
            \Views\mainViews::setParam(['nome_empreendimento'=>$empreendId[0]['nome'],'slug'=>$slug,'imoveis'=>\Models\empreendimentoModel::pegaImovel($empreendId[0]['id'])]);
            \Views\mainViews::render('empreendimentos.php');
        }
    }


?>