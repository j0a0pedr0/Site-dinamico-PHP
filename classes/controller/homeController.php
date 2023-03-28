<?php
    namespace Controller;

    Class homeController
    {
        public function index()
        {
            \Views\mainViews::setParam(['imoveis'=>\Models\homeModel::pegaImoveis()]);
            \Views\mainViews::render('home.php');
        }
    }

?>