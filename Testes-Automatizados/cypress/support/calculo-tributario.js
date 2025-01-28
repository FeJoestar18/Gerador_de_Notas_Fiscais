function validarInscricaoMunicipal(inscricaoMunicipal) {
    let inscricaoLimpa = inscricaoMunicipal.replace(/\D/g, '');

    if (inscricaoLimpa.length !== 11) {
        return false;
    }

    return true; 
}


//-----------------------------------------------------------------//


function gerarValoresAleatoriosCompleto() {
    
    const valorProduto = parseFloat((Math.random() * 1000 + 100).toFixed(2));
    const descontos = parseFloat((Math.random() * 100).toFixed(2));
    const isencao = parseFloat((Math.random() * 50).toFixed(2));
    const percentualICMS = parseFloat((Math.random() * 18 + 12).toFixed(2));
    const percentualICMSST = parseFloat((Math.random() * 15 + 5).toFixed(2)); 
    const percentualReducao = parseFloat((Math.random() * 10).toFixed(2)); 
    const percentualImpostoImportacao = parseFloat((Math.random() * 5 + 1).toFixed(2)); 
    const percentualICMSUF = parseFloat((Math.random() * 2 + 4).toFixed(2));
    const percentualFCP = parseFloat((Math.random() * 3 + 1).toFixed(2));
    const percentualPIS = parseFloat((Math.random() * (1.65 - 0.65) + 0.65).toFixed(2)); 
    const percentualCONFINS = parseFloat((Math.random() * (7.6 - 3) + 3).toFixed(2)); 

    const valorFrete = parseFloat((Math.random() * 50 + 10).toFixed(2));
    const valorSeguro = parseFloat((Math.random() * 30 + 5).toFixed(2));
    const outrasDespesas = parseFloat((Math.random() * 40 + 10).toFixed(2));
    const valorIPI = parseFloat((Math.random() * 50 + 10).toFixed(2));
    const valorICMSUFDest = parseFloat((Math.random() * 30 + 10).toFixed(2)); // ICMS UF Destino entre 10 e 40
    const valorAproximadoTributo = parseFloat((Math.random() * 150 + 20).toFixed(2));
    const valorTotalNota = parseFloat((Math.random() * 1500 + 100).toFixed(2)); 

    const codigo = Math.floor(Math.random() * 1000000);
    const descricaoProduto = `Produto ${Math.floor(Math.random() * 100)}`; 
    const NCMSH = Math.floor(Math.random() * 100000); 
    const CST = Math.floor(Math.random() * 100); 
    const CFOP = Math.floor(Math.random() * 9999);
    const unidade = ["UN", "CX", "PCT", "KG", "L"].sort(() => 0.5 - Math.random())[0]; 
    const quantidade = Math.floor(Math.random() * 50 + 1); 
    const vlrUnitario = parseFloat((Math.random() * 100 + 10).toFixed(2));
    const vlrTotal = parseFloat((vlrUnitario * quantidade).toFixed(2));
    const bcICMS = parseFloat((Math.random() * 500 + 50).toFixed(2));
    const vlrICMS = parseFloat((bcICMS * Math.random() * 0.18).toFixed(2));
    const vlrIPI = parseFloat((bcICMS * Math.random() * 0.10).toFixed(2));
    const aliquotaICMS = parseFloat((Math.random() * 18 + 12).toFixed(2));
    const aliquotaIPI = parseFloat((Math.random() * 10 + 5).toFixed(2)); 
    const reservaAoFisco = parseFloat((Math.random() * 50 + 10).toFixed(2)); 
    const valorTotal = parseFloat((valorTotalNota + valorFrete + valorSeguro + outrasDespesas - descontos).toFixed(2));
    
    const valorPIS = valorProduto * (percentualPIS / 100); 
    const valorCONFINS = valorProduto * (percentualCONFINS / 100); 
    const valorICMS = bcICMS * (percentualICMS / 100);

    return {
        baseICMS: valorProduto - (descontos + isencao),
        valorICMS: valorICMS,
        baseICMSST: valorProduto * (1 - percentualReducao / 100),
        valorICMSST: valorProduto * (1 - percentualReducao / 100) * (percentualICMSST / 100),
        valorImpImportacao: valorProduto * (percentualImpostoImportacao / 100),
        valorICMSUFRemet: valorProduto * (percentualICMSUF / 100),
        valorFCP: valorProduto * (percentualFCP / 100),
        valorPIS: valorPIS,
        valorCONFINS: valorCONFINS,
        valorTotalProdutos,
        valorFrete,
        valorSeguro,
        desconto,
        outrasDespesas,
        valorIPI,
        valorICMSUFDest,
        valorAproximadoTributo,
        valorTotalNota,
        codigo,
        descricaoProduto,
        NCMSH,
        CST,
        CFOP,
        unidade,
        quantidade,
        vlrUnitario,
        vlrTotal,
        bcICMS,
        vlrICMS,
        vlrIPI,
        aliquotaICMS,
        aliquotaIPI,
        reservaAoFisco,
        valorTotal
    };
}

//AQUI VAI UM EXEMPLO DE COMO USAR
let resultadoCompleto = gerarValoresAleatoriosCompleto();
console.log(resultadoCompleto);
