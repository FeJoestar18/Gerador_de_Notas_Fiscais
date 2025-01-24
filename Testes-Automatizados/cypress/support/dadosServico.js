export function gerarDescricaoServico() {
    const descricoes = [
        "Consultoria em TI",
        "Desenvolvimento de Software",
        "Manutenção de Equipamentos",
        "Apoio Técnico",
        "Auditoria de Sistemas",
        "Treinamento em Desenvolvimento"
    ];
    return descricoes[Math.floor(Math.random() * descricoes.length)];
}

export function gerarCodigoServico() {
    return Math.floor(Math.random() * 9000 + 1000); 
}

export function gerarValorServico() {
    return (Math.random() * (1000 - 100) + 100).toFixed(2);
}
