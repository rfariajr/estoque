function validateForm() {
    var name = document.getElementById("name").value.trim();
    var qnt = document.getElementById("qnt").value.trim();
    var buyValue = document.getElementById("buyValue").value.trim();
    var sellValue = document.getElementById("sellValue").value.trim();
    var obs = document.getElementById("obs").value.trim();
    if(obs == "") {
        obs = "-";
    }

    document.getElementById("data").value = name + ";" + qnt + ";" + buyValue + ";" + sellValue + ";" + obs;

    return true;
}

document.getElementById("name").onblur = function() {
    var name = document.getElementById("name").value.trim();
    if(name != "") {
        var formData = new FormData(document.getElementById("form"));
        var url = "http://localhost/estoque2/stockFetch.php";
        fetch(url, {method: "POST", body: formData}).then(response => response.text()).then(
            numQuery => {
                if(numQuery != 0) {
                    alert("Esse produto já existe no banco de dados");

                    document.getElementById("name").value = "";

                    document.getElementById("confirmation").checked = false;

                    document.getElementById("bttnSend").disabled = true;
                }
            }
        ).catch(error => alert('Error: ' + error));
    }
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
    document.getElementById("bttnSend").disabled = true;
}