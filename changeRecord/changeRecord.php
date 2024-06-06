<!DOCTYPE html>
<?php
//DECLARANDO VARIÁVEIS
$newNameOption = isset($_POST["newNameCheck"]);
$newSellValueOption = isset($_POST["newSellValueCheck"]);
$deleteOption = isset($_POST["delete"]);

$name = $_POST["name"];

$dataFetch = explode(";", $_POST["dataFetch"]);

//CONECTANDO AO BANCO DE DADOS
$server = "localhost";
$user = "adminEstoque";
$pass = "";
$db = "estoquedb";

$connection = mysqli_connect($server, $user, $pass, $db);
if(!$connection) {
    die("ERRO!ERRO!ERRO! Erro ao conectar no banco de dados: " . mysqli_connect_error());
}

//ATUALIZANDO TABELA

if($newNameOption == "1") {
    $newName = $_POST["newName"];

    $sql = "UPDATE estoque SET nome = '$newName' WHERE id = '$dataFetch[0]'";

    $query = mysqli_query($connection, $sql);

    if(!$query) {
        die("ERRO!ERRO!ERRO! Erro ao atualizar o banco de dados: " . mysqli_error($connection));
    }
}

if($newSellValueOption == "1") {
    $newSellValue = $_POST["newSellValue"];

    $sql = "UPDATE estoque SET precoVenda = '$newSellValue' WHERE id = '$dataFetch[0]'";

    $query = mysqli_query($connection, $sql);

    if(!$query) {
        die("ERRO!ERRO!ERRO! Erro ao atualizar o banco de dados: " . mysqli_error($connection));
    }
}

if($deleteOption == "1") {
    $sql = "DELETE FROM estoque WHERE id = '$dataFetch[0]'";    

    $query = mysqli_query($connection, $sql);

    if(!$query) {
        die("ERRO!ERRO!ERRO! Erro ao atualizar o banco de dados: " . mysqli_error($connection));
    }

    $sql = "DELETE FROM registroEntradas WHERE idProduto = '$dataFetch[0]'";    

    $query = mysqli_query($connection, $sql);

    if(!$query) {
        die("ERRO!ERRO!ERRO! Erro ao atualizar o banco de dados: " . mysqli_error($connection));
    }

    $sql = "DELETE FROM registroVendas WHERE idProduto = '$dataFetch[0]'";    

    $query = mysqli_query($connection, $sql);

    if(!$query) {
        die("ERRO!ERRO!ERRO! Erro ao atualizar o banco de dados: " . mysqli_error($connection));
    }
}

//FECHANDO CONEXÃO
mysqli_close($connection);
?>