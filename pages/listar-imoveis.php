<?php
	if(isset($_GET['Excluir'])){
		$idExcluir = intval($_GET['Excluir']);
		Painel::deletar('tb_site.imoveis',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-vips');
	}
	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 5;

	$vips = Painel::selectAll('tb_site.imoveis',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2><i class="far fa-address-card"></i> Imóveis Cadastrados !</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td><i class="fas fa-home"></i> Imóvel</td>
			<td><i class="fas fa-money-bill-wave"></i> Valor</td>
			<td><i class="far fa-calendar-check"></i> Data de publicação</td>
			<td></td>
			<td></td>
		</tr>
			<?php
				foreach ($vips as $key => $value){
			?>
		<tr>
			<td><?php echo $value['Nome'];?></td>
			<td><?php echo $value['valor'];?></td>
			<td><?php echo $value['data']; ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-imovel?id=<?php echo $value['id']; ?>"><i class="fas fa-pen"></i></a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-imoveis?Excluir=<?php echo $value['id'];?>"><i class="far fa-times-circle"></i></a></td>
			<?php } ?>
	</table>
</div><!--wraper-table-->

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('tb_site.imoveis')) / $porPagina);

			for ($i = 1; $i <= $totalPaginas ; $i++) { 
				if($i == $paginaAtual)
					echo '<a class="pag-select" href="'.INCLUDE_PATH_PAINEL.'listar-imoveis?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-imoveis?pagina='.$i.'">'.$i.'</a>';
			}
		?>
	</div><!--paginacao-->
</div><!--box-content-->