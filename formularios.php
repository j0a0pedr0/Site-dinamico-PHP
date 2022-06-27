<?php 
        include('config.php');
        $data = array();
        $assunto = 'aplicando a ajax np site';
        $corpo = '';

        foreach($_POST as $key => $value) {
            $corpo.= ucfirst($key).": ".$value."<hr>";
            
        }
        $info = array('assunto'=>$assunto,'corpo'=>$corpo);
        $mail = new Email('smtp.hostinger.com','joaopedroteste@cursospoderfeminino.com','Jaca1000$','Joao');
        $mail->addAddress('joaopedroteste@cursospoderfeminino.com','euMesmo');
        $mail->formatarEmail($info);
        if($mail->enviarEmail()){
            $data['sucesso'] = true;
        }else{
            $data['erro'] = true;
        }

        $data['retorno'] = 'sucesso';

        die(json_encode($data));

?>