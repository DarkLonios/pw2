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

$con = new PDO('mysql:host=localhost:3307;
dbname=banco_apm','root','usbw');
$consulta = $con->query("SELECT * FROM 
			 tabela_usuarios WHERE login = '$us'");
while ($campo = $consulta->fetch(PDO::FETCH_ASSOC)){
	$login = $campo['login'];
	$tipo = $campo['tipo'];
	$foto = $campo['foto'];

}
?>

<?php
	if(isset($_GET['cadastrar']))
	{
	try{
		$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
		//Recuperando dados do formulário
		$matricula = $_GET['matricula'];
		$nome = $_GET['nome'];
		$email = $_GET['email'];
		$telefone = $_GET['telefone'];
		$data = $_GET['data'];
		$valor = $_GET['valor'];
		$sql = "INSERT INTO tabela_aluno(matricula,nome,email,telefone,data,valor) VALUES (:par1,:par2,:par3,:par4,:par5,:par6)";
		$stmt = $conexao->prepare($sql);
		$stmt->bindParam(':par1',$matricula);
		$stmt->bindParam(':par2',$nome);
		$stmt->bindParam(':par3',$email);
		$stmt->bindParam(':par4',$telefone);
		$stmt->bindParam(':par5',$data);
		$stmt->bindParam(':par6',$valor);
		$resultado = $stmt->execute();
		if($resultado)
		{
			echo "<script>alert('Dados gravados com sucesso!');</script>";
		}
		else
		{
			echo var_dump($stmt->errorInfo());
		}
		}
		catch(PDOxception $e)
		{
			echo "Erro:" . $e->getMessage();
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estiloA.css">
        <link rel="stylesheet" type="text/css" href="css/estiloA_do_menu.css">
        <link href="css/estilo.css" rel="stylesheet">
<title>Formulário De Cadastro De Alunos</title>
</head>

<body>
	<header>
            <img src="img/logo_etec_2019.png">
     </header>
	 <nav>
            <ul>
				<li><a href="index.php">Home</a></li>
				<?php
				if($tipo == 'S'){
					echo "<li><a href='form_cadastro_prof.php'>Cadastrar Professor</a></li>
					<li><a href='exibir_professores.php'>Exibir Professres</a></li>
					<li><a href='form_cadastro.php'>Cadastrar Aluno</a></li>
					<li><a href='exibir_alunos.php'>Exibir Alunos</a></li>";
				}    
				?>          
                <li><a href="form_busca.php">Buscar</a></li>
				<form>
                    <li><a href="index.html" style="cursor: pointer;" name="sair">Sair</a></li>
				</form>
            </ul>
		</nav>
	<section class="fundof">
	<form action="#" method="get">
    	<fieldset id="pelicula">
        	<p><label class="cor1 tamanho1">Número de matrícula</label></p>
            <p><input type="number" size="5" name="matricula" required></p>
            
            <p><label class="cor1 tamanho1">Nome completo do aluno:</label></p>
            <p><input type="text" size="50" name="nome" required></p>
            
            <p><label class="cor1 tamanho1">Email</label></p>
            <p><input type="email" size="50" name="email" required></p>
            
            <p><label class="cor1 tamanho1">Telefone</label></p>
            <p><input type="text" size="50" name="telefone" required></p>
            
            <p><label class="cor1 tamanho1">Data</label></p>
            <p><input type="date" name="data" required></p>
            
            <p><label class="cor1 tamanho1">Valor</label></p>
            <p><input type="number" size="5,2" name="valor" required></p>
            
            <p><input type="submit" value="Cadastrar" name="cadastrar"></p>
        </fieldset>
    </form>
    </section>
</body>
</html>