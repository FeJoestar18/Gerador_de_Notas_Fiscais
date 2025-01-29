function gerarValoresDados() {
  
  const aliqIpi = (Math.random() * 12).toFixed(2);

  return {
    
    baseCalculoIcms: (Math.random() * 10000).toFixed(2),
    valorIcms: (Math.random() * 1000).toFixed(2),
    valorIpi: (Math.random() * 500).toFixed(2),
    valorUnitario: (Math.random() * 100).toFixed(2),
    quantidade: Math.floor(Math.random() * 100),
    desconto: (Math.random() * 50).toFixed(2),
    valorFrete: (Math.random() * 200).toFixed(2),
    valorSeguro: (Math.random() * 150).toFixed(2),
    outrasDespesas: (Math.random() * 300).toFixed(2),
    aliqIcms: (Math.random() * 18).toFixed(2),
    aliqIpi: aliqIpi
  };
}


export default gerarValoresDados;