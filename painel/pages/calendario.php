<?php
    $mes = isset($_GET['mes']) ? (int)$_GET['mes'] : date('m',time());
    $ano =  date('Y',time());
    
    if(isset($_GET['diminuirMes'])){
        $mes = $mes-1;
        if($mes == 0){
            $ano = date('Y',strtotime('- 1 year'));
            $mes = 12;
        }

    }

    if($mes > 12)
        $mes = 12;
    if($mes < 1)
        $mes = 1;
    $numeroDias = cal_days_in_month(CAL_GREGORIAN,$mes,$ano);
    $diaInicialDoMes = date('N',strtotime("$ano-$mes-01"));

    $diaAtual = date('d',time());
    $diaAtual = "$ano-$mes-$diaAtual";

    $meses = array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

    $mesAtual = $meses[(int)$mes-1];
    
?>

<div class="box-content editarUsuario listar-depoimentos w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-calendar"></i> Calendário:</h2>
    <p class="title-mesano w100"><a href="<?php echo INCLUDE_PATH_PAINEL; ?>calendario?diminuirMes&mes=<?php echo $mes; ?>?ano=<?php echo $ano; ?>"><i class="fa-solid fa-angles-left"></i></a><b><?php echo $mesAtual; ?></b>/<u><?php echo $ano; ?></u><i class="fa-solid fa-angles-right"></i></p>

    <table class="calendario-table">
        <tr>
            <td>Domingo</td>
            <td>Segunda</td>
            <td>Terça</td>
            <td>Quarta</td>
            <td>Quinta</td>
            <td>Sexta</td>
            <td>Sábado</td>
        </tr>

        <?php
            $n = 1;
            $z = 0;
            $numeroDias+=$diaInicialDoMes;

            while($n <= $numeroDias){
                if($diaInicialDoMes == 7 && $z != $diaInicialDoMes){
                    $z = 7;
                    $n = 8;
                }

                if($n % 7 == 1){
                    echo '<tr>';
                }

                if($z >= $diaInicialDoMes){
                    $dia = $n - $diaInicialDoMes;
                    if($dia < 10){
                        $dia = str_pad($dia, strlen($dia)+1, "0", STR_PAD_LEFT);
                    }
                    $atual = "$ano-$mes-$dia";
                    if($atual != $diaAtual){
                        echo "<td dia=\"$atual\">$dia</td>";
                    }else{
                        echo '<td dia="'.$atual.'" class="day-selected">'.$dia.'</td>';
                    }
                }else{
                    echo "<td></td>";
                    $z++;
                }

                if($n % 7 == 0){
                    echo '</tr>';
                }
                $n++;
            }
        ?>
    </table>


    <form method="POST" style="padding:0 0 40px 0;margin:0;" action="<?php echo INCLUDE_PATH_PAINEL; ?>ajax/calendario.php">
        <div class="card-title w100">Adicionar Tarefa para <?php echo date('d/m/Y',time()); ?></div>
        <div class="form-group">
            <input required type="text" name="tarefa"/>
            <input type="hidden" name="data" value="<?php echo $diaAtual; ?>"/>
            <input type="hidden" name="acao" value="inserir"/>
            <input type="submit" value="Cadastrar!" style="top:25px;"/>
        </div><!--form-group-->
        <div class="form-group">

        </div><!--form-group-->
    </form>

    <div class="box-tarefas w100">
        <div class="card-title w100">Tarefas de <?php echo date('d/m/Y',time()); ?></div>
        <?php
            $pegarTarefas = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.agenda` WHERE data='$diaAtual' ORDER BY id DESC");
            $pegarTarefas->execute();
            $pegarTarefas = $pegarTarefas->fetchAll();
            foreach($pegarTarefas as $key => $value){
        ?>
        <div class="box-tarefas-single">
            <h3><?php echo $value['tarefa']; ?></h3>
        </div><!--box-tarefas-single-->
        <?php } ?>
    </div><!--box-tarefas-->
</div><!--box-content-->