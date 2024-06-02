document.getElementById("name").onblur = function() {
    var name = document.getElementById("name").value.trim()
    if(name != "") {
        var formData = new FormData(document.getElementById("form"));
        var url = "http://localhost/estoque2/stockFetch.php"
        fetch(url, {method: "POST", body: formData}).then(response => response.text()).then(queryResult => {
            if(queryResult == 0) {
                alert("Esse produto não existe no banco de dados.");

                document.getElementById("name").value = "";
                document.getElementById("qnt").value = "0.00";
                document.getElementById("sellValue").value = "0.00";

                document.getElementById("qnt").disabled = true;
                document.getElementById("sellValue").disabled = true;
                document.getElementById("bttnSend").disabled = true;
                document.getElementById("confirmation").disabled = true;

                document.getElementById("confirmation").checked = false;

                document.getElementById("alertNumStock").innerHTML = "";
            }
            else {
                var queryResultArray = queryResult.split(";");

                if(queryResultArray[2] <= 0) {
                    alert("Ação não pode ser realizada. Não há esse unidades desse produto disponível para venda.");
                    
                    document.getElementById("name").value = "";
                    document.getElementById("qnt").value = "0.00";
                    document.getElementById("sellValue").value = "0.00";

                    document.getElementById("qnt").disabled = true;
                    document.getElementById("sellValue").disabled = true;
                    document.getElementById("bttnSend").disabled = true;
                    document.getElementById("confirmation").disabled = true;

                    document.getElementById("confirmation").checked = false;

                    document.getElementById("alertNumStock").innerHTML = "";
                }

                else {
                    document.getElementById("dataFetch").value = queryResult;
                    document.getElementById("sellValue").value = queryResultArray[3];

                    document.getElementById("alertNumStock").innerHTML = "Quantidade disponível para venda: " + queryResultArray[2];

                    document.getElementById("qnt").max = queryResultArray[2];

                    document.getElementById("qnt").disabled = false;
                    document.getElementById("sellValue").disabled = false;                
                    document.getElementById("confirmation").disabled = false;
                }
                
            }
        }).catch(error => alert("Error: " + error));
    }
}

function validateForm() {
    document.getElementById("name").value = document.getElementById("name").value.trim();
    document.getElementById("qnt").value = document.getElementById("qnt").value.trim();
    document.getElementById("sellValue").value = document.getElementById("sellValue").value.trim();

    return true;
}

function resetForm() {
    document.getElementById("name").value = "";
    document.getElementById("qnt").value = "0.00";
    document.getElementById("sellValue").value = "0.00";

    document.getElementById("qnt").disabled = true;
    document.getElementById("sellValue").disabled = true;
    document.getElementById("bttnSend").disabled = true;
    document.getElementById("confirmation").disabled = true;

    document.getElementById("confirmation").checked = false;

    document.getElementById("alertNumStock").innerHTML = "";

    return true;    
}

document.getElementById("confirmation").onclick = function(){
    if(document.getElementById("confirmation").checked == true) {
        document.getElementById("bttnSend").disabled = false;
    }
    else {
        document.getElementById("bttnSend").disabled = true;
    }
}