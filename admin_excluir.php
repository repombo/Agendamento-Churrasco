<?php 

    include("conexao.php");
    $id = intval($_POST['id']);
    $sql_cliente = "SELECT * FROM pre_agendamento WHERE id = '$id'";
    $query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
    $cliente = $query_cliente->fetch_assoc();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $sql_confirma = "DELETE FROM pre_agendamento WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_confirma) or die($mysqli->error);

        echo "Ação confirmada com sucesso!";
    }
?>