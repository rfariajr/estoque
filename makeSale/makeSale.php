<meta charset="utf-8"/>
<?php
//DEFININDO VARIÁVEIS
$name = $_POST["name"];
$qnt = $_POST["qnt"];
$sellValue = $_POST["sellValue"];

$dataArrayFetch = explode(";", $_POST["dataFetch"]);
$idProduto = $dataArrayFetch[0];
$qntStock = $dataArrayFetch[2];
$valStock = $dataArrayFetch[4];

$qntSub = $qntStock - $qnt;
$valAdd = $valStock + ($sellValue * $qnt);

//CONECTANDO AO BANCO DE DADOS
$server = "localhost";
$user = "adminEstoque";
$pass = "";
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $pass, $db);

if(!$connection) {
    die("ERRO!ERRO!ERRO! Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

//ATUALIZANDO TABELA estoque
$sql = "UPDATE estoque SET qnt = '$qntSub', valEstoque = '$valAdd' WHERE nome = '$name'";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("ERRO!ERRO!ERRO! Erro ao inserir valores no banco de dados: " . mysqli_error($connection));
}

//PREENCHENDO TABELA registroVendas
$sql = "INSERT INTO registroVendas (idProduto, qnt, valorVenda) VALUES ('$idProduto', '$qnt', '$sellValue')";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("ERRO!ERRO!ERRO! Erro ao inserir valores no banco de dados: " . mysqli_error($connection));
}

//FECHANDO CONEXÃO
mysqli_close($connection);
?>
