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