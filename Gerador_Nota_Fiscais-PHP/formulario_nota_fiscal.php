<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/BuscarEndereco.js"></script>
    <script src="js/MostrarCampos.js"></script>
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

        <label for="logradouro">Logradouro</label>
        <input type="text" id="Logradouro" name="Logradouro" required><br>

        <label for="lumero">Numero</label>
        <input type="text" id="Numero" name="Numero" maxlength="5" required><br>
        
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

        <label for="I.E">Inscrição Estadual:</label>
        <input type="text" id="I.E" name="I.E" required><br>

        <h1>Tomador de Serviço</h1>

        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" id="nome_cliente" name="nome_cliente" required><br>

        <label for="cpf_ou_cnpj">CPF ou CNPJ</label>
        <select name="cpf_ou_cnpj" id="cpf_ou_cnpj" required onchange="mostrarCampo()">
            <option value="">Escolha</option>
            <option value="CPF" <?php if (isset($_POST['cpf_ou_cnpj']) && $_POST['cpf_ou_cnpj'] == 'CPF') echo 'selected'; ?>>CPF</option>
            <option value="CNPJ" <?php if (isset($_POST['cpf_ou_cnpj']) && $_POST['cpf_ou_cnpj'] == 'CNPJ') echo 'selected'; ?>>CNPJ</option>
        </select>

        <div id="campoCpf" style="display: none;">
            <label for="cpf">Digite o CPF</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo isset($_POST['cpf']) ? $_POST['cpf'] : ''; ?>" />
        </div>
        
        <div id="campoCnpj" style="display: none;">
            <label for="cnpj">Digite o CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" value="<?php echo isset($_POST['cnpj']) ? $_POST['cnpj'] : ''; ?>" />
        </div>
        
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" placeholder="CEP" onblur="buscarEndereco()" required><br> 

        <label for="Logradouro">Logradouro</label>
        <input type="text" id="Logradouro" name="Logradouro" placeholder="Logradouro" required><br>
        
        <label for="Numero">Numero</label>
        <input type="text" id="Numero" name="Numero" placeholder="Numero" maxlength="5" required><br>
        
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" readonly><br>
        
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" readonly><br>
        
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" readonly><br>
        
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" readonly><br>
        
        <label for="valor_total">Valor Total:</label>
        <input type="number" id="valor_total" name="valor_total" step="0.01" required><br>
        
        <h1>Dados do Serviço Prestado</h1>
        <label for="descricao_servico">Descrição do Serviço:</label>
        <input type="text" id="" name="" required>

        <label for="codigo_servico">Codgio do Serviço:</label>
        <input type="text" id="codigo_servico" name="codigo_servico" required>

        <label for="valor_servico">Valor do Serviço:</label>
        <input type="text" id="valor_servico" name="valor_servico" required>
        
        <label for="aliquota_iss">Aliquiota ISS:</label>
        <input type="text" id="aliquota_iss" name="aliquota_iss" required>
        
        <label for="valor_iss">Valor do ISS:</label>
        <input type="text" id="valor_iss" name="valor_iss" required>

        <label for="base_calculo">Base do Calculo:</label>
        <input type="text" id="base_calculo" name="base_calculo" required>
        
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
        <input type="text" id="data_emissao" name="data_emissao" required><br>
        
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
            <option value="Cartão de Crédito">Cartão de Crédito</option>
            <option value="Boleto Bancário">Boleto Bancário</option>
        </select><br>
        
        <input type="submit" value="Gerar Nota Fiscal">

    </form>

</body>
</html>
