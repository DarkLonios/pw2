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
<!doctype html>
<html>
<head>
	<script language="Javascript">
				function confirmacao(id) {
				var resposta = confirm("Deseja remover esse registro?");
				
				if (resposta == true) {
					window.location.href = "remover.php?id="+id;
				}
			}
	</script>
<meta charset="utf-8">
<title>exluir</title>
</head>

<body>
	<?php
		$matricula = $_GET['matricula'];
		 
		$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
		$del_sql = "DELETE FROM tabela_professores WHERE matricula=$matricula";
		 
		 echo $del_sql;
			
			if(mysql_query($del_sql)){
				echo "<script>alert('Professor exluidos com sucesso!');</script>";	
				echo "<script>location.href='exibir_professores.php'</script>";
				}else{
				echo "Erro ao excluir professor";	
				}
	?>		
			<body>
			<a href="javascript:func()"
			onclick="confirmacao('1')">Remover registro #1</a>
			
			<a href="javascript:func()"
			onclick="confirmacao('2')">Remover registro #2</a>
			
			<a href="javascript:func()"
			onclick="confirmacao('3')">Remover registro #3</a>
			</body>
</html>