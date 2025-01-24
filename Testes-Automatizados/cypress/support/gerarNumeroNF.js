function gerarNumeroNF() {
    
    const numeroNF = Math.floor(Math.random() * (999999 - 1000 + 1)) + 1000;
    return numeroNF.toString(); 
  }

  module.exports = gerarNumeroNF;