<?php
    session_start();
    if((!isset($_SESSION['login']) == true) 
        and (!isset ($_SESSION['senha']) ==true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.html');
    }

    $us = $_SESSION['login'];
?>
<?php
	session_start();
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$senha_criptografia = md5($senha);
	$con = new PDO('mysql:host=localhost:3307;
					dbname=banco_apm','root','usbw');
	$cmd_sql ="SELECT * FROM tabela_usuarios WHERE login = ? AND senha = ?";
	$busca = $con->prepare($cmd_sql);
	$busca->bindParam(1,$login);
	$busca->bindParam(2,$senha_criptografia);
	$busca->execute();					
	if($busca->rowCount()>0)
	{
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha_criptografia;
		header('location:index.php');			
	}
	else
	{
		unset ($_SESSION['login']);
  		unset ($_SESSION['senha']);
  		header('location:index.html');
	}
?>