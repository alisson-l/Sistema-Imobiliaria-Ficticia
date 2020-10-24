<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Painel</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,  initial-scale=1.0">
	<link href="<?php echo INCLUDE_PATH; ?>css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Metal+Mania&family=Open+Sans:wght@600&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">
</head>
<body>
<base base="<?php echo INCLUDE_PATH_PAINEL ?>" />
<div class="side-menu">
	<div class="menu-wraper">
	<div class="box-usuario">
		<?php 
			if($_SESSION['img'] == ''){

		?>
		<div class="avatar-usuario">
			<i class="fa fa-user"></i>			
		</div><!--avatar-usuario-->
	<?php }else{   ?>
		<div class="imagem-usuario">
			<img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img']; ?>" />			
		</div><!--avatar-usuario-->
	<?php } ?>
		<div class="nome-usuario">
			<p><?php echo $_SESSION['nome']?></p>
			<p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
		</div><!--nome-usuario-->
	</div><!--box-usuario-->
	<div class="itens-menu">
		<h2>Administrativo</h2>
		<a <?php selecionadoMenu('visao-geral'); ?><?php verificaPermissaoMenu(4);?>href="<?php echo INCLUDE_PATH_PAINEL ?>visao-geral">Visão geral</a>
		<a <?php selecionadoMenu('cadastrar-imovel'); ?><?php verificaPermissaoMenu(1);?>href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-imovel">Cadastrar Imóvel</a>
		<a <?php selecionadoMenu('adicionar-usuario'); ?><?php verificaPermissaoMenu(1);?>href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario">Adicionar Usuarios</a>
		<a <?php selecionadoMenu('listar-imoveis'); ?><?php verificaPermissaoMenu(1);?>href="<?php echo INCLUDE_PATH_PAINEL ?>listar-imoveis">Listar Imóveis</a>
		<h2>Comercial</h2>
		<a <?php selecionadoMenu('listar-imoveis'); ?><?php verificaPermissaoMenu(2);?>href="<?php echo INCLUDE_PATH_PAINEL ?>listar-imoveis">Listar Imóveis</a>
		<a <?php selecionadoMenu('cadastrar-clientes'); ?><?php verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-clientes">Cadastrar Clientes</a>
		<a <?php selecionadoMenu('gerenciar-clientes'); ?><?php verificaPermissaoMenu(2);?>href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-clientes">Gerenciar/Adionar Pagamentos</a>
		<h2>Financeiro</h2>
		<a <?php selecionadoMenu('visualizar-compras'); ?><?php verificaPermissaoMenu(3);?>href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-compras">Aprovar Pagamentos</a>
		
		<h2>Configurações do perfil</h2>
		<a <?php selecionadoMenu('editar-usuario'); ?>href="<?php echo INCLUDE_PATH_PAINEL?>editar-usuario">Editar Usuario</a>
	</div><!--itens-menu-->
</div><!--menu-wraper-->
</div><!--side-menu-->
	<header>
		<div class="center">
			<div class="menu-btn">
				<i class="fas fa-bars"></i>
				<a <?php if(@$_GET['url'] == ''){?>style="background: #00695c; padding: 10px 15px;"<?php } ?>href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fas fa-home"></i> <span>Home</span></a>
			</div><!--menu-btn-->
			<div class="loggout">
				<a href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a>
				</div><!--loggout-->
			<div class="clear"></div>
	</div><!--center-->
</header>
<div class="content">
	<?php Painel::carregarPagina(); ?>
</div><!--content-->
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.maskMoney.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.mask.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.ajaxform.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/main.js"></script>+
	<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/HelperMask.js"></script>
	<?php Painel::loadJS(array('ajax.js'),'gerenciar-clientes')?>
	<?php Painel::loadJS(array('ajax.js'),'cadastrar-clientes')?>
	<?php Painel::loadJS(array('ajax.js'),'editar-cliente')?>
	<?php Painel::loadJS(array('controleFinanceiro.js'),'editar-cliente')?>
</body>
</html>