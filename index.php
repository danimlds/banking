<?php
    session_start();
    require 'config.php';

    if(isset($_SESSION['banco']) && empty($_SESSION['banco']) == false) {
        
        $id = $_SESSION['banco'];
        $sql = $pdo->prepare("SELECT * FROM contas WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $info = $sql->fetch();
        } else {
            header("Location: login.php");
            exit;
        }

    }else {
        header("Location: login.php");
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
    <title>Banking</title>
</head>
<body>
<div class="container">
    <h1>Banking</h1>

    Titular:<?php echo $info['titular'];?><br/>
    Agência:<?php echo $info['agencia'];?><br/>
    Conta:<?php echo $info['conta'];?><br/>
    Saldo:<?php echo $info['saldo'];?><br/>
    <a href="sair.php" class="badge badge-primary">Sair</a><br/>

   <br/><br/>
    <h3>Movimentação</h3>
    <a href="add-transacao.php" class="badge badge-primary">Realizar Transação</a><br/><br/><br/>

        <?php 
            $sql = $pdo->prepare("SELECT * FROM historico WHERE id_conta = :id_conta ");
            $sql->bindValue("id_conta", $id);
            $sql->execute();

            if($sql->rowCount() > 0) {
                foreach($sql->fetchAll() as $item) {
                    ?>
                    <?php
                }
            }
        ?>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">Data</th>
        <th scope="col">Valor da Última Operação</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td scope="row"><?php echo date('d/m/Y H:i', strtotime($item['data_operacao'])); ?></td>
        <td scope="row">
        <?php if($item['tipo'] == '0'): ?>
                <font color="green">R$ <?php echo $item['valor'] ?></font>
                <?php else: ?>
                <font color="red">R$ <?php echo $item['valor'] ?></font>
                <?php endif; ?> 
        </td>
        </tr>
    </tbody>
    </table>
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