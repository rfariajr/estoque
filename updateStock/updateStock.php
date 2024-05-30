<meta charset="utf-8"/>
<?php
$dataArray = explode(";", $_POST["data"]);
$name = $dataArray[0];
$qnt = $dataArray[1];
$buyValue = $dataArray[2];
$buyValue *= $qnt;

//CONECTANDO AO BANCO DE DADOS
$server = "localhost";
$user = "adminEstoque";
$password = "";
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $password, $db);
if(!$connection) {
    die("<br>ERRO!ERRO!ERRO! Conexão com banco de dados falhou: " . mysqli_connect_error());
}

//COLENTANDO OS DADOS NECESSÁRIOS DA TABELA estoque
$sql = "SELECT id, valEstoque, qnt FROM estoque WHERE nome ='$name'";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("<br>ERRO!ERRO!ERRO! Falha ao consultar valores: " . mysqli_error($connection));
}
$result = mysqli_fetch_assoc($query);
$idProduto = $result["id"];
$valEstoque = $result["valEstoque"];
$qntEstoque = $result["qnt"];

//ATUALIZANDO TABELA ESTOQUE
$valEstoque -= $buyValue;
$qnt += $qntEstoque;
$sql = "UPDATE estoque SET qnt = '$qnt', valEstoque = '$valEstoque' WHERE nome = '$name'";
if(mysqli_query($connection, $sql)) {

}
else {
    die("<br>ERRO!ERRO!ERRO! Falha ao registrar valores na tabela 'estoque': " . mysqli_error($connection));
}

//PREENCHENDO TABLE registroEntradas
$qnt -= $qntEstoque;
$sql = "INSERT INTO registroEntradas (idProduto, qnt, valorCompra) VALUES ('$idProduto', '$qnt', '$buyValue')";
if(mysqli_query($connection, $sql)) {

}
else {
    die("<br>ERRO!ERRO!ERRO! Falha ao registrar valores na tabela 'registroEntradas': " . mysqli_error($connection));
}
//FECHANDO CONEXÃO
mysqli_close($connection);
?>