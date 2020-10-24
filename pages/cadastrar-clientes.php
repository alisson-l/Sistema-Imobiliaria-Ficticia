<?php 

 verificaPermissaoPagina(1);

?>
<div class="box-content">
	<h2><i class="fa fa-pen"></i>  Cadastrar Clientes</h2>
	<form class="ajax"  action="<?php echo INCLUDE_PATH_PAINEL; ?>ajax/forms.php" method="post" enctype="multipart/form-data">

		<div class="form-group">
				<label>Nome</label>
				<input type="text" name="nome" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Tipo:</label>
				<select name="tipo_cliente">
					<option value="fisico">Físico</option>
					<option value="juridico">Jurídico</option>
				</select>
		</div><!--form-group-->
		<div ref="CPF" class="form-group">
				<label>CPF</label>
				<input type="text" name="CPF" />
		</div><!--form-group-->
		<div style="display: none;" ref="CNPJ" class="form-group">
				<label>CNPJ</label>
				<input type="text" name="CNPJ" />
		</div><!--form-group-->
		<div class="form-group">
                <input type="hidden" name="tipo_acao" value="cadastrar_cliente">
            </div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Adicionar!">
		</div><!--form-group-->
	</form>
</div><!--box-content-->