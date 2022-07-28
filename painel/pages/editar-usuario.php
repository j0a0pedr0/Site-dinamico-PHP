<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-user-pen"></i>  Editar Usuário</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                
                $usuario = new Usuario();
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];

                if($imagem['name'] != ''){
                    //Existe um upload de imagens
                    if(PAINEL::imagemValida($imagem)){
                        PAINEL::deleteFile($imagem_atual);
                        $imagem = PAINEL::uploadFile($imagem);
                        if($usuario->atualizarUsuario($nome,$senha,$imagem)){
                            Painel::alert('sucesso','Atualizado com sucesso junto com a imagem');
                            $_SESSION['img'] = $imagem;
                            $_SESSION['nome'] = $nome;
                            $SESSION['password'] = $senha;
                            header('Refresh:3');
                        }else{
                            Painel::alert('erro','Ocorreu un erro ao atualizar junto com a imagem');
                        }
                    }else{
                        Painel::alert('erro','O formato de imagem não é válido');
                    }
                }else{
                    $imagem = $imagem_atual;
                    if($usuario->atualizarUsuario($nome,$senha,$imagem)){
                        Painel::alert('sucesso','Atualizado com sucesso');
                        $_SESSION['img'] = $imagem;
                        $_SESSION['nome'] = $nome;
                        $SESSION['password'] = $senha;
                    }else{
                        Painel::alert('erro','Ocorreu un erro ao atualizar');
                    }
                }
                
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome:</label>
            <input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>" required/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-key"></i> Senha:</label>
            <input type="password" name="password" value="<?php echo$_SESSION['password'] ?>" required/>
        </div><!--form-group-->

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem</label>
            <input type="file" name="imagem" />
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->