<?php
	if(isset($_COOKIE['lembrar'])){
		$user = $_COOKIE['user'];
		$password = $_COOKIE['password'];
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
		$sql->execute(array($user,$password));
			if($sql->rowCount() ==  1){
				$info = $sql->fetch();
				$_SESSION['login'] = true;
				$_SESSION['user'] = $user;
				$_SESSION['password'] = $password;
				$_SESSION['cargo'] = $info['cargo'];
				$_SESSION['nome'] = $info['nome'];
				$_SESSION['img'] = $info['img'];
				Painel::redirect(INCLUDE_PATH_PAINEL);
			}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Painel de Controle Imobiliaria</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,  initial-scale=1.0">
	<link href="<?php echo INCLUDE_PATH; ?>css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Metal+Mania&family=Open+Sans:wght@600&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet" />
</head>
<body>

	<div class="box-login">
		<?php
			if(isset($_POST['acao'])){
				$user = $_POST['user'];
				$password = $_POST['password'];
				$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
				$sql->execute(array($user,$password));
				if($sql->rowCount() ==  1){
					$info = $sql->fetch();
					//logamos com sucesso
					$_SESSION['login'] = true;
					$_SESSION['user'] = $user;
					$_SESSION['password'] = $password;
					$_SESSION['cargo'] = $info['cargo'];
					$_SESSION['nome'] = $info['nome'];
					$_SESSION['img'] = $info['img'];
					if(isset($_POST['lembrar'])){
						setcookie('lembrar',true,time()+(60*60*24),'/');
						setcookie('user',$user,time()+(60*60*24),'/');
						setcookie('password',$password,time()+(60*60*24),'/');
					}
					Painel::redirect(INCLUDE_PATH_PAINEL);
				}else{
					echo '<div class="erro-box"><i class="fa fa-times"></i>  Usario ou Senha incorretos!</div>';
				}
			}
		?>
		<h2>Sistema Imobiliaria</h2>
		<h2>Efetue Login:</h2>
		<form method="post">
			<input type="text" name="user" placeholder="Login" required>
			<input type="password" name="password" placeholder="Password" required>
			<div class="form-group-login left">
				<input type="submit" name="acao" value="Logar">
			</div>
			<div class="form-group-login right">
				<label>Lembrar-me</label>
				<input type="checkbox" name="lembrar" />
			</div>
			<div class="clear"></div>
		</form>
	</div><!--box-login-->
</body>
</html>