<?php
include('conexao.php');
use Picqer\Barcode\BarcodeGeneratorPNG;

// Funções de Validação de CNPJ e CPF
function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/\D/', '', $cnpj);
    if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }
    $soma = 0;
    $peso = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for ($i = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * $peso[$i];
    }
    $resto = $soma % 11;
    $digito1 = $resto < 2 ? 0 : 11 - $resto;
    $soma = 0;
    $peso = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for ($i = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * $peso[$i];
    }
    $resto = $soma % 11;
    $digito2 = $resto < 2 ? 0 : 11 - $resto;
    return ($cnpj[12] == $digito1 && $cnpj[13] == $digito2);
}

function validarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = $resto < 2 ? 0 : 11 - $resto;
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = $resto < 2 ? 0 : 11 - $resto;
    return ($cpf[9] == $digito1 && $cpf[10] == $digito2);
}

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Dados do Prestador de Serviços
    $nome_empresa = isset($_POST['nome_empresa']) ? $_POST['nome_empresa'] : '';
    $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
    $logradouro = isset($_POST['logradouro']) ? $_POST['logradouro'] : '';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $ie = isset($_POST['ie']) ? $_POST['ie'] : '';

    // Dados do Tomador de Serviços
    $nome_cliente = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : '';
    $cpf_cliente = isset($_POST['cpf_cliente']) ? $_POST['cpf_cliente'] : '';
    $cnpj_cliente = isset($_POST['cnpj_cliente']) ? $_POST['cnpj_cliente'] : '';
    $cep_cliente = isset($_POST['cep_cliente']) ? $_POST['cep_cliente'] : '';
    $logradouro_cliente = isset($_POST['logradouro_cliente']) ? $_POST['logradouro_cliente'] : '';
    $numero_cliente = isset($_POST['numero_cliente']) ? $_POST['numero_cliente'] : '';
    $bairro_cliente = isset($_POST['bairro_cliente']) ? $_POST['bairro_cliente'] : '';
    $cidade_cliente = isset($_POST['cidade_cliente']) ? $_POST['cidade_cliente'] : '';
    $estado_cliente = isset($_POST['estado_cliente']) ? $_POST['estado_cliente'] : '';

    // Dados do Serviço Prestado
    $descricao_servico = isset($_POST['descricao_servico']) ? $_POST['descricao_servico'] : '';
    $codigo_servico = isset($_POST['codigo_servico']) ? $_POST['codigo_servico'] : '';
    $valor_servico = isset($_POST['valor_servico']) ? $_POST['valor_servico'] : '';
    $aliquota_iss = isset($_POST['aliquota_iss']) ? $_POST['aliquota_iss'] : '';
    $valor_iss = isset($_POST['valor_iss']) ? $_POST['valor_iss'] : '';
    $base_calculo = isset($_POST['base_calculo']) ? $_POST['base_calculo'] : '';

    // Informações Fiscais e Tributárias
    $natureza_operacao = isset($_POST['natureza_operacao']) ? $_POST['natureza_operacao'] : '';
    $regime_tributacao = isset($_POST['regime_tributacao']) ? $_POST['regime_tributacao'] : '';
    $optante_simples = isset($_POST['optante_simples']) ? $_POST['optante_simples'] : '';
    $iss_retido = isset($_POST['iss_retido']) ? $_POST['iss_retido'] : '';
    $responsavel_iss = isset($_POST['responsavel_iss']) ? $_POST['responsavel_iss'] : '';

    // Outras Informações
    $data_emissao = isset($_POST['data_emissao']) ? $_POST['data_emissao'] : '';
    $numero_nf = isset($_POST['numero_nf']) ? $_POST['numero_nf'] : '';
    $serie = isset($_POST['serie']) ? $_POST['serie'] : '';
    $codigo_verificacao = isset($_POST['codigo_verificacao']) ? $_POST['codigo_verificacao'] : '';

    // Outras Incidências
    $outras_retencoes = isset($_POST['outras_retencoes']) ? $_POST['outras_retencoes'] : '';

    // Formas de Pagamento
    $formato_saida = isset($_POST['formato_saida']) ? $_POST['formato_saida'] : '';
    $forma_pagamento = isset($_POST['forma_pagamento']) ? $_POST['forma_pagamento'] : '';
    $valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : '';

    // Validação do CNPJ
    if (!validarCNPJ($cnpj)) {
        echo "<script>alert('CNPJ inválido');</script>";
        exit;
    }

    // Validação do CPF
    if (!validarCPF($cpf)) {
        echo "<script>alert('CPF inválido');</script>";
        exit;
    }

    $nota_fiscal = '
   <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }
    .container {
        width: 100%;
        max-width: 750px; 
        margin: 0 auto;
        border: 1px solid #000;
        padding: 5px;
    }
    h1 {
        text-align: center;
        font-size: 1.1em;
        margin-bottom: 8px;
    }
    .header-notice {
        text-align: center;
        color: red;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
    }
    .details-table th, .details-table td {
        border: 1px solid #000;
        padding: 5px;
        text-align: left;
        font-size: 0.8em;
    .provider, .client {
        border: 1px solid #000;
        padding: 6px;
        margin-bottom: 8px;
    }
    .bold {
        font-weight: bold;
    }
    .description-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }
    .description-table th, .description-table td {
        border: 1px solid #000;
        padding: 5px;
        font-size: 0.8em;
    }
    .footer {
        font-size: 0.7em;
        color: gray;
        margin-top: 15px;
        padding-top: 6px;
        border-top: 1px solid #000;
    }
    .footer p {
        margin: 3px 0;
    }
    @media print {
        body {
            width: 100%;
            margin: 0;
            height: auto;
        }
        .container {
            width: 100%;
            margin: 0;
            padding: 5px;
        }
        .details-table, .description-table {
            width: 100%;
        }
    }
