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
if(isset($_POST['sair']) == true){
        $logar = new SistemaLogin;
        $logar ->sair();
        session_destroy();
    }
?>
<?php

    $con = new PDO('mysql:host=localhost:3307;
    dbname=banco_apm','root','usbw');
    $consulta = $con->query("SELECT * FROM tabela_usuarios WHERE login = '$us'");
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
                <li><a href="javascript:void(0)" onclick="sair()">Sair</a></li>
				</form>
            </ul>
		</nav>
        <main style="height:300px;" class="fundof">
        <div>
        <?php echo "<img src='fotos/$foto' alt='foto' class='foto'> <p>Bem Vindo $login</p>"?>
        </div>
        </main>
        <footer class="fundof">
            Design by Ramon Pessoa
        </footer>
    </body>
</html>