<div class="box-content">
    <h2><i class="fas fa-id-card"></i> Pagamentos Pendentes/Negados</h2>

    <div class="wraper-table">
            <table>
                <tr>
                        <td><i class="fas fa-file-signature"></i> Nome do Pagamento</td>
                        <td><i class="fas fa-address-card"></i> Cliente</td>
                        <td><i class="fas fa-money-check-alt"></i> Valor</td>
                        <td><i class="fas fa-calendar-alt"></i> Vencimento</td>
                        <td>Aprovar Pagamento</td>

                </tr>

                <?php 
                    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 0 ORDER BY vencimento ASC");
                    $sql->execute();
                    $pendentes =  $sql->fetchAll();

                    if(isset($_GET['pago'])){
                        $sql = MySql::conectar()->prepare("UPDATE `tb_admin.financeiro` SET status = 1 WHERE id = ?");
                        $sql->execute(array($_GET['pago']));
                        Painel::alert('sucesso','Venda aprovada com sucesso!');
                        Painel::redirect(INCLUDE_PATH.'visualizar-compras');

                    }
                    foreach($pendentes as $key => $value){
                        $clienteNome = MySql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id] ");
                        $clienteNome->execute();
                        $clienteNome =  $clienteNome->fetch()['nome'];
                ?>
                <tr>
                        <td><?php echo $value['nome']; ?></td>
                        <td><?php echo $clienteNome;  ?></td>
                        <td><?php echo $value['valor']; ?></td>
                        <td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
                        <td><a class="btn edit" href="<?php echo INCLUDE_PATH;?>visualizar-compras?pago=<?php echo $value['id']; ?>"><i class="fas fa-check"></i> Aprovar</a></td>
                </tr>
                <?php } ?>
                </table>


            </table>
    </div><!--wraper-table-->   

    <h2><i class="fas fa-id-card"></i> Pagamentos Aprovados</h2>

    <div class="wraper-table">
            <table>
                <tr>
                        <td>Nome do Pagamento</td>
                        <td>Cliente</td>
                        <td>Valor</td>
                        <td>Vencimento</td>

                </tr>

                <?php 
                    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 1 ORDER BY vencimento DESC");
                    $sql->execute();
                    $pendentes =  $sql->fetchAll();
                    foreach($pendentes as $key => $value){
                        $clienteNome = MySql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id] ");
                        $clienteNome->execute();
                        $clienteNome =  $clienteNome->fetch()['nome'];
                ?>
                <tr>
                        <td><?php echo $value['nome']; ?></td>
                        <td><?php echo $clienteNome;  ?></td>
                        <td><?php echo $value['valor']; ?></td>
                        <td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
    
                </tr>
                <?php } ?>
                    </tr>
            </table>
    </div><!--wraper-table-->  
</div><!--box-content-->