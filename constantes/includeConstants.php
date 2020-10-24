<?php

	/*===============================*/

	//CONFIG PARA TRABALHAR COM AJAX //

	/*===============================*/

    session_start();
	date_default_timezone_set('America/Sao_Paulo');
	$autoLoad = function($class){
        $class = str_replace('\\', '/', $class); //pra funcionar no linux
        if(file_exists('Classes/'.$class.'.php')){
            include('Classes/'.$class.'.php');
		}else{
			include('../Classes/'.$class.'.php');
		}
    };
	spl_autoload_register($autoLoad);

	define('INCLUDE_PATH', 'http://localhost/Sistema%20Teste/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH);

    define('BASE_DIR_PAINEL',__DIR__);
    //conexao como banco de dados.

	define('HOST','localhost');
	define('USER', 'root');
	define('PASSWORD','');
    define('DATABASE','painel');

?>