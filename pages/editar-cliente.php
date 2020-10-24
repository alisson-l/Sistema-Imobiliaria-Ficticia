<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$cliente = Painel::select('tb_admin.clientes','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Editar Cliente</h2>

	<form class="ajax" atualizar method="post" action="<?php echo INCLUDE_PATH_PAINEL; ?>ajax/forms.php" enctype="multipart/form-data">
                <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" />
                </div><!--form-group-->
                <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $cliente['email']; ?>" />
                </div><!--form-group-->
                <div class="form-group">
                        <label>Tipo:</label>
                        <select name="tipo_cliente">
                                <option <?php if($cliente['tipo'] == 'fisico') echo 'selected'; ?> value="fisico">Físico</option>
                                <option <?php if($cliente['tipo'] == 'juridico') echo 'selected'; ?>value="juridico">Jurídico</option>
                        </select>
                </div><!--form-group-->
                <?php
                        if($cliente['tipo'] == 'fisico'){
                ?>
                <div ref="CPF" class="form-group">
                        <label>CPF</label>
                        <input type="text" name="CPF" value="<?php echo $cliente['cpf_cnpj']; ?>" />
                </div><!--form-group-->
                <div style="display: none;" ref="CNPJ" class="form-group">
                        <label>CNPJ</label>
                        <input type="text" name="CNPJ" />
                </div><!--form-group-->

                 <?php }else{  ?>

                <div style="display: none;" ref="CPF" class="form-group">
                        <label>CPF</label>
                        <input type="text" name="CPF"  />
                </div><!--form-group-->
                <div style="display: block;" ref="CNPJ" class="form-group">
                        <label>CNPJ</label>
                        <input type="text" name="CNPJ" value="<?php echo $cliente['cpf_cnpj']; ?>" />
                </div><!--form-group-->

                <?php }?>

                <div class="form-group">
                        <input type="hidden" name="tipo_acao" value="atualizar_cliente">
                </div><!--form-group-->
                <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
                </div><!--form-group-->
                <div class="form-group">
                <input type="submit" name="acao" value="Atualizar!">
                </div><!--form-group-->
        </form>
        
        <h2><i class="fas fa-pencil-alt"></i> Adicionar Pagamentos</h2>

        <?php

                if(isset($_POST['acao'])){
                        $cliente_id = $id;
                        $nome = $_POST['nome_pagamento'];
                        $valor = str_replace('.','',$_POST['valor']);
                        $valor = str_replace(',','.',$valor);
                        $valor = $_POST['valor'];
                        $intervalo = $_POST['intervalo'];
                        $status = 0;
                        $vencimentoOriginal = $_POST['vencimento'];

                        if(strtotime($vencimentoOriginal) < time() ){
                                Painel::alert('erro','Você selecionou uma data negativa!');
                        }else{ 
                                
                                $vencimento = strtotime($vencimentoOriginal) + (($intervalo)*(60*60*24));
                                $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.financeiro` VALUES (null,?,?,?,?,?)");
                                $sql->execute(array($cliente_id,$nome,$valor,date('Y-m-d',$vencimento),0));
                                
                        Painel::alert('sucesso','Pagamento inserido com sucesso!');
                        }
                }
 
        ?>

        <form method="post">
                <div class="form-group">
                        <label>Nome Pagamento: </label>
                        <input type="text" name="nome_pagamento"/>
                </div><!--form-group-->
                <div class="form-group">
                        <label>Valor do Pagamento: </label>
                        <input type="text" name="valor"/>
                </div><!--form-group-->
                <div class="form-group">
                        <label>Número de Parcelas: </label>
                        <input type="text" name="parcelas"/>
                </div><!--form-group-->
                <div class="form-group">
                        <label>Intervalo: </label>
                        <input type="text" name="intervalo"/>
                </div><!--form-group-->
                <div class="form-group">
                        <label>Vencimento: </label>
                        <input type="text" name="vencimento"/>
                </div><!--form-group-->
                <div class="form-group">
                        <input type="submit" name="acao" value="Inserir Pagamento">
                </div><!--form-group-->
        </form>




</div><!--box-content-->