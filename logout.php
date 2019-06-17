<?php
    function sair(){
        SistemaLogin::excluirCookies();
            session_destroy();
            header("location: /index.html");
    }
?>