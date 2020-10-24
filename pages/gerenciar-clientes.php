<div class="box-content">

    <h2><i class="fa fa-if-card-o" aria-hidden="true"> Clientes Cadastrados</i></h2>
    <div class="busca">
        <h4><i class="fas fa-search"></i> Realizar Busca</h4>
        <form method="post">
            <input placeholder="Procure por: nome, email, cpf ou cnpj"type="text" name="busca">  
            <input type="submit" name="acao" value="Buscar">
        </form>
    </div>
    <div class="boxes"> 
        <?php
            $query = "";
            if(isset($_POST['acao'])){
                $busca = $_POST['busca'];
                $query = "WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' OR cpf_cnpj LIKE '%$busca%'";
            }
            $clientes = MySql::conectar()->prepare("SELECT * FROM `tb_admin.clientes`$query ");
            $clientes->execute();
            $clientes = $clientes->fetchAll();
            if(isset($_POST['acao'])){
                echo '<div class="busca-result"><p>Foram encontrados <b>'.count($clientes).'</b> resultados</p></div>';
            }
            foreach($clientes as $value){
        ?>
        <div class="box-single-wraper">
            <div class="box-single">
                <div class="topo-box">
                    <h2><i class="fa fa-user"></i></h2>
                </div>
                <div class="body-box">
                    <p><b><i class="fa fa-info"> Nome cliente:</i></b> <?php echo $value['nome']; ?></p>
                    <p><b><i class="fa fa-info"> Email:</i></b> <?php echo $value['email']; ?></p>
                    <p><b><i class="fa fa-info"> Tipo:</i></b> <?php echo $value['tipo']; ?></p>
                    <p><b><i class="fa fa-info"></i><?php
                        if($value['tipo'] == 'fisico')
                            echo ' CPF: ';
                        else
                            echo ' CNPJ: ';
                    ?></b> <?php echo $value['cpf_cnpj'];  ?></p>
                    <div class="group-btn">
                        <a class="btn edit" href="<?php echo INCLUDE_PATH?>editar-cliente?id=<?php echo $value['id']; ?>"> <i class="fas fa-plus-square"></i> Add pagamento!</a>
                        <a actionBtn="delete" item_id="<?php echo $value['id']; ?>" class="btn delete" href="<?php echo INCLUDE_PATH; ?>"><i class="far fa-times-circle"></i> Excluir</a>
                    </div><!--group-btn-->  
                </div><!--body-box-->
            </div><!--box-single-->
        </div><!--box-single-wraper-->
            <?php } ?>
        <div class="clear"></div>
    </div><!--boxes-->
</div><!--box-content-->