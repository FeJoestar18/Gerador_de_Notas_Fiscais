function mostrarCampo() {
    var opcaoSelecionada = document.getElementById("cpf_ou_cnpj").value;
    document.getElementById("campoCpf").style.display = "none";
    document.getElementById("campoCnpj").style.display = "none";
    
    if (opcaoSelecionada == "CPF") {
        document.getElementById("campoCpf").style.display = "block";
    } else if (opcaoSelecionada == "CNPJ") {
        document.getElementById("campoCnpj").style.display = "block";
    }
}