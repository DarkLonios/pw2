<!doctype html>
<html>
<head>
    <title>Criptografia com MD5</title>
</head>
<body>
    <?php
        $senha = 321;
        $senha_criptografia = md5($senha);
        echo $senha_criptografia 
    ?>
</body>
</html>