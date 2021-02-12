<?php
    session_start();
    require 'config.php';

    if(isset($_POST['agencia']) && empty($_POST['agencia']) == false) {
        $agencia = addslashes($_POST['agencia']);
        $conta = addslashes($_POST['conta']);
        $senha = addslashes($_POST['senha']);

        $sql = $pdo->prepare("SELECT * FROM contas WHERE agencia = :agencia AND conta = :conta AND senha = :senha");
        $sql->bindValue(":agencia", $agencia);
        $sql->bindValue(":conta", $conta);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            
            $_SESSION['banco'] = $sql['id'];
            header("Location: index.php");
        }
    }
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <title>Caixa Eletrônico</title>
</head>
<body>
<div class="container"> 
    <form method="POST" style="padding-top: 150px;">
        <div class="form-group">
            <label for="">Agência:</label>
            <input type="text" name="agencia" class="form-control" placeholder="Número da Agência"/><br/><br/>
        </div>
        <div class="form-group">
            <label for="">Conta:</label>
            <input type="text" name="conta" class="form-control" placeholder="Número da Conta"/><br/><br/>
        </div>
        <div class="form-group">
            <label for="">Senha:</label>
            <input type="password" name="senha" class="form-control" placeholder="Informe a Senha"/><br/><br/>
        </div>
        <button type="submit" class="btn btn-sucess">Entrar</button>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>