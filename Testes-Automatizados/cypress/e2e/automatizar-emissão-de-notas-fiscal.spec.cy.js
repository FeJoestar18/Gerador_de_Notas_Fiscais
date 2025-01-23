import { faker } from '@faker-js/faker';
import geradorCNPJ from '../support/geradorRandomCNPJ';
import generateRandomCPF from '../support/geradorRandomCPF';

describe('template spec', () => {
  it('passes', () => {
    Cypress.on('uncaught:exception', (err, runnable) => {
      return false;
    });

    cy.fixture('ceps.json').then((data) => {
      const ceps = data.ceps;
      const cepAleatorio = ceps[Math.floor(Math.random() * ceps.length)];

      const CNPJ = geradorCNPJ();
      const CPF = generateRandomCPF();
      const nomeEmpresa = faker.company.name();
      const nomeCliente = faker.name.fullName();
      const valorTotal = faker.commerce.price();

      cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/formulario_nota_fiscal.php');
      
      cy.get('#nome_empresa').type(nomeEmpresa);
      cy.get('#cep').type(cepAleatorio).click(); 
      cy.get('#cnpj').type(CNPJ);
      cy.get('#nome_cliente').type(nomeCliente);
      cy.get('#cpf').type(CPF);
      cy.get('#forma_pagamento').should('be.visible').select('Boleto Bancário');
      cy.get('#valor_total').type(valorTotal);

      cy.get('[type="submit"]').should('be.visible').click();
      cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/gerador_nota_fiscal.php');   

      cy.visit('http://localhost/Gerador_de_Notas_Fiscais/Gerador_Nota_Fiscais-PHP/formulario_nota_fiscal.php');
    });
  });
});
