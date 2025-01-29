<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/BuscarEndereco.js"></script>
    <script src="js/BuscarEnderecoCliente.js"></script>
    <script src="js/CalcularImpostos.js"></script>
    <script src="js/Mask.js"></script>
    <title>Gerador de Notas Fiscais</title>

</head>
<body>
    <h1>Gerador de Notas Fiscais</h1>
    <form method="post" action="gerador_nota_fiscal.php">

        <h1>Prestador de Serviço.</h1>
        <label for="nome_empresa">Nome da Empresa:</label>
        <input type="text" id="nome_empresa" name="nome_empresa" required><br>
        
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" onblur="buscarEndereco()" required><br>

        <label for="logradouro">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" required><br>

        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" maxlength="5" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" readonly><br>

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" readonly><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" readonly><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" readonly><br>
        
        <label for="cnpj">CNPJ:</label>
        <input type="text" id="cnpj" name="cnpj" maxlength="18" required><br>
        
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" required><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>

        <label for="ie">Inscrição Estadual:</label>
        <input type="text" id="ie" name="ie" required><br>

        <h1>Tomador de Serviço</h1>
        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" id="nome_cliente" name="nome_cliente" required><br>

        <label for="cpf_cliente">CPF:</label>
        <input type="text" id="cpf_cliente" name="cpf_cliente" maxlength="14" required><br>

        <label for="cep_cliente">CEP:</label>
        <input type="text" id="cep_cliente" name="cep_cliente" maxlength="9" onblur="buscarEnderecoCliente()" required><br> 

        <label for="logradouro_cliente">Logradouro:</label>
        <input type="text" id="logradouro_cliente" name="logradouro_cliente" required><br>
        
        <label for="numero_cliente">Número:</label>
        <input type="text" id="numero_cliente" name="numero_cliente" maxlength="5" required><br>
        
        <label for="endereco_cliente">Endereço:</label>
        <input type="text" id="endereco_cliente" name="endereco_cliente" readonly><br>
        
        <label for="bairro_cliente">Bairro:</label>
        <input type="text" id="bairro_cliente" name="bairro_cliente" readonly><br>
        
        <label for="cidade_cliente">Cidade:</label>
        <input type="text" id="cidade_cliente" name="cidade_cliente" readonly><br>
        
        <label for="estado_cliente">Estado:</label>
        <input type="text" id="estado_cliente" name="estado_cliente" readonly><br>

        <h1>Dados do Serviço Prestado</h1>
        <label for="descricao_servico">Descrição do Serviço:</label>
        <input type="text" id="descricao_servico" name="descricao_servico" required><br>

        <label for="codigo_servico">Código do Serviço:</label>
        <input type="text" id="codigo_servico" name="codigo_servico" maxlength="10" pattern="^[a-zA-Z0-9-]+$" required title="Código do serviço pode conter letras, números e hífens. Máximo de 10 caracteres."><br>


        <label for="valor_servico">Valor do Serviço (R$):</label>
        <input type="number" id="valor_servico" name="valor_servico" step="0.01" required><br>
        
        <label for="aliquota_iss">Alíquota ISS (%):</label>
        <input type="number" id="aliquota_iss" name="aliquota_iss" step="0.01" required><br>
        
        <label for="valor_iss">Valor do ISS (R$):</label>
        <input type="text" id="valor_iss" name="valor_iss" readonly><br>

        <label for="base_calculo">Base de Cálculo (R$):</label>
        <input type="text" id="base_calculo" name="base_calculo" readonly><br>

        <h1>Informações Fiscais e Tributárias</h1>
        <label for="natureza_operacao">Natureza da Operação:</label>
        <input type="text" id="natureza_operacao" name="natureza_operacao" required><br>
        
        <label for="regime_tributacao">Regime Especial de Tributação:</label>
        <input type="text" id="regime_tributacao" name="regime_tributacao" required><br>
        
        <label for="optante_simples">Optante pelo Simples Nacional:</label>
        <input type="text" id="optante_simples" name="optante_simples" required><br>
        
        <label for="iss_retido">ISS Retido:</label>
        <input type="text" id="iss_retido" name="iss_retido" required><br>
        
        <label for="responsavel_iss">Responsável pelo Recolhimento do ISS:</label>
        <input type="text" id="responsavel_iss" name="responsavel_iss" required><br>

        <h1>Outras Informações</h1>
        <label for="data_emissao">Data de Emissão:</label>
        <input type="date" id="data_emissao" name="data_emissao" required><br>

        <label for="numero_nf">Número da Nota Fiscal:</label>
        <input type="text" id="numero_nf" name="numero_nf" required><br>
        
        <label for="serie">Série:</label>
        <input type="text" id="serie" name="serie" required><br>
        
        <label for="codigo_verificacao">Código de Verificação:</label>
        <input type="text" id="codigo_verificacao" name="codigo_verificacao" required><br>

        <h1>Outras Incidências</h1>
        <label for="outras_retencoes">Outras Retenções:</label>
        <input type="text" id="outras_retencoes" name="outras_retencoes" required><br>

        <h1>Inscrição MUNICIPAL</h1>
        <label for="inscricao_municipal">Inscrição Municipal:</label>
        <input type="text" id="inscricao_municipal" name="inscricao_municipal" required><br>

        <h1>Formas de Pagamento</h1>
        <label for="formato_saida">Formato de Saída:</label>
        <select id="formato_saida" name="formato_saida" required>
            <option value="pdf">PDF</option>
        </select><br>
        
        <label for="forma_pagamento">Forma de Pagamento:</label>
        <select id="forma_pagamento" name="forma_pagamento" required>
            <option value="Pix">Pix</option>
            <!-- <option value="Cartão de Crédito">Cartão de Crédito</option> -->
            <option value="Boleto Bancário">Boleto Bancário</option>
        </select><br>        

        <label for="inscricao_subst_trib">Inscrição Estadual do Subst. Trib:</label>
        <input type="text" id="inscricao_subst_trib" name="inscricao_subst_trib" required><br>

        <label for="inscricao_estadual">Inscrição Estadual:</label>
        <input type="text" id="inscricao_estadual" name="inscricao_estadual" required><br>

        <label for="hora_entrada_saida">Hora Entrada/Saída:</label>
        <input type="time" id="hora_entrada_saida" name="hora_entrada_saida" required><br>

        <label for="base_calculo_icms">Base de Cálculo do ICMS:</label>
        <input type="number" step="0.01" id="base_calculo_icms" name="base_calculo_icms" readonly><br>

        <label for="valor_icms">Valor do ICMS:</label>
        <input type="number" step="0.01" id="valor_icms" name="valor_icms" readonly><br>

        <label for="base_calculo_icms_st">Base de Cálculo do ICMS ST:</label>
        <input type="number" step="0.01" id="base_calculo_icms_st" name="base_calculo_icms_st" readonly><br>

        <label for="valor_icms_st">Valor do ICMS ST:</label>
        <input type="number" step="0.01" id="valor_icms_st" name="valor_icms_st" readonly><br>

        <label for="valor_importacao">V. Imp. Importação:</label>
        <input type="number" step="0.01" id="valor_importacao" name="valor_importacao" readonly><br>

        <label for="valor_icms_uf_remet">V. ICMS UF Remet.:</label>
        <input type="number" step="0.01" id="valor_icms_uf_remet" name="valor_icms_uf_remet" readonly><br>

        <label for="valor_fcp">Valor do FCP:</label>
        <input type="number" step="0.01" id="valor_fcp" name="valor_fcp" readonly><br>

        <label for="valor_pis">Valor do PIS:</label>
        <input type="number" step="0.01" id="valor_pis" name="valor_pis" readonly><br>

        <label for="valor_total_produtos">V. Total de Produtos:</label>
        <input type="number" step="0.01" id="valor_total_produtos" name="valor_total_produtos" readonly><br>

        <label for="valor_frete">Valor do Frete:</label>
        <input type="number" step="0.01" id="valor_frete" name="valor_frete" required><br>

        <label for="valor_seguro">Valor do Seguro:</label>
        <input type="number" step="0.01" id="valor_seguro" name="valor_seguro" required><br>

        <label for="desconto">Desconto:</label>
        <input type="number" step="0.01" id="desconto" name="desconto" required><br>

        <label for="outras_despesas">Outras Despesas:</label>
        <input type="number" step="0.01" id="outras_despesas" name="outras_despesas" required><br>

        <label for="valor_ipi">Valor do IPI:</label>
        <input type="number" step="0.01" id="valor_ipi" name="valor_ipi" readonly><br>

        <label for="valor_icms_uf_dest">V. ICMS UF Dest.:</label>
        <input type="number" step="0.01" id="valor_icms_uf_dest" name="valor_icms_uf_dest" readonly><br>

        <label for="valor_aprox_tributo">V. Aproximado do Tributo:</label>
        <input type="number" step="0.01" id="valor_aprox_tributo" name="valor_aprox_tributo" readonly><br>

        <label for="valor_confins">Valor da CONFINS:</label>
        <input type="number" step="0.01" id="valor_confins" name="valor_confins" readonly><br>

        <label for="valor_total_nota">V. Total da Nota:</label>
        <input type="number" step="0.01" id="valor_total_nota" name="valor_total_nota" readonly><br>

        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required><br>

        <label for="descricao_produto">Descrição do Produto/Serviço:</label>
        <input type="text" id="descricao_produto" name="descricao_produto" required><br>

        <label for="ncms">NCMSH:</label>
        <input type="text" id="ncms" name="ncms" required><br>

        <label for="cst">CST:</label>
        <input type="text" id="cst" name="cst" required><br>

        <label for="cfop">CFOP:</label>
        <input type="text" id="cfop" name="cfop" required><br>

        <label for="unidade">UN:</label>
        <input type="text" id="unidade" name="unidade" required><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" step="0.01" id="quantidade" name="quantidade" required><br>

        <label for="valor_unitario">VLR. Unitário:</label>
        <input type="number" step="0.01" id="valor_unitario" name="valor_unitario" required><br>

        <label for="valor_total">VLR. Total:</label>
        <input type="number" step="0.01" id="valor_total" name="valor_total" readonly><br>

        <label for="bc_icms">BC ICMS:</label>
        <input type="number" step="0.01" id="bc_icms" name="bc_icms" readonly><br>

        <label for="valor_icms_final">VLR. ICMS:</label>
        <input type="number" step="0.01" id="valor_icms_final" name="valor_icms_final" readonly><br>

        <label for="valor_ipi_final">VLR. IPI:</label>
        <input type="number" step="0.01" id="valor_ipi_final" name="valor_ipi_final" readonly><br>

        <label for="aliq_icms">Alíquota ICMS (%):</label>
        <input type="number" step="0.01" id="aliq_icms" name="aliq_icms" required><br>

        <label for="aliq_ipi">Alíquota IPI (%):</label>
        <input type="number" step="0.01" id="aliq_ipi" name="aliq_ipi" required><br>

        <label for="reserva_fisco">Reserva ao Fisco:</label>
        <input type="text" id="reserva_fisco" name="reserva_fisco" required><br>

        <label for="valor_total">Valor Total:</label>
        <input type="text" id="valor_total" name="valor_total" readonly><br>
        
        <input type="submit" value="Gerar Nota Fiscal">
    </form>
</body>
</html>