document.getElementById("name").onblur = function() {
    var name = document.getElementById("name").value.trim();
    document.getElementById("name").value = name;
    if(name != "") {
        var formData = new FormData(document.getElementById("form"));
        var url = "http://localhost/estoque2/stockFetch.php";
        fetch(url, {method: "POST", body: formData}).then(response => response.text()).then(queryResult => {
            if(queryResult == 0) {
                alert("Esse produto não existe no banco de dados.");
                document.getElementById("name").value = "";

                document.getElementById("newNameCheck").checked = false;
                document.getElementById("newSellValueCheck").checked = false;
                document.getElementById("delete").checked = false;
                document.getElementById("confirmation").checked = false;

                document.getElementById("newNameCheck").disabled = false;
                document.getElementById("newSellValueCheck").disabled = false;
                document.getElementById("delete").disabled = false;

                document.getElementById("newName").disabled = true;
                document.getElementById("newSellValue").disabled = true;
                document.getElementById("bttnSend").disable = true;

                document.getElementById("newName").required = false;
                document.getElementById("newSellValue").required = false;

                document.getElementById("newName").value = "";
                document.getElementById("newSellValue").value = "0.00";
            }
            else {
                document.getElementById("dataFetch").value = queryResult;
            }
        }).catch(error => alert("Error: " + error));
    }
}

document.getElementById("newName").onblur = function() {
    var newName = document.getElementById("newName").value.trim();
    document.getElementById("newName").value = newName;

    if(newName != "") {
        var formData = new FormData(document.getElementById("form"));
        var url = "http://localhost/estoque2/stockFetchNewName.php";

        fetch(url, {method: "POST", body: formData}).then(response => response.text()).then(queryResult => {
            if(queryResult != 0) {
                alert("O produto já existe no banco de dados");

                document.getElementById("newName").value = "";
            }
        }).catch(error => alert("Error: " + error));
    }
}

function initialOptionName() {
    if(document.getElementById("newNameCheck").checked) {        
        document.getElementById("delete").disabled = true;

        document.getElementById("confirmation").disabled = false;

        document.getElementById("delete").checked = false;

        document.getElementById("newName").disabled = false;

        document.getElementById("newName").required = true;              
    }
    else {
        document.getElementById("newName").disabled = true;

        document.getElementById("newName").required = false;

        document.getElementById("newName").value = "";                

        if(!document.getElementById("newSellValueCheck").checked) {
            document.getElementById("delete").disabled = false;

            document.getElementById("confirmation").disabled = true;

            document.getElementById("confirmation").checked = false;
        }
    }
    return true;
}

function initialOptionSell() {
    if(document.getElementById("newSellValueCheck").checked) {        
        document.getElementById("delete").disabled = true;

        document.getElementById("confirmation").disabled = false;

        document.getElementById("delete").checked = false;

        document.getElementById("newSellValue").disabled = false;

        document.getElementById("newSellValue").required = true;        
    }
    else {
        document.getElementById("newSellValue").disabled = true;

        document.getElementById("newSellValue").required = false;
                
        document.getElementById("newSellValue").value = "0.00";

        if(!document.getElementById("newNameCheck").checked) {
            document.getElementById("delete").disabled = false;

            document.getElementById("confirmation").disabled = true;

            document.getElementById("confirmation").checked = false;
        }
    }
    return true;
}

function initialOptionDelete() {
    if(document.getElementById("delete").checked) {
        document.getElementById("newNameCheck").disabled = true;
        document.getElementById("newSellValueCheck").disabled = true;

        document.getElementById("confirmation").disabled = false;

        document.getElementById("newNameCheck").checked = false;
        document.getElementById("newSellValueCheck").checked = false;

        document.getElementById("newName").disabled = true;
        document.getElementById("newSellValue").disabled = true;

        document.getElementById("newName").required = false;
        document.getElementById("newSellValue").required = false;
        
        document.getElementById("newName").value = "";
        document.getElementById("newSellValue").value = "0.00";
    }
    else {
        document.getElementById("newNameCheck").disabled = false;
        document.getElementById("newSellValueCheck").disabled = false;
        
        document.getElementById("confirmation").disabled = true;

        document.getElementById("confirmation").checked = false;
    }
    return true;
}

function resetForm() {
    document.getElementById("newName").disabled = true;
    document.getElementById("newSellValue").disabled = true;
    document.getElementById("bttnSend").disabled = true;
    document.getElementById("confirmation").disabled = true;

    document.getElementById("newNameCheck").disabled = false;
    document.getElementById("newSellValueCheck").disabled = false;
    document.getElementById("delete").disabled = false;

    document.getElementById("newName").required = false;
    document.getElementById("newSellValue").required = false;        

    document.getElementById("newName").value = "";
    document.getElementById("newSellValue").value = "0.00";
}

function submitForm() {
    document.getElementById("newName").value = document.getElementById("newName").value.trim();
    document.getElementById("newSellValue").value = document.getElementById("newSellValue").value.trim();
    
    document.getElementById("options").value = document.getElementById("newNameCheck").value + ";" + document.getElementById("newSellValueCheck").value + ";" + document.getElementById("delete").value;
}

document.getElementById("confirmation").onclick = function() {
    if(document.getElementById("confirmation").checked) {
        document.getElementById("bttnSend").disabled = false;
    }
    else {
        document.getElementById("bttnSend").disabled = true;
    }
}

