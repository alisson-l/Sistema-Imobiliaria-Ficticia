<?php
	verificaPermissaoPagina(0);	
?>
<div class="box-content">
	<h2><i class="fa fa-pen"></i>  Adicionar Usuário</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				$login = $_POST['login'];
				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$cargo = $_POST['cargo'];

				if($login == ''){
					Painel::alert('erro','Login está vázio!');
				}else if($nome == ''){
					Painel::alert('erro','Nome está vázio!');
				}else if($senha == ''){
					Painel::alert('erro','Senha está vázia!');
				}else if($imagem['name'] == ''){
					Painel::alert('erro','Escolha uma foto de perfil!');
				}else if($cargo == ''){
					Painel::alert('erro','Selecione o cargo!');
				}else{
					if($cargo >= $_SESSION['cargo']){
						Painel::alert('erro','Voce precisa selecionar um cargo menor que o seu!');
					}else if(Painel::imagemValida($imagem) == false){
						Painel::alert('erro','Formato da imagem incorreto!');
					}else if(Usuario::userExists($login)){
						Painel::alert('erro','Ja existe usuario com esse nome!');
					}else{
						//apenas cadastrar no banco!
						$usuario = new Usuario();
						$imagem =  Painel::uploadFile($imagem);
						$usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
						Painel::alert('sucesso','Usuario '.$login.' cadastrado com sucesso!');
					}
				}				
			}
		?><div class="form-group">
				<label>Login:</label>
				<input type="text" name="login" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Nome:</label>
				<input type="text" name="nome" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Senha:</label>
				<input type="password" name="password" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Cargo:</label>
				<select name="cargo">
					<?php 
					foreach (Painel::$cargos as $key => $value) {
						if($key > 0 && $key < 4) echo '<option value="'.$key.'">'.$value.'</option>';				
					}			
					?>
				</select>
		</div><!--form-group-->
		<div class="form-group">
				<label>Imagem:</label>
				<input type="file" name="imagem"  />
		</div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Adicionar!">
		</div><!--form-group-->
	</form>
</div><!--box-content-->