document.getElementById("name").onblur = function() {
    var name = document.getElementById("name").value.trim();
    if(name != "") {
        var formData = new FormData(document.getElementById("form"));
        var url = "http://localhost/estoque2/stockFetch.php";
        fetch(url, {method: "POST", body: formData}).then(response => response.text()).then(
            numQuery => {
                if(numQuery == 0) {
                    alert("Esse produto não existe no banco de dados");

                    document.getElementById("name").value = "";
                                        
                    document.getElementById("qnt").value = "0.00";                    
                    document.getElementById("buySell").value = "0.00";

                    document.getElementById("qnt").disabled = true;
                    document.getElementById("buySell").disabled = true;
                    document.getElementById("bttnSend").disabled = true;

                    document.getElementById("confirmation").checked = false;
                }
                else {                    
                    document.getElementById("qnt").disabled = false;
                    document.getElementById("buySell").disabled = false;

                    document.getElementById("dataFetch").value = numQuery;
                }
            }
        ).catch(error => alert('Error: ' + error));
    }
}

function validateForm() {
    name = document.getElementById("name").value.trim();
    qnt = document.getElementById("qnt").value.trim();
    buySell = document.getElementById("buySell").value.trim();

    document.getElementById("data").value = name + ";" + qnt + ";" + buySell;
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

function resetForm() {
    document.getElementById("qnt").disabled = true;
    document.getElementById("buySell").disabled = true;
    document.getElementById("bttnSend").disabled = true;
    return true;
}