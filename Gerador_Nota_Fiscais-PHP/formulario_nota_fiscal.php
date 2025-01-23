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
        <label for="nome_empresa">Nome da Empresa:</label>
        <input type="text" id="nome_empresa" name="nome_empresa" required><br>
        
        <!-- <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br> -->

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" placeholder="CEP" onblur="buscarEndereco()" required><br>

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

        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" id="nome_cliente" name="nome_cliente" required><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" required><br>

        <label for="forma_pagamento">Forma de Pagamento:</label>
        <select id="forma_pagamento" name="forma_pagamento" required>
            <option value="Pix">Pix</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
            <option value="Boleto Bancário">Boleto Bancário</option>
        </select><br>

        <!-- <label for="cpf_ou_cnpj">CPF ou CNPJ</label>
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
        </div> -->

        <label for="valor_total">Valor Total:</label>
        <input type="number" id="valor_total" name="valor_total" step="0.01" required><br>

        <label for="formato_saida">Formato de Saída:</label>
        <select id="formato_saida" name="formato_saida" required>
            <option value="pdf">PDF</option>
        </select><br>

        <input type="submit" value="Gerar Nota Fiscal">
    </form>
</body>
</html>
