<?php 

    $senha = $_POST["password"];
    $email = $_POST["email"];

    if (($senha) == "1234" && ($email) == "lucas@380volts.com.br") {

        header('Location: cursinho-da-poli.php');
        
    } elseif (($senha) == "123" && ($email) == "contato@380volts.com.br") { 
        
        header('Location: https://registro.br/cgi-bin/nicbr/dominio?dominio=380v.com.br');
    }
?>