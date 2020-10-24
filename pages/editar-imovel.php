<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$imv = Painel::select('tb_site.imoveis','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID!');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fa fa-pen"></i>  Editar Imóveis</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				if(Painel::update($_POST)){
					Painel::alert('sucesso','Imóvel atualizado com sucesso !');
					$imv = Painel::select('tb_site.imoveis','id = ?',array($id));
				}else{
					Painel::alert('erro','OPS! Algo está errado !');
				}
			}
		?>
		<div class="form-group">
				<label>Imóvel</label>
				<input type="text" name="nome" placeholder="Nome: "  value="<?php echo $imv['Nome'];?>" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Valor</label>
				<input type="text" name="valor" placeholder="100.000" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Data</label>
				<input formato="data" type="text" name="data" value="<?php echo $imv['data'];?>" />			
		</div><!--form-group-->


		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="tb_site.imoveis">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->
	</form>
</div><!--box-content-->