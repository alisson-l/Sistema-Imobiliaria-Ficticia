<div class="box-content">
	<h2><i class="fa fa-pen"></i>  Cadastrar Imóveis</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				if(Painel::insert($_POST)){
					Painel::alert('sucesso','Imóvel cadastrado com sucesso !');
				}else{
					Painel::alert('erro','Campos vázios não são permitidos !');
				}
			}
		?>
		<div class="form-group">
				<label>Nome do Imóvel</label>
				<input type="text" name="nome" placeholder="Nome do Imóvel" />
		</div><!--form-group-->
		<div class="form-group">
			<label>Valor do Imóvel</label>
				<input type="text" name="valorImovel"  />
		</div><!--form-group-->
		<div class="form-group">
				<label>Data de Publicação</label>
				<input formato="data" type="text" name="data" placeholder="DD/MM/AAAA"/>			
		</div><!--form-group-->


		<div class="form-group">
			<input type="hidden" name="nome_tabela" value="tb_site.imoveis">
			<input type="submit" name="acao" value="Adicionar!">
		</div><!--form-group-->
	</form>
</div><!--box-content-->