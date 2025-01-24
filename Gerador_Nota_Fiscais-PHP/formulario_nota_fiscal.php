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

        <label for="valor_total">Valor Total:</label>
        <input type="text" id="valor_total" name="valor_total" readonly><br>
        
        <input type="submit" value="Gerar Nota Fiscal">
    </form>
</body>
</html>
