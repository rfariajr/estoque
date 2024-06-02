<meta charset="utf-8"/>
<?php
//COLETANDO DADOS DO FORMULÁRIO
$dataArray = explode(";", $_POST["data"]);
$name = $dataArray[0];
$qnt = $dataArray[1];
$buyValue = $dataArray[2];
$buyValueTotal = $qnt * $buyValue;

$dataArrayFetch = explode(";", $_POST["dataFetch"]);
$idProduto = $dataArrayFetch[0];
$qntStock = $dataArrayFetch[2];
$valStock = $dataArrayFetch[4];

//CONECTANDO AO BANCO DE DADOS
$server = "localhost";
$user = "adminEstoque";
$password = "";
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $password, $db);
if(!$connection) {
    die("<br>ERRO!ERRO!ERRO! Conexão com banco de dados falhou: " . mysqli_connect_error());
}

//ATUALIZANDO TABELA ESTOQUE
$valStock -= $buyValueTotal;
$qntStock += $qnt;
$sql = "UPDATE estoque SET qnt = '$qntStock', valEstoque = '$valStock' WHERE nome = '$name'";
if(mysqli_query($connection, $sql)) {

}
else {
    die("<br>ERRO!ERRO!ERRO! Falha ao registrar valores na tabela 'estoque': " . mysqli_error($connection));
}

//PREENCHENDO TABLE registroEntradas
$sql = "INSERT INTO registroEntradas (idProduto, qnt, valorCompra) VALUES ('$idProduto', '$qnt', '$buyValue')";
if(mysqli_query($connection, $sql)) {

}
else {
    die("<br>ERRO!ERRO!ERRO! Falha ao registrar valores na tabela 'registroEntradas': " . mysqli_error($connection));
}
//FECHANDO CONEXÃO
mysqli_close($connection);
?>