<?php
    verificarPermissaoPagina(2);
?>


<div class="box-content editarUsuario w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-user-plus"></i>  Adicionar Usuário</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                $usuario = new Usuario();
                $login = $_POST['login'];
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
               // $tamanho = intval($imagem['size']/1024);
                $cargo = $_POST['cargo'];
                
               
                

                //verificação de inputs
                if($login == ''){
                    Painel::alert('erro','o login está vázio');
                }else if($nome == ''){
                    Painel::alert('erro','O nome está vázio');
                }
                else if($senha == ''){
                    Painel::alert('erro','A senha está vázia');
                }else if($cargo == ''){
                    Painel::alert('erro','O cargo precisa estar selecionado');
                }else if($imagem['name'] == '' ){
                    Painel::alert('erro','A imagem precisa estar selecionada');
                }else if(PAINEL::imagemValida($imagem) == false){
                    Painel::alert('erro','O formato de imagem não é suportado!111');
                }else{
                    //Apenas cadastrar no banco de dados!
                   if(Usuario::userExists($login)){
                    Painel::alert('erro','O login ja existe,Selecione outro por favor!');
                   }else{
                    $usuario = new Usuario();
                    $imagem = PAINEL::uploadFile($imagem);
                    $usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
                    PAINEL::alert('sucesso','O cadastro do usuário '.$login.' foi feito com sucesso!');
                   }
                }


            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-right-to-bracket"></i> Login:</label>
            <input type="text" name="login" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome:</label>
            <input type="text" name="nome" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-key"></i> Senha:</label>
            <input type="password" name="password" />
        </div><!--form-group-->

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem</label>
            <input type="file" name="imagem"/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-certificate"></i> Cargo:</label>
            <select name="cargo">
                <?php
                    foreach(Painel::$cargos as $key => $value) {
                        if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Adicionar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->