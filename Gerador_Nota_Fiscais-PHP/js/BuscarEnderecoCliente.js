function buscarEnderecoCliente() {
    var cep = document.getElementById("cep_cliente").value.replace(/\D/g, '');
    if (cep !== '') {
        
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById("logradouro_cliente").value = data.logradouro;
                    document.getElementById("bairro_cliente").value = data.bairro;
                    document.getElementById("cidade_cliente").value = data.localidade;
                    document.getElementById("estado_cliente").value = data.uf;
                    document.getElementById("endereco_cliente").value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
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