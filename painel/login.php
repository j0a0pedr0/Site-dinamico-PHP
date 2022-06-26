<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css" type="text/css">
    <title>Painel de Controle</title>
</head>
<body>
    
    <div class="box-login">
        <?php
               if(isset($_POST['acao'])){
                $user = $_POST['user'];
                $password = $_POST['password'];
                $sql = self::Conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE 'user' = ? AND 'password' = ?");
                $sql->execute(array($user,$password));
                }
                if($sql->rowCount() == 1){
                    //logamos com sucesso
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    header('location');
                }else{
                    
                }
        ?>
    

        <h2>Efetue O Login!</h2>
        <form>
            <input type="text" name="user" placeholder="Login..." required>
            <input type="password" name="password" placeholder="Senha..." required>
            <input type="submit" name="acao" value="Logar!">
        </form>
    </div><!--BOX_LOGIN-->

</body>
</html>