</style>


<div class="nota-fiscal">
    <div class="container">
        <h1>NFS-e - Nota Fiscal de Serviço Eletrônica</h1>
        <div class="header-notice"> </div>

        <table class="details-table">
            <tr>
                <th>Emitida em</th>
                <th>Número</th>
                <th>Cód. Verificação</th>
            </tr>
            <tr>
                <td>' . $data_emissao . '</td>
                <td>' . $numero_nf . '</td>
                <td>' . $codigo_verificacao . '</td>
            </tr>
        </table>

        <div class="provider">
            <div class="bold">' . $nome_empresa . '</div>
            <div>CNPJ: ' . $cnpj . '</div>
            <div>' . $logradouro . ', ' . $numero . ' - ' . $bairro . ' - CEP: ' . $cep . '</div>
            <div>' . $cidade . ', ' . $estado . '</div>
            <div>Inscrição Municipal: <span class="bold">' . $ie . '</span></div>
        </div>

        <div class="client">
            <div class="bold">Tomador dos Serviços</div>
            <div>CPF/CNPJ: <span class="bold">' . (!empty($cpf_cliente) ? $cpf_cliente : $cnpj_cliente) . '</span></div>
            <div>' . $nome_cliente . '</div>
            <div>' . $logradouro_cliente . ', ' . $numero_cliente . ' - ' . $bairro_cliente . ' - CEP: ' . $cep_cliente . '</div>
            <div>' . $cidade_cliente . ', ' . $estado_cliente . '</div>
            <div>Inscrição Municipal: ' . (!empty($clienteInscricaoMunicipal) ? $clienteInscricaoMunicipal : "Não Informado") . '</div>
        </div>

        <table class="description-table">
            <tr>
                <th>Descrição do Serviço</th>
            </tr>
            <tr>
                <td>' . $descricao_servico . '</td>
            </tr>
            <tr>
                <th>Código do Serviço</th>
                <th>Serviço prestado</th>
            </tr>
            <tr>
                <td>' . $codigo_servico . '</td>
                <td>' . $descricao_servico . '</td>
            </tr>
           
        </table>
<table class="description-table">
    <tr>
        <td><strong>Natureza da Operação:</strong></td>
        <td>' . $natureza_operacao . '</td>
    </tr>
    <tr>
        <td><strong>Regime de Tributação:</strong></td>
        <td>' . $regime_tributacao . '</td>
    </tr>
    <tr>
        <td><strong>Optante pelo Simples Nacional:</strong></td>
        <td>' . ($optante_simples ? "Sim" : "Não") . '</td>
    </tr>
    <tr>
        <td><strong>ISS Retido:</strong></td>
        <td>' . ($iss_retido ? "Sim" : "Não") . '</td>
    </tr>
    <tr>
        <td><strong>Responsável pelo ISS:</strong></td>
        <td>' . $responsavel_iss . '</td>
    </tr>
    <tr>
        <td><strong>Valor Total:</strong></td>
        <td>R$ ' . $valor_total . '</td>
    </tr>
    <tr>
        <td><strong>Valor do ISS:</strong></td>
        <td>R$ ' . $valor_iss . '</td>
    </tr>
    <tr>
        <td><strong>Base de Cálculo:</strong></td>
        <td>R$ ' . $base_calculo . '</td>
    </tr>
    <tr>
        <td><strong>Outras Retenções:</strong></td>
        <td>R$ ' . $outras_retencoes . '</td>
    </tr>
    <tr>
        <td><strong>Forma de Pagamento:</strong></td>
        <td>' . $forma_pagamento . '</td>
    </tr>
    <tr>
        <td colspan="2"><strong>Informações adicionais ou termos podem ser colocados aqui.</strong></td>
    </tr>
</table>
    
    </div>
</div>
';


    

    require_once __DIR__ . '/vendor/autoload.php';
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->writeHTML($nota_fiscal, true, false, true, false, '');

    if ($forma_pagamento === 'Boleto Bancário') {
        require_once __DIR__ . '/vendor/autoload.php';
        $barcode_generator = new BarcodeGeneratorPNG();
        $codigo_barras = $barcode_generator->getBarcode('12345678901234567890123456', $barcode_generator::TYPE_CODE_128);
        $pdf->Image('@' . $codigo_barras, 15, 240, 180, 30, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
    }

    $diretorio_pdf = __DIR__ . '/notas_fiscais/';
    if (!is_dir($diretorio_pdf)) {
        mkdir($diretorio_pdf, 0755, true); 
    }

    $filename = $diretorio_pdf . "nota_fiscal_" . date('YmdHis') . ".pdf";
    $pdf->Output($filename, 'F'); 

    echo "<div style='text-align:center;'>
            <h2>Nota Fiscal gerada com sucesso!</h2>
            <p>Você será redirecionado em 3 segundos...</p>
          </div>";

    echo "<script>
            setTimeout(function() {
                window.location.href = 'formulario_nota_fiscal.php'; 
            }, 3000); 
          </script>";
        }
?>