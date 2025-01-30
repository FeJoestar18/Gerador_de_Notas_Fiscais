// import { faker } from '@faker-js/faker';
// import geradorCNPJ from '../support/geradorRandomCNPJ';
// import generateRandomCPF from '../support/geradorRandomCPF';
// import gerarNumeroAleatorio from '../support/gerarNumeroAleatorio';
// import gerarNumeroAleatorioIE from '../support/gerarIE';
// import gerarCpfValido from '../support/cpfClienteRandom';
import { gerarDescricaoServico, gerarCodigoServico, gerarValorServico } from '../support/dadosServico';
import { gerarNaturezaOperacao, gerarRegimeTributacao, gerarOptanteSimples, gerarIssRetido, gerarResponsavelIss } from '../support/informacoesFiscais';
import gerarNumeroNF from '../support/gerarNumeroNF';
import { gerarDataEmissao, gerarSerie, gerarCodigoVerificacao } from '../support/outrasInformacoes';
import gerarOutrasRetencoes from '../support/outrasIncidencias';
import gerarInscricao from '../support/gerarInscricao';
import gerarValoresDados from '../support/UltimosValores';

describe('template spec', () => {
  const quantidade_testes = 10;

    it('Executa o teste em looping', () => {
      Cypress.on('uncaught:exception', (err, runnable) => {
        return false;
      });

      for (let i = 0; i < quantidade_testes; i++) {
        cy.log(`Teste ${i+1} de ${quantidade_testes}`);
            

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
  
            const dados = gerarInscricao();
            const imposto = gerarValoresDados();
  
            // const baseCalculoIcms = gerarValoresDados();
            // const valorIcms  =  gerarValoresDados();
            // const valorIpi =  gerarValoresDados();
            // const valorUnitario =  gerarValoresDados();
            // const quantidade =  gerarValoresDados();
            // const desconto =  gerarValoresDados();
            // const valorFrete =  gerarValoresDados();
            // const valorSeguro =  gerarValoresDados();
            // const outrasDespesas =  gerarValoresDados();
            // const aliqIcms =  gerarValoresDados();
            // const aliqIpi =  gerarValoresDados();
  
  
  
            cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/formulario_nota_fiscal.php');
  
            cy.get('#nome_empresa').type("A Corteva, inc.");
            cy.get('#cep').type("07809-105");
            cy.get('#numero').type(30);
            // cy.pause();
            cy.get('#cnpj').type("61.064.929/0001-79");
            cy.get('#cpf').type("028.660.770-08");
            cy.get('#telefone').type("0800 772 2492");
            cy.get('#ie').type("61.064.929/0043-28");
  
            // cliente
            cy.get('#nome_cliente').type("Novo Produtor MG Outros");
            cy.get('#cpf_cliente').type("130-596-980-40");
            cy.get('#cep_cliente').type("31160-342").should('be.visible');
            // cy.wait(5000);
            // cy.get('#logradouro_cliente').should('be.visible').click();
            cy.get('#numero_cliente').type("30");
  
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
  
            // inscrições
            cy.log('Dados gerados: ', JSON.stringify(dados));
      
            // Verificando especificamente o valor de inscricaoEstadual
            cy.log('Inscrição Estadual: ', dados.inscricaoEstadual); 
            
            // Verifique se a inscrição estadual é válida antes de usá-la
            if (dados.inscricaoEstadual) {
              cy.get('#inscricao_municipal').type(dados.inscricaoMunicipal);
              cy.get('#inscricao_subst_trib').type(dados.inscricaoSubstTrib);
              cy.get('#inscricao_estadual').type(dados.inscricaoEstadual);
              cy.get('#hora_entrada_saida').type(dados.horaEntradaSaida);
            } else {
              throw new Error('Inscrição Estadual não gerada corretamente.');
            }
  
            // itens da nota fiscal
  
            cy.log('Dados gerados:', JSON.stringify(imposto));
  
            // Verificando especificamente o valor de aliqIpi
            cy.log('Valor de Aliq Ipi:', imposto.aliqIpi);
  
            cy.get('#base_calculo_icms').type(imposto.baseCalculoIcms); 
            cy.get('#valor_icms').type(imposto.valorIcms);  
            cy.get('#valor_ipi').type(imposto.valorIpi);  
            cy.get('#valor_unitario').type(imposto.valorUnitario);  
            cy.get('#quantidade').type(imposto.quantidade);  
            cy.get('#desconto').type(imposto.desconto);  
            cy.get('#valor_frete').type(imposto.valorFrete); 
            cy.get('#valor_seguro').type(imposto.valorSeguro);  
            cy.get('#outras_despesas').type(imposto.outrasDespesas);  
            cy.get('#aliq_icms').type(imposto.aliqIcms); 
            cy.get('#aliq_ipi').type(imposto.aliqIpi);
                  
            // cy.pause();
            // gerar nota fisca
            cy.get('[type="submit"]').should('be.visible').click();
            
            cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/gerador_nota_fiscal.php');
  
            cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/formulario_nota_fiscal.php');
            }
          });
        });
      
   
  
  