<?php

	class Painel
	{
		public static $cargos = [
		'0' => 'normal',
		'1' => 'Administração',
		'2' => 'Comercial',
		'3' => 'Financeiro',
		'4' => 'CEO'];

		public static function loadJS($files,$page){
			$url = explode('/',$_GET['url'])[0];
			if($page == $url){
				foreach ($files as $key => $value){
					echo '<script src="'.INCLUDE_PATH_PAINEL.'js/'.$value.'"></script>';
				}
			}
		}

		public static function generateSlug($str){
			$str = mb_strtolower($str);
			$str = preg_replace('/(â|á|ã)/', 'a', $str);
			$str = preg_replace('/(ê|é)/', 'e', $str);
			$str = preg_replace('/(í|Í)/', 'i', $str);
			$str = preg_replace('/(ú)/', 'u', $str);
			$str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
			$str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
			$str = preg_replace('/( )/', '-',$str);
			$str = preg_replace('/ç/','c',$str);
			$str = preg_replace('/(-[-]{1,})/','-',$str);
			$str = preg_replace('/(,)/','-',$str);
			$str=strtolower($str);
			return $str;
		}
		public static function logado(){
			return isset($_SESSION['login']) ? true : false;
		}

		public static function loggout(){
			setcookie('lembrar','true',time()-1,'/');
			session_destroy();
			header('Location: '.INCLUDE_PATH_PAINEL);
		}
		public static function carregarPagina(){
			if(isset($_GET['url'])){
				$url = explode('/',$_GET['url']);
				if(file_exists('pages/'.$url[0].'.php')){
					include('pages/'.$url[0].'.php');
				}else{
					//QUANDO A PAGINA NAO EXISTE!
					header('Location: '.INCLUDE_PATH_PAINEL);
				}
			}else{
				include('pages/home.php');
			}
		}
		public static function alert($tipo,$mensagem){
			if($tipo == 'sucesso'){
				echo '<div class="box-alert sucesso"><i class="fa fa-check-circle"></i> '.$mensagem.'</div>';
			}else if($tipo == 'erro'){
				echo '<div class="box-alert erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';
			}
		}
		public static function imagemValida($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'image/JPG' ||
				$imagem['type'] == 'image/png'){

				$tamanho = intval($imagem['size']/1024);
				if($tamanho < 300)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}

		public static function uploadFile($file){
			$formatoArquivo = explode('.',$file['name']);
			$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) -1];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
				return $imagemNome;
			else
				return false;		
		}


		public static function deleteFile($file){
			@unlink('uploads/'.$file);
		}


		public static function insert($arr){
			$certo = true;
			$nome_tabela = $arr['nome_tabela'];
			$query = "INSERT INTO `$nome_tabela` VALUES (null";
			foreach ($arr as $key => $value){
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$parametros[] = $value;
			}
			$query.=")";
			if($certo == true){
				$sql = MySql::conectar()->prepare($query);
				$sql->execute($parametros);
			}	
			return $certo;
		}
		
		public static function update($arr,$single = false){
			$certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];
			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value){
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}
			if($certo == true){
				if($single == false){
				$parametros[] = $arr['id'];
				$sql = MySql::conectar()->prepare($query.'WHERE id=?');
				$sql->execute($parametros);
				}else{
					$sql = MySql::conectar()->prepare($query);
					$sql->execute($parametros);
				}
			return $certo;
		}
	}

		public static function selectAll($tabela,$start = null,$end = null){
			if($start == null && $end == null)
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela`");
			else
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` LIMIT  $start,$end");
				
			$sql->execute();
			
			return $sql->fetchAll();
		}

		public static function deletar($tabela,$id=false){
			if($id == false){
				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
			}else{
				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = $id");
			}
			$sql->execute();
		}

		public static function redirect($url){
			echo '<script>location.href="'.$url.'"</script>';
			die();
		}
		/*
		METODO ESPECIFICO PRA SELECIONAR 1 ELEMENTO
		*/
		public static function select($tabela,$query = '',$arr = ''){
			if($query != false){
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE $query");
				$sql->execute($arr);
			}else{
				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela`");
				$sql->execute();
			}
			return $sql->fetch();
		}
		
	}

?>