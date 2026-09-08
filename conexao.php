<?php 

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "churrascada";

    $mysqli = new mysqli($host, $user, $pass, $db);

    function limpar_texto($str){
        return preg_replace("/[^0-9]/", "", $str);
    }
?>