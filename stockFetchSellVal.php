<?php
//CONECTANDO AO BANCO DE DADOS
$server = "localhost";
$user = "adminEstoque";
$pass = "";
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $pass, $db);
if(!$connection) {
    die("ERRO!ERRO!ERRO! Conexão com o banco de dados falhou: " . mysqli_connect_error());
}

//CONSULTANDO BANCO DE DADOS
$name = $_POST["name"];
$sql = "SELECT precoVenda FROM estoque WHERE nome = '$name'";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("<br>ERRO!ERRO!ERRO! Erro a consultar o banco de dados: " . mysqli_error($connection));
}
$sellVal = mysqli_fetch_assoc($query);
if(is_null($sellVal["precoVenda"])) {
    print("0");
}
else {
    print($sellVal["precoVenda"]);
}

//FECHANDO CONEXÃO
mysqli_close($connection);
?>