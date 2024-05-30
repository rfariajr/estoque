<meta charset="utf-8"/>
<?php
//Estabelecendo a conexão mySQL
$server = "localhost";
$user = "adminEstoque";
$pass = "";
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $pass, $db);

if(!$connection) {
    die("ERRO!ERRO!ERRO! Conexão com banco de dados falhou: " . mysqli_connect_error());
}

$dataArray = explode(";", $_POST["data"]);

$name = $dataArray[0];
$qnt = $dataArray[1];
$buyValue = $dataArray[2];
$sellValue = $dataArray[3];
$obs = $dataArray[4];
$stockValue = $buyValue * $qnt * (-1);

//Validando os dados digitados
$sql = "SELECT nome FROM estoque WHERE nome = '$name'";
$inquiry = mysqli_query($connection, $sql);
if(mysqli_num_rows($inquiry) > 0) {
    header('Location: newRecord.html');
    exit;
}


//Registrando os dados tabela 'estoque'
$sql = "INSERT INTO estoque (nome, qnt, precoVenda, valEstoque, obs) VALUES ('$name', '$qnt', '$sellValue', '$stockValue', '$obs')";
if(mysqli_query($connection, $sql)){
    
}
else{
    die("<br>ERRO!ERRO!ERRO! Falha ao registrar valores na tabela 'estoque': " . mysqli_error($connection));
}


//Registrando os dados tabela 'registroEntradas'
$sql = "SELECT id FROM estoque WHERE nome = '$name'";
$query = mysqli_query($connection, $sql);
if(!$query) {
    die("<br>ERRO!ERRO!ERRO! Falha ao consultar valores: " . mysqli_error($connection));
}
$result = mysqli_fetch_assoc($query);
$idProduto = $result["id"];
$sql = "INSERT INTO registroEntradas (idProduto, qnt, valorCompra) VALUES ('$idProduto', '$qnt', '$buyValue')";
if(mysqli_query($connection, $sql)) {

}
else {
    die("<br>ERRO!ERRO!ERRO! Falha ao registrar valores na tabela 'registroEntradas': " . mysqli_error($connection));
}
//Finalizando a conexão
mysqli_close($connection);
?>