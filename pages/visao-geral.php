<?php
    verificaPermissaoPagina(2);
?>
<div class="box-content  w100">
		<h2><i class="fas fa-wrench"></i> Visão Geral - <?php echo NOME_EMPRESA; ?></h2>
            <?php
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.clientes`");
                $sql->execute();
                $resultClientes = $sql->rowCount();
            ?>
		<div class="box-metrica-single">
			<div class="box-metrica-wraper">
				<h2>Clientes Cadastrados</h2>
				<p><?php echo $resultClientes;  ?></p>
			</div><!--box-metrica-wraper-->
        </div><!--box-metrica-single-->
            <?php
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.imoveis`");
                $sql->execute();
                $resultImoveis = $sql->rowCount();
            ?>
		<div class="box-metrica-single">
			<div class="box-metrica-wraper">
				<h2>Imóveis Cadastrados</h2>
				<p><?php echo $resultImoveis;  ?></p>
			</div><!--box-metrica-wraper-->
		</div><!--box-metrica-single-->
		<div class="box-metrica-single">
			<div class="box-metrica-wraper">
			<?php
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 1");
                $sql->execute();
                $resultCompras = $sql->rowCount();
            ?>
				<h2>Clientes que compraram</h2>
				<p><?php echo $resultCompras; ?></p>
			</div><!--box-metrica-wraper-->
		</div><!--box-metrica-single-->
		<div class="box-metrica-single">
			<?php
				$sql = MySql::conectar()->prepare("SELECT SUM(valor)  AS soma FROM `tb_admin.financeiro` WHERE status = 1");
                $sql->execute();
				$faturamento = $sql->fetch();
				$soma = $faturamento['soma'];
            ?>
			<div class="box-metrica-wraper">
				<h2>Faturamento total da empresa</h2>
				
				<p>R$ <?php echo $soma; ?></p>
			
			</div><!--box-metrica-wraper-->
		</div><!--box-metrica-single-->
		<div class="clear"></div>
</div><!--box-content-->