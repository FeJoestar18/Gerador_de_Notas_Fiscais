        function buscarEndereco() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
        
            if (cep.length === 8) { 
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.erro) {
                            alert('CEP não encontrado!');
                        } else {
                            document.getElementById('endereco').value = data.logradouro || '';
                            document.getElementById('bairro').value = data.bairro || '';
                            document.getElementById('cidade').value = data.localidade || '';
                            document.getElementById('estado').value = data.uf || '';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar o CEP:', error);
                        alert('Erro ao buscar o CEP. Tente novamente mais tarde.');
                    });
            } else {
                alert('CEP inválido! Por favor, insira um CEP válido com 8 dígitos.');
            }
        }
        
        