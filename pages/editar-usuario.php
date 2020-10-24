<div class="box-content">
	<h2><i class="fa fa-pen"></i>  Editar Usuario</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				//enviei o formulario.
				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem-atual'];
				$usuario = new Usuario();

				if($imagem['name'] != ''){;
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						if($usuario->atualizarUsuario($nome,$senha,$imagem)){
							$_SESSION['img']= $imagem;
							Painel::alert('sucesso','Atualizado com sucesso junto com img!');
						}else{
							Painel::alert('erro','OPS! Algo esta errado JUNTO COM IMG!');
						}
					}else{
						Painel::alert('erro','O formato da imagem não e válido!');
					}
				}else{
					$imagem = $imagem_atual;
					if($usuario->atualizarUsuario($nome,$senha,$imagem)){
						Painel::alert('sucesso','Atualizado com sucesso!');
					}else{
						Painel::alert('erro','OPS! Algo esta errado!');
					}
				}
			}
		?>
		<div class="form-group">
				<label>Nome:</label>
				<input type="text" name="nome" required  value="<?php echo $_SESSION['nome']; ?>" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Senha:</label>
				<input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>" />
		</div><!--form-group-->
		<div class="form-group">
				<label>Imagem:</label>
				<input type="file" name="imagem" />
				<input type="hidden" name="imagem-atual" value="<?php echo $_SESSION['img'] ?>">
		</div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->
	</form>
</div><!--box-content-->