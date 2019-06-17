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
	if(isset($_POST['confirmar']))
	{
	try{
		$con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $senha_criptografia = md5($senha);
        $arquivo = $_FILES['arquivo'];
        $nome_img = $_FILES['arquivo']['name'];
        $extensao = explode(".",$nome_img);
        $nome_final = md5(time()) . ".". $extensao[1];
        $pasta = "fotos/";

        $cmd_sql = "INSERT INTO tabela_usuarios(login,senha,nome,tipo,foto) VALUES (:par2,:par3,:par4,:par5,:par6)";

		$stmt = $con->prepare($cmd_sql);
		$stmt->bindParam(':par2',$login);
		$stmt->bindParam(':par3',$senha_criptografia);
		$stmt->bindParam(':par4',$nome);
        $stmt->bindParam(':par5',$tipo);
        $stmt->bindParam(':par6',$nome_final);
        $resultado = $stmt->execute();
        
		if($resultado && move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
		{
            echo "<script>alert('Dados gravados com sucesso!');</script>";
            echo "<script>location.href='index.html'</script>";
		}
		else
		{
			echo var_dump($stmt->errorInfo());
		}
		}catch(PDOxception $e)
		{
			echo "Erro:" . $e->getMessage();
		}
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Tela de Cadastro</title>
    </head>
    <body>
        <fieldset id="pelicula">
            <legend>Fazer Cadastro</legend>
                <form action="#" method="post" enctype="multipart/form-data">
                    <p><label>Login:</label><input type="text" name="login" size="20" required></p>
                    <p><label>Senha:</label><input type="password" name="senha" size="20" required></p>
                    <p><label>Nome:</label><input type="text" name="nome" size="20" required></p>
                    <label>Tipo:</label>
                    <select name="tipo" type="text">
                    <option selected disabled>Selecione o Tipo:</option>
                    <option>Super</option>
                    <option>Comum</option>    
                    </select>
                    <div>
                    <p><label>Selecione uma imagem:</label></p>
                    <p><input type="file" name="arquivo"></p>
                    </div>
                    <p><button  type="submit" name="confirmar" class="botao">confirmar</button></p>
                </form>
        </fieldset>
    </body>
</html>