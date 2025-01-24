// Função para gerar uma natureza de operação aleatória
function gerarNaturezaOperacao() {
    const operacoes = [
        "Prestação de Serviços",
        "Venda de Mercadorias",
        "Importação de Produtos",
        "Comércio Eletrônico",
        "Consultoria em TI",
        "Serviços de Publicidade"
    ];
    return operacoes[Math.floor(Math.random() * operacoes.length)];
}
function gerarRegimeTributacao() {
    const regimes = [
        "Simples Nacional",
        "Lucro Presumido",
        "Lucro Real",
        "Regime Normal"
    ];
    return regimes[Math.floor(Math.random() * regimes.length)];
}
function gerarOptanteSimples() {
    return Math.random() < 0.5 ? "Sim" : "Não";
}
function gerarIssRetido() {
    return Math.random() < 0.5 ? "Sim" : "Não"; 
}
function gerarResponsavelIss() {
    const responsaveis = [
        "Prestador de Serviço",
        "Tomador de Serviço"
    ];
    return responsaveis[Math.floor(Math.random() * responsaveis.length)];
}

export { gerarNaturezaOperacao, gerarRegimeTributacao, gerarOptanteSimples, gerarIssRetido, gerarResponsavelIss };