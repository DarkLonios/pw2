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
</head>
<meta charset="utf-8">
<title>Formulário de pesquisa</title>
<link rel="stylesheet" type="text/css" href="css/estiloA.css">
        <link rel="stylesheet" type="text/css" href="css/estiloA_do_menu.css"> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css">

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
<div id="todoconteudo">
  
    <div id="cabecalho">    
    </div>
    
    <div id="menu">    
    </div>
    
    <div id="corpo">
  <fieldset>
    <legend>Formulário de Pesquisa</legend>
  <form action="#" method="get">
    <p><label>Digite o nome do professor que deseja buscar:</label></p>
  <p><input type="text" name="valor_de_busca" size="50" required> </p>
  <p><input type="submit" name="buscar" value="Pesquisar"></p>
    </form>
    <?php
    if(isset($_GET['buscar'])){
      $valor = $_GET['valor_de_busca'];
      try{
        $con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');     
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando_sql = "SELECT * FROM tabela_professores WHERE nome LIKE '%$valor%'";
        $consulta = $con->query($comando_sql);
        print "<p>Resultado:</p>";
        while($registro = $consulta->fetch(PDO::FETCH_ASSOC))
          {
            print "<p>
                {$registro['matricula']} - {$registro['nome']} - {$registro['email']} - {$registro['telefone']} - {$registro['celular']} - {$registro['data']} - {$registro['valor']} - {$registro['valor']} - <img src='fotos/{$registro['foto']}' class='foto' alt='Foto'>
                <a href='form_busca.php?excluir&matricula={$registro['matricula']}'>
                <img src='img/lixo.png' title='Excluir registro'></a>  
                
                <a href='editar.php?matricula={$registro['matricula']}'>
                <img src='img/editar.png' title='Editar registro'></a>    
                </p>";
          }
                      
        }catch(PDOException $e){
          print "Erro ocorrido:" . $e->getMessage();          
          }
    
    }
    else if(isset($_GET['excluir']))
    { 
      $matricula = $_GET['matricula'];
      $con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');   
      $comando_sql = "DELETE FROM tabela_professores WHERE matricula = :valor";
      $stmt = $con->prepare($comando_sql);
      $stmt->bindParam(':valor',$matricula);
      $stmt->execute();
      $rs = $stmt->rowCount();  
      if($rs)
      {
        echo "<script>alert('Registro apagado com sucesso!');</script>";  
      }else{
        echo "<script>alert('Não foi possível excluir!');</script>";    
      }
      
      
    }
  ?>    
    </fieldset>
    </div> 
         
    <div id="rodape">
    </div>
</div>
</section>
</body>
</html>