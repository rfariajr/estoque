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
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("<br>Erro: ".mysqli_error($connection));
}

if(mysqli_num_rows($query) == 0) {
    print("0");
}

else {
    $row = mysqli_fetch_assoc($query);
    $response = $row["id"] . ";" . $row["nome"] . ";" . $row["qnt"] . ";" . $row["precoVenda"] . ";" . $row["valEstoque"] . ";" . $row["obs"];
    print($response);
}

mysqli_close($connection);
?>