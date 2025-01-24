function gerarDataEmissao() {
    const data = new Date();
    data.setDate(data.getDate() - Math.floor(Math.random() * 30)); 
    const dia = String(data.getDate()).padStart(2, '0');
    const mes = String(data.getMonth() + 1).padStart(2, '0');
    const ano = data.getFullYear();
    return `${ano}-${mes}-${dia}`;
}

function gerarSerie() {
    return Math.floor(Math.random() * 1000) + 1; 
}

function gerarCodigoVerificacao() {
    let codigo = '';
    for (let i = 0; i < 10; i++) {
        codigo += Math.floor(Math.random() * 10);
    }
    return codigo;
}
export { gerarDataEmissao, gerarSerie, gerarCodigoVerificacao };