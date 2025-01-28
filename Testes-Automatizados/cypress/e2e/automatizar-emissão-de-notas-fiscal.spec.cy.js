import { faker } from '@faker-js/faker';
import geradorCNPJ from '../support/geradorRandomCNPJ';
import generateRandomCPF from '../support/geradorRandomCPF';
import gerarNumeroAleatorio from '../support/gerarNumeroAleatorio';
import gerarNumeroAleatorioIE from '../support/gerarIE';
import gerarCpfValido from '../support/cpfClienteRandom';
import { gerarDescricaoServico, gerarCodigoServico, gerarValorServico } from '../support/dadosServico';
import { gerarNaturezaOperacao, gerarRegimeTributacao, gerarOptanteSimples, gerarIssRetido, gerarResponsavelIss } from '../support/informacoesFiscais';
import gerarNumeroNF from '../support/gerarNumeroNF';
import { gerarDataEmissao, gerarSerie, gerarCodigoVerificacao } from '../support/outrasInformacoes';
import gerarOutrasRetencoes from '../support/outrasIncidencias';

describe('template spec', () => {
  const quantidadeDeTestes = 1; 

  it('Executa o teste em looping', () => {
    Cypress.on('uncaught:exception', (err, runnable) => {
      return false;
    });

    for (let i = 0; i < quantidadeDeTestes; i++) {
      cy.log(`Execução ${i + 1} de ${quantidadeDeTestes}`); 

      cy.fixture('ceps.json').then((data) => {
        const ceps = data.ceps;
        const cepAleatorio = ceps[Math.floor(Math.random() * ceps.length)];

        cy.fixture('cepcliente.json').then((data) => {
          const cepsCliente = data.ceps_cliente;
          const cepAleatorioCliente = cepsCliente[Math.floor(Math.random() * cepsCliente.length)];

          const CNPJ = geradorCNPJ();
          const CPF = generateRandomCPF();
          const nomeEmpresa = faker.company.name();

          const NumeroAleatorio_cep = gerarNumeroAleatorio();
          const telefoneEmpresa = faker.phone.number();
          const numeroAleatorioIE = gerarNumeroAleatorioIE();

          const nomeCliente = faker.name.fullName();
          const cpfValido = gerarCpfValido();

          const descricaoServico = gerarDescricaoServico();
          const codigoServico = gerarCodigoServico();
          const valorServico = gerarValorServico();

          const naturezaOperacao = gerarNaturezaOperacao();
          const regimeTributacao = gerarRegimeTributacao();
          const optanteSimples = gerarOptanteSimples();
          const issRetido = gerarIssRetido();
          const responsavelIss = gerarResponsavelIss();

          const numeroNF = gerarNumeroNF();
          const dataEmissao = gerarDataEmissao();
          const serie = gerarSerie();
          const codigoVerificacao = gerarCodigoVerificacao();

          const outrasRetencoes = gerarOutrasRetencoes();

          cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/formulario_nota_fiscal.php');

          cy.get('#nome_empresa').type(nomeEmpresa);
          cy.get('#cep').type(cepAleatorio);
          cy.get('#numero').type(NumeroAleatorio_cep.toString());
          cy.get('#cnpj').type(CNPJ);
          cy.get('#cpf').type(CPF);
          cy.get('#telefone').type(telefoneEmpresa);
          cy.get('#ie').type(numeroAleatorioIE);

          // cliente
          cy.get('#nome_cliente').type(nomeCliente);
          cy.get('#cpf_cliente').type(cpfValido);
          cy.get('#cep_cliente').type(cepAleatorioCliente).should('be.visible');
          // cy.wait(5000);
          // cy.get('#logradouro_cliente').should('be.visible').click();
          cy.get('#numero_cliente').type(NumeroAleatorio_cep.toString());

          // dados do serviço
          cy.get('#descricao_servico').type(descricaoServico);
          cy.get('#codigo_servico').type(codigoServico);
          cy.get('#valor_servico').type(valorServico);
          cy.get('#aliquota_iss').should('be.visible').type('5');

          // informações fiscais e tributárias
          cy.get('#natureza_operacao').type(naturezaOperacao);
          cy.get('#regime_tributacao').type(regimeTributacao);
          cy.get('#optante_simples').type(optanteSimples);
          cy.get('#iss_retido').type(issRetido);
          cy.get('#responsavel_iss').type(responsavelIss);

          // outras informações
          cy.get('#numero_nf').should('be.visible').type(numeroNF);
          cy.get('#data_emissao').type(dataEmissao);
          cy.get('#serie').type(serie.toString());
          cy.get('#codigo_verificacao').type(codigoVerificacao);

          // outras incidências
          cy.get('#outras_retencoes').type(outrasRetencoes);
          
          // gerar nota fiscal
          cy.get('[type="submit"]').should('be.visible').click();

          cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/gerador_nota_fiscal.php');

          cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/formulario_nota_fiscal.php');
        });
      });
    }
  });
});
