<meta charset="utf-8"/>
<?php
//DEFININDO VARIÁVEIS
$name = $_POST["name"];
$qnt = $_POST["qnt"];
$sellValue = $_POST["sellValue"];
$amount = $qnt * $sellValue;

//CONECTANDO AO BANCO DE DADOS
$server = "localhost";
$user = "adminEstoque";
$pass = ""
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $pass, $db);

if(!$connection) {
    die("ERRO!ERRO!ERRO! Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

//ATUALIZANDO TABELA estoque
$sql = "SELECT id, qnt, valEstoque FROM estoque WHERE nome = '$name'";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("ERRO!ERRO!ERRO! Erro ao consultar valores no banco de dados: " . mysqli_error($connection));
}

$result = mysqli_fetch_assoc($query);
$idProduto = $result["id"];
$qntSub = $result["qnt"] - $qnt;
$valEstoque = $result["valEstoque"] + $amount;

$sql = "UPDATE estoque SET qnt = '$qntSub', valEstoque = '$valEstoque' WHERE nome = '$name'";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("ERRO!ERRO!ERRO! Erro ao inserir valores no banco de dados: " . mysqli_error($connection));
}

//PREENCHENDO TABELA registroVendas
$sql = "INSERT INTO registroVendas (idProduto, qnt, valorVenda) VALUES ('$idProduto', '$qnt', '$amount')";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("ERRO!ERRO!ERRO! Erro ao inserir valores no banco de dados: " . mysqli_error($connection));
}

//FECHANDO CONEXÃO
mysqli_close($connection);
?>
