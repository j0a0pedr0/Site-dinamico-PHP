<?php
    namespace Views;

    Class mainViews
    {
        public static $par = [];
        public static function setParam($par){
            Self::$par = $par;
        }
        public static function render($fileName,$header = 'pages/includes/header.php',$footer= 'pages/includes/footer.php'){
            include($header);
            include('pages/'.$fileName);
            include($footer);
            die();
        }
    }

?>