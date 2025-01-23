function buscarEndereco() {
    var cep = document.getElementById("cep").value.replace(/\D/g, '');
    if (cep !== '') {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById("logradouro").value = data.logradouro;
                    document.getElementById("bairro").value = data.bairro;
                    document.getElementById("cidade").value = data.localidade;
                    document.getElementById("estado").value = data.uf;
                    document.getElementById("endereco").value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                } else {
                    alert('CEP não encontrado. Por favor, verifique o CEP informado.');
                }
            })
            .catch(error => {
                console.error('Erro ao buscar o endereço:', error);
                alert('Ocorreu um erro ao buscar o endereço. Por favor, tente novamente mais tarde.');
            });
    }
}
        