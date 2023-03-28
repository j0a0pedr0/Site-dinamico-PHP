<div class="box-content w100 editarUsuario listar-depoimentos">    
    <?php
        
        if(isset($_GET['email'])){
            //queremos enviar um email avisando o atraso!
            $parcela_id = (int)$_GET['parcela'];
            $cliente_id = (int)$_GET['email'];
            if(isset($_COOKIE['cliente_'.$cliente_id])){
                Painel::alert('erro','Você já enviou um email com o aviso da parcela para esse cliente! Aguarde 6 horas para Enviar Novamente','margin-top:150px;');

            }else{
                //Podemos enviar o email
                $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE id = $parcela_id");
                $sql->execute();
                $infoFinanceiro = $sql->fetch();

                $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.clientes` WHERE id = $cliente_id");
                $sql->execute();
                $infoCliente = $sql->fetch();

                $corpoEmail = "Olá $infoCliente[nome], Entramos em contato pra avisar que tem um débito conosco de R$$infoFinanceiro[valor] para vencimento no dia $infoFinanceiro[vencimento], Por favor entre em contato para pagar!";
                $email = new Email('smtp.hostinger.com','joaopedroexemplo@cursospoderfeminino.com','Jaca1000$','Joao');
                $email->addAddress($infoCliente['email'],$infoCliente['nome']);
                $email->formatarEmail(array('assunto'=>'cobrança','corpo'=>$corpoEmail));
                $email->enviarEmail();


                setcookie('cliente_'.$cliente_id,'true',time()+(60*60*6),'/');
                Painel::alert('sucesso','O E-Mail foi enviado com sucesso!(--AGUARDE 6 Hrs para Enviar novamente!--)','margin-top:150px;');
            } 
        }

    ?>

    <h2 class="w100" ><i class="fa-brands fa-creative-commons-nc"></i> Pagamentos Pendentes</h2>
    <div class="gerar-pdf">
        <a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL; ?>gerar-pdf.php?pagamento=pendentes">Gerar PDF</a>
    </div><!--GERAR_PDF-->

    <div  class="w100 wraper">
        <table>
            <tr>
                <td>Nome do pagamento</td>
                <td>Cliente</td>
                <td>Valor</td>
                <td>Vencimento</td>
                <td>E-mail</td>
                <td>Quitar Parcela</td>
            </tr>   
            
            <?php
                if(isset($_GET['pago'])){
                    $sql = Mysql::Conectar()->prepare("UPDATE `tb_admin.financeiro` SET `status` = 1 ,`data_pagamento` = NOW() WHERE id=?");
                    $sql->execute(array($_GET['pago']));
                    Painel::alert('sucesso','O pagamento foi Quitato com sucesso!','margin-top:150px;');  
                }

                $paginaAtual = isset($_GET['pagina_pendente']) ? (int)$_GET['pagina_pendente'] : 1;
                $porPagina = 10;
                $start = (($paginaAtual - 1) * $porPagina);
                $end = $porPagina;

                $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE `status`=0 ORDER BY vencimento ASC LIMIT $start,$end");
                $sql->execute();
                $pendentes = $sql->fetchAll();

                foreach($pendentes as $key => $value){
                    $infoCliente = Mysql::Conectar()->prepare("SELECT `nome`,`id` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
                    $infoCliente->execute();
                    $infoCliente = $infoCliente->fetch();
                    $clienteNome = $infoCliente['nome'];
                    $clienteId = $infoCliente['id'];
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
                <td><a class="btn contato" href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-pagamentos?email=<?php echo $clienteId ?>&parcela=<?php echo $value['id']; ?>"><i class="fa-solid fa-paper-plane"></i> E-mail</a></td>
                <td><a class="btn pago" href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-pagamentos?pago=<?php echo $value['id']; ?>"><i class="fa-solid fa-circle-check"></i> Pago</a></td>
            </tr>   

            <?php } ?>
        </table>
    </div><!--wraper-->

    <div class="paginacao">
        <?php 

            $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE `status` = 0 ORDER BY `data_pagamento` DESC");
            $sql->execute();
            $paginacao = $sql->fetchAll();

            $totalPaginas = ceil(count($paginacao) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected-2" href="'.INCLUDE_PATH_PAINEL.'visualizar-pagamentos?pagina_pendente='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'visualizar-pagamentos?pagina_pendente='.$i.'">'.$i.'</a>';
                }
                
            }

        ?>
    </div><!--paginacao-->


</div>

<div class="box-content w100 editarUsuario listar-depoimentos">
    <h2 class="w100" ><i class="fa-solid fa-money-check-dollar"></i> Pagamentos Concluidos</h2>

    <div class="gerar-pdf">
        <a target="_black" href="<?php echo INCLUDE_PATH_PAINEL; ?>gerar-pdf.php?pagamento=concluidos">Gerar PDF</a>
    </div><!--GERAR_PDF-->

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
                $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $porPagina = 10;
                $start = (($paginaAtual - 1) * $porPagina);
                $end = $porPagina;
                $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE `status`=1 ORDER BY `data_pagamento` DESC LIMIT $start,$end");
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

    <div class="paginacao">
        <?php 

            $sql = Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE `status` = 1 ORDER BY `data_pagamento` DESC");
            $sql->execute();
            $paginacao = $sql->fetchAll();

            $totalPaginas = ceil(count($paginacao) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'visualizar-pagamentos?pagina='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'visualizar-pagamentos?pagina='.$i.'">'.$i.'</a>';
                }
                
            }

        ?>
    </div><!--paginacao-->
</div>