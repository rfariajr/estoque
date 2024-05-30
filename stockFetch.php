<?php
$server = "localhost";
$user = "adminEstoque";
$pass = "";
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $pass, $db);
if(!$connection) {
    die("ERRO!ERRO!ERRO! Conexão com banco de dados falhou: " . mysqli_connect_error());
}

$name = $_POST["name"];
$sql = "SELECT * FROM estoque WHERE nome = '$name'";
$inquiry = mysqli_query($connection, $sql);
if(!$inquiry) {
    die("<br>Erro: ".mysqli_error($connection));
}
$result = mysqli_num_rows($inquiry);
print($result);
mysqli_close($connection);
?>