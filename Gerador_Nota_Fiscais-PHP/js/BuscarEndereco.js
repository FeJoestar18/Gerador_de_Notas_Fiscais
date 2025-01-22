        function buscarEndereco() {
            const cep = document.getElementById("cep").value;
            const url = `https://viacep.com.br/ws/${cep}/json/`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById("endereco").value = data.logradouro;
                        document.getElementById("bairro").value = data.bairro;
                        document.getElementById("cidade").value = data.localidade;
                        document.getElementById("estado").value = data.uf;
                    } else {
                        alert("CEP não encontrado.");
                    }
                })
                .catch(() => alert("Erro ao buscar o CEP."));
        }

        
        document.getElementById('cnpj').addEventListener('input', function() {
            this.value = formatCNPJ(this.value);
        });
        document.getElementById('cpf').addEventListener('input', function() {
            this.value = formatCPF(this.value);
        });