<?php
    verificarPermissaoPagina(2);
?>


<div class="box-content editarUsuario w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-user-plus"></i>  Cadastrar Clientes</h2>

    <form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL; ?>ajax/forms.php" method="POST" enctype="multipart/form-data">

        
        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome:</label>
            <input type="text" name="nome" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-key"></i> E-Mail</label>
            <input type="text" name="email" />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-certificate"></i> Tipo:</label>
            <select name="tipo_cliente">
                <option value="fisico">Fisico</option>
                <option value="juridico">Jurídico</option>
            </select>
        </div><!--form-group-->

        <div ref="cpf" class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" />
        </div><!--form-group-->

        <div style="display:none;" ref="cnpj" class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" />
        </div><!--form-group-->

        <div style="border:1px solid #0277bd;padding:7px" class="form-group">
            <label><i class="fa-solid fa-file-pen"></i> Imagem</label>
            <input type="file" name="imagem"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="tipo_acao" value="cadastrar_cliente">
        </div><!--form-group-->

        <div class="form-group">
            <input type="reset" value="Reset" style="display:none;"/>
            <input type="submit" name="acao" value="Adicionar!"/> 
        </div><!--form-group-->
    </form>
</div><!--box-content-->