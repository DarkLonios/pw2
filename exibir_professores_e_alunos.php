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
<!--Alunos-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Relatório De Alunos</title>
</head>

<body>
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
	echo "<td>{$campo['data']}</td>";
	echo "<td>{$campo['valor']}</td>";
	echo "</tr>";
	
}
}catch(PDOException $e){
		echo "Erro:" . $e->getMessage(); 
	 }	
	?>
    </table>
</body>
</html>

<!--Professores-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Relatório De Professores</title>
</head>

<body>
	<table border="2" align="center">
    <tr>
        <th colspan="8">Relatório De Professores</th>
    </tr>
    <tr>
    	<th>Matrícula</th> <th>Nome do Professor</th><th>Email</th><th>Telefone</th><th>Celular</th><th>Data</th><th>Valor</th>
    </tr>
   
    <?php
	 try{
	 $conexao = new PDO('mysql:host=localhost:3307;
	       dbname=banco_apm','root','usbw');
 $consulta = $conexao->query("SELECT * FROM 
 				tabela_professores");
while($campo = $consulta->fetch(PDO::FETCH_ASSOC)){
	echo "<tr>";
	echo "<td>{$campo['matricula']}</td>";
	echo "<td>{$campo['nome']}</td>";
	echo "<td>{$campo['email']}</td>";
	echo "<td>{$campo['telefone']}</td>";
	echo "<td>{$campo['celular']}</td>";
	echo "<td>{$campo['data']}</td>";
	echo "<td>{$campo['valor']}</td>";
	echo "</tr>";
	
}
}catch(PDOException $e){
		echo "Erro:" . $e->getMessage(); 
	 }	
	?>
    </table>
</body>
</html>


<!--Botões-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link>
</head>
<body>
<form action="#" method="get">
<fieldset>
	<p><input type="submit" value="ExibirProfessores" name="Exibir Professores"></p>

	<p><input type="submit" value="Exibir Alunos" name="Exibir Alunos"></p>
</fieldset>
</form>
</html>