function gerarInscricao() {
  return {
    inscricaoMunicipal: Math.floor(100000 + Math.random() * 900000).toString(),
    inscricaoSubstTrib: Math.floor(100000 + Math.random() * 900000).toString(),
    inscricaoEstadual: Math.floor(100000 + Math.random() * 900000).toString(),
    horaEntradaSaida: `${String(Math.floor(Math.random() * 24)).padStart(2, '0')}:${String(Math.floor(Math.random() * 60)).padStart(2, '0')}`,
  };
}

export default gerarInscricao;
