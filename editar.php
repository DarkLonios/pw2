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
$consulta = $con->query("SELECT * FROM tabela_usuarios WHERE login = '$us'");
while ($campo = $consulta->fetch(PDO::FETCH_ASSOC))
{
	$login = $campo['login'];
	$tipo = $campo['tipo'];
	$foto = $campo['foto'];

}
?>
<?php
	$matricula = $_GET ['matricula'];
	$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
	$sql_e = "SELECT * FROM tabela_professores WHERE matricula=?";
	$busca = $conexao->prepare($sql_e);
	$busca->bindParam(1,$matricula);
	$busca->execute();
	$registro = $busca->fetch(PDO::FETCH_ASSOC);
?>
<?php
	if(isset($_POST['atualizar']))
	{
	try{
		$matricula = $_POST['matricula'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$celular = $_POST['celular'];
		$data = $_POST['data'];
		$valor = $_POST['valor'];
		$arquivo = $_FILES['arquivo'];
		$nome_img = $_FILES['arquivo']['name'];
		$extensao = explode(".",$nome_img);
		$nome_final = md5(time()) . ".". $extensao[1];
		$pasta = "fotos/";

		$sql = "UPDATE tabela_professores SET matricula =?,nome=?,email=?,telefone=?,celular=?,data=?,valor=?,foto=?";

		$stmt = $conexao->prepare($sql);
		$stmt->bindParam(1,$matricula);
		$stmt->bindParam(2,$nome);
		$stmt->bindParam(3,$email);
		$stmt->bindParam(4,$telefone);
		$stmt->bindParam(5,$celular);
		$stmt->bindParam(6,$data);
		$stmt->bindParam(7,$valor);
		$stmt->bindParam(8,$nome_final);
		$resultado = $stmt->execute();

		if($resultado and move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
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
        <link href="css/estilo2.css" rel="stylesheet">
<title>Editar Professores</title>
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
	<main class="fundof"> 
	<fieldset id="pelicula">
	<form action=# method="post" enctype="multipart/form-data">	
        	<p><label class="cor1 tamanho1">Número de matrícula</label></p>
            <p><input type="number" size="5" name="matricula" required value="<?php echo $registro['matricula']; ?>"></p>
            
            <p><label class="cor1 tamanho1">Nome completo do professor:</label></p>
            <p><input type="text" size="50" name="nome" required value="<?php echo $registro['nome']; ?>"></p>
            
            <p><label class="cor1 tamanho1">Email</label></p>
            <p><input type="email" size="50" name="email" required value="<?php echo $registro['email']; ?>"></p>
            
            <p><label class="cor1 tamanho1">Telefone</label></p>
            <p><input type="text" size="15" name="telefone" required value="<?php echo $registro['telefone']; ?>"></p>

            <p><label class="cor1 tamanho1">Celular</label></p>
            <p><input type="text" size="15" name="celular" required value="<?php echo $registro['celular']; ?>"></p>
            
            <p><label class="cor1 tamanho1">Data</label></p>
            <p><input type="date" name="data" required value="<?php echo $registro['data']; ?>"></p>
            
            <p><label class="cor1 tamanho1">Valor</label></p>
			<p><input type="number" size="5,2" name="valor" required value="<?php echo $registro['valor']; ?>"></p>
			
            <p><label class="cor1">Selecione uma imagem:</label></p>
			<p><img src="fotos/<?php echo $registro['foto']?>" width="20%" height="20%" id="visualizar_imagem"></p>
			<p><input type="file" name="arquivo" class="cor1" value="<?php echo $registro['foto']; ?>"></p>
			
			<p><button type="submit" name="atualizar" class="botao">atualizar</p>

			<script>
				function carregaImagem()
				{
					if (this.files && this.files[0]){
						var file = new FileReader();
						file.onload = function(e)
						{
							document.getElementById("visualizar_imagem").src=e.target.result;
						};
						file.readAsDataUrl(this.files[0]);	
					}								
				}
			</script>
		</form>
        </fieldset>
	</main>
	<footer>
		<p></p>
	</footer>
</body>
</html>