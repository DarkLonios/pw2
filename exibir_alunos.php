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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/estiloA.css">
        <link rel="stylesheet" type="text/css" href="css/estiloA_do_menu.css">
<title>Relatório De Alunos</title>
</head>
<style type="text/css">
    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>

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
	<section>
	<table border="2" align="center">
    <tr>
        <th colspan="8">Relatório De Alunos</th>
    </tr>
    <tr>
    	<th>Matrícula</th> <th>Nome do Aluno</th><th>Email</th><th>Telefone</th><th>Data</th><th>Valor</th>
    </tr>
   
    <?php
	 try{
	 $conexao = new PDO('mysql:host=localhost:3307;
	       dbname=banco_apm','root','usbw');
 $consulta = $conexao->query("SELECT * FROM 
 				tabela_aluno");
while($campo = $consulta->fetch(PDO::FETCH_ASSOC)){
	echo "<tr>";
	echo "<td>{$campo['matricula']}</td>";
	echo "<td>{$campo['nome']}</td>";
	echo "<td>{$campo['email']}</td>";
	echo "<td>{$campo['telefone']}</td>";
	echo "<td>" .implode("/",array_reverse(explode("-",$campo['data']))) . "</td>";
	echo "<td>{$campo['valor']}</td>";
	echo "</tr>";
	
}
}catch(PDOException $e){
		echo "Erro:" . $e->getMessage(); 
	 }	
	?>
    </table>
	</section>
</body>
</html>