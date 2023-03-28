<?php 
   
    
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $cliente = Painel::select('tb_admin.clientes','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.','top:50px;');
        die();
    }
?>

<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-user-pen"></i>  Editar Cliente</h2>

    <form class="ajax" atualizar action="<?php echo INCLUDE_PATH_PAINEL; ?>ajax/forms.php" method="POST" enctype="multipart/form-data">
         <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome:</label>
            <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-key"></i> E-Mail</label>
            <input type="text" name="email" value="<?php echo $cliente['email']; ?>" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-certificate"></i> Tipo:</label>
            <select name="tipo_cliente">
                <option <?php if($cliente['tipo'] == 'fisico') echo 'selected'; ?> value="fisico">Fisico</option>
                <option <?php if($cliente['tipo'] == 'juridico') echo 'selected'; ?> value="juridico">Jurídico</option>
            </select>
        </div><!--form-group-->

        <?php if($cliente['tipo'] == 'fisico'){ ?>
            <div style="display:block;" ref="cpf" class="form-group">
                <label>CPF</label>
                <input type="text" name="cpf" value="<?php echo $cliente['cpf_cnpj']; ?>" />
            </div><!--form-group-->
            <div style="display:none;" ref="cnpj" class="form-group">
                <label>CNPJ</label>
                <input type="text" name="cnpj" />
            </div><!--form-group-->
        <?php }else{ ?>
            <div style="display:none;" ref="cpf" class="form-group">
                <label>CPF</label>
                <input type="text" name="cpf" />
            </div><!--form-group-->
            <div style="display:block;" ref="cnpj" class="form-group">
                <label>CNPJ</label>
                <input type="text" name="cnpj" value="<?php echo $cliente['cpf_cnpj']; ?>"/>
            </div><!--form-group-->

        <?php } ?>

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem</label>
            <input type="file" name="imagem"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="imagem_original" value="<?php echo $cliente['imagem']; ?>"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="tipo_acao" value="editar_cliente"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!"/>
        </div><!--form-group-->
    </form>
</div><!--box-content-->

<div class="box-content w100 editarUsuario">
    <h2 class="w100" ><i class="fa-solid fa-sack-dollar"></i>  Vincular Pagamentos</h2>
    <form method="post">
        <?php
            date_default_timezone_set('America/Sao_Paulo');

            if(isset($_POST['acao_financeiro'])){
                $dataPagto = '-';
                $cliente_id = $id;
                $nome = $_POST['nome_pagto'];
                $valor = str_replace('.','',$_POST['valor']);
                $valor = str_replace(',','.',$valor);
                //$valor = $_POST['valor'];
                $vencimentoOriginal = $_POST['vencimento'];
                $numero_parcelas = $_POST['parcelas'];
                $intervalo = $_POST['intervalo'];
                $status = 0;
                $interva = (60*60*24*$intervalo);
                $valor = floatval($valor)/$numero_parcelas;
                $valor = number_format($valor,2,'.','');
                
                if(strtotime($vencimentoOriginal) < time()){
                    Painel::alert('erro','erro, Você selecionou uma data negativa!');
                }else{
                    for($i=0;$i < $numero_parcelas;$i++){
                        $vencimento = strtotime($vencimentoOriginal)+$interva*$i;
                        $data = date('Y-m-d',$vencimento);
                    
                        $sql = Mysql::conectar()->prepare("INSERT INTO `tb_admin.financeiro` VALUES (null,?,?,?,?,?,?)");
                        $sql->execute(array($dataPagto,$cliente_id,$nome,$valor,$data,$status));
                    }

                    Painel::alert('sucesso','O(s) pagamento(s) foi inserido com sucesso!');
                }
            }

            if(isset($_GET['pago'])){
                $sql = Mysql::Conectar()->prepare("UPDATE `tb_admin.financeiro` SET `status` = 1 ,`data_pagamento` = NOW() WHERE id=?");
                $sql->execute(array($_GET['pago']));
                Painel::alert('sucesso','O pagamento foi Quitato com sucesso!');  
                echo '<script>window.history.pushState({}, document.title, "?" + "id='.$id.'");</script>';
            }
        ?>

        <div class="form-group">
            <label>Nome do pagamento:</label>
            <input type="text" name="nome_pagto" />
        </div><!--form-group-->

        <div class="form-group">
            <label>Valor do pagamento:</label>
            <input type="text" name="valor" />
        </div><!--form-group-->

        <div class="form-group">
            <label>Números de Parcelas:</label>
            <input type="text" name="parcelas" />
        </div><!--form-group-->

        <div class="form-group">
            <label>Intervalo:</label>
            <input type="text" name="intervalo" />
        </div><!--form-group-->

        <div class="form-group">
            <label>Vencimento:</label>
            <input type="text" name="vencimento" style="width:160px;padding-right:10px;" />
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao_financeiro" value="Inserir Pagamento"/>
        </div><!--form-group-->
    </form>
</div>

<div class="box-content w100 editarUsuario listar-depoimentos">
    <h2 class="w100" ><i class="fa-brands fa-creative-commons-nc"></i> Pagamentos Pendentes</h2>

    <div  class="w100 wraper">
        <table>
            <tr>
                <td>Nome do pagamento</td>
                <td>Cliente</td>
                <td>Valor</td>
                <td>Vencimento</td>
                <td>Marcar como pago</td>
            </tr>   
            
            <?php
                $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE `status`=0 AND `cliente_id` = $id ORDER BY vencimento ASC");
                $sql->execute();
                $pendentes = $sql->fetchAll();

                foreach($pendentes as $key => $value){
                    $clienteNome = Mysql::Conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
                    $clienteNome->execute();
                    $clienteNome = $clienteNome->fetch()['nome'];
                    $style = '';
                    if(strtotime(date('Y-m-d')) >= strtotime($value['vencimento'])){
                        $style = 'style="background-color:#f38d8d;font-weight:bold;"';
                    }

            ?>

            <tr <?php echo $style; ?> >
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo $clienteNome; ?></td>
                <td>R$<?php echo Painel::convertMoney((float)$value['valor']); ?></td>
                <td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
                <td><a class="btn pago" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-cliente?id=<?php echo $id ?>&pago=<?php echo $value['id']; ?>"><i class="fa-solid fa-circle-check"></i> Pago</a></td>
            </tr>   

            <?php } ?>

        </table>
    </div><!--wraper-->
</div>

<div class="box-content w100 editarUsuario listar-depoimentos">
    <h2 class="w100" ><i class="fa-solid fa-money-check-dollar"></i> Pagamentos Concluidos</h2>
    <div  class="w100 wraper">
        <table>
            <tr>
                <td>Nome do pagamento</td>
                <td>Cliente</td>
                <td>Valor</td>
                <td>Vencimento</td>
                <td>Data de Pagamento</td>
            </tr>        

            <?php
                $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE `status`=1 AND `cliente_id` = $id ORDER BY `data_pagamento` DESC");
                $sql->execute();
                $pendentes = $sql->fetchAll();

                foreach($pendentes as $key => $value){
                    $clienteNome = Mysql::Conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
                    $clienteNome->execute();
                    $clienteNome = $clienteNome->fetch()['nome'];
            ?>

            <tr style="background-color:rgba(173, 238, 208, 0.933);font-weight:550;">
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo $clienteNome; ?></td>
                <td>R$<?php echo Painel::convertMoney((float)$value['valor']); ?></td>
                <td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
                <td><?php echo date('d/m/Y -- H:i',strtotime($value['data_pagamento'])); ?></td>
            </tr>   

            <?php } ?>
        </table>
    </div><!--wraper-->
</div>