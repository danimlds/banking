<?php
    try {
        $pdo = new PDO("mysql:dbname=caixa_eletronico;host=localhost","root", "");
        
    } catch(PDOException $e) {
        echo "ERRO: ".$e->getMessage();
    }

?>