
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
    if(isset($_POST['enviar'])){
        $arquivo = $_FILES['arquivo'];
        $nome = $_FILES['arquivo']['name'];
        $extensao = explode(".",$nome);
        $nome_final = md5(time()) . ".". $extensao[1];
        $pasta = "fotos/";
    if(move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
        {
            echo "Arvuivo enviado com sucesso!";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Enviar Arquivos</title>
    </head>
    <body>
        <form action="#" method="post" enctype="multipart/form-data">
            <div>
            <p><label>Selecione uma imagem:</label></p>
            <p><input type="file" name="arquivo"></p>
            <p><input type="submit" value="Enviar" name="enviar"></p>
            </div>
    </body>
</html>