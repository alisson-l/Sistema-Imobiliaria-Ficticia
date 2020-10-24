<div class="box-content 100">
<h2><i class="fas fa-globe-asia"></i> Usuarios do Painel</h2>
	<div class="table-responsive">
		<div class="row">
			<div class="col">
				<span>Nome</span>
			</div><!--col-->
			<div class="col">
				<span>Cargo</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
		<?php
			$usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` ");
			$usuariosPainel->execute();
			$usuariosPainel = $usuariosPainel->fetchAll();
			foreach($usuariosPainel as $key => $value){
		?>
		<div class="row">
			<div class="col">
				<span><?php echo $value['user'] ?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo pegaCargo($value['cargo']);?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
	<?php } ?>
	</div><!--table-responsive-->
</div><!--box-content-->
<div class="clear"></div>