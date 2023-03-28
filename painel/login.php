<?php
    if(isset($_COOKIE['lembrar'])){
        $user  = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = MySql::Conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));

        if($sql->rowCount() > 0){
            $info = $sql->fetch();
            //logamos com sucesso
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $info['id'];
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['img'] = $info['img'];
            header('location: '.INCLUDE_PATH_PAINEL);
            die();
        }
    }
?>


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
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" type="text/css">
    <title>Painel de Controle</title>
</head>
<body>
    
    <div class="box-login">
        <?php
               if(isset($_POST['acao'])){
                    $user = $_POST['user'];
                    $password = $_POST['password'];
                    $sql = MySql::Conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
                    $sql->execute(array($user,$password));

                    if($sql->rowCount() > 0){
                        $info = $sql->fetch();
                        //logamos com sucesso
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['password'] = $password;
                        $_SESSION['id'] = $info['id'];
                        $_SESSION['cargo'] = $info['cargo'];
                        $_SESSION['nome'] = $info['nome'];
                        $_SESSION['img'] = $info['img'];
                        if(isset($_POST['lembrar'])){
                            setcookie('lembrar',true,time()+60*60*24,'/');
                            setcookie('user',$user,time()+60*60*24,'/');
                            setcookie('password',$password,time()+60*60*24,'/');
                        }
                        header('location: '.INCLUDE_PATH_PAINEL);
                        die();
                    }else{
                        echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos</div>';
                    }
                }
            
        ?>
    

        <h2>Efetue O Login!</h2>
        <form method="POST">
            <input type="text" name="user" placeholder="Login..." required>
            <input type="password" name="password" placeholder="Senha..." required>
            <input type="submit" name="acao" value="Logar!">
        
            <div class="group-login">
                <label style="color: #ccc ;">Lembrar-me</label>
                <input style="margin-top:8px;" type="checkbox" name="lembrar" />
            </div>
        </form>

    </div><!--BOX_LOGIN-->

</body>
</html>