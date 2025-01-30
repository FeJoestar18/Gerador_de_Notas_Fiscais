<?php
include('conexao.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Picqer\Barcode\BarcodeGeneratorPNG;

function validarCNPJ($cnpj) {
    if (empty($cnpj)) {
        return false; 
    }

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
    if ($cpf === null || $cpf === '') {
        return false; 
    }

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
function validarEstado($uf) {
    $estados = [
        "RO" => "11", "AC" => "12", "AM" => "13", "RR" => "14", "PA" => "15", "AP" => "16", "TO" => "17",
        "MA" => "21", "PI" => "22", "CE" => "23", "RN" => "24", "PB" => "25", "PE" => "26", "AL" => "27",
        "SE" => "28", "BA" => "29", "MG" => "31", "ES" => "32", "RJ" => "33", "SP" => "35", "PR" => "41",
        "SC" => "42", "RS" => "43", "MS" => "50", "MT" => "51", "GO" => "52", "DF" => "53"
    ];

    return $estados[$uf] ?? "0"; 
}

function gerarChaveAcesso($uf, $ano, $mes, $cnpj, $modelo, $serie, $numeroNota, $codigoAleatorio) {
    $cnpj = preg_replace('/\D/', '', $cnpj);
    $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

    $chave = str_pad($uf, 2, '0', STR_PAD_LEFT) .
             str_pad($ano, 2, '0', STR_PAD_LEFT) .
             str_pad($mes, 2, '0', STR_PAD_LEFT) .
             $cnpj .
             str_pad($modelo, 2, '0', STR_PAD_LEFT) .
             str_pad($serie, 3, '0', STR_PAD_LEFT) .
             str_pad($numeroNota, 9, '0', STR_PAD_LEFT) .
             str_pad($codigoAleatorio, 9, '0', STR_PAD_LEFT);

    $digitoVerificador = calcularDigitoVerificador($chave);

    return $chave . $digitoVerificador;
}

function calcularDigitoVerificador($chave) {
    $pesos = [2, 3, 4, 5, 6, 7, 8, 9];
    $soma = 0;
    $pesoAtual = 0;

    for ($i = strlen($chave) - 1; $i >= 0; $i--) {
        $soma += (int)$chave[$i] * $pesos[$pesoAtual]; 
        $pesoAtual = ($pesoAtual + 1) % count($pesos);
    }

    $resto = $soma % 11;
    return $resto < 2 ? 0 : 11 - $resto;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_empresa = isset($_POST['nome_empresa']) ? $_POST['nome_empresa'] : '';
    $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
    $logradouro = isset($_POST['logradouro']) ? $_POST['logradouro'] : '';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : ''; 
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';  
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $ie = isset($_POST['ie']) ? $_POST['ie'] : '';
    $nome_cliente = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : '';
    $cpf_cliente = isset($_POST['cpf_cliente']) ? $_POST['cpf_cliente'] : '';
    $cep_cliente = isset($_POST['cep_cliente']) ? $_POST['cep_cliente'] : '';
    $logradouro_cliente = isset($_POST['logradouro_cliente']) ? $_POST['logradouro_cliente'] : '';
    $numero_cliente = isset($_POST['numero_cliente']) ? $_POST['numero_cliente'] : '';
    $endereco_cliente = isset($_POST['endereco_cliente']) ? $_POST['endereco_cliente'] : '';
    $bairro_cliente = isset($_POST['bairro_cliente']) ? $_POST['bairro_cliente'] : '';
    $cidade_cliente = isset($_POST['cidade_cliente']) ? $_POST['cidade_cliente'] : '';
    $estado_cliente = isset($_POST['estado_cliente']) ? $_POST['estado_cliente'] : '';
    $descricao_servico = isset($_POST['descricao_servico']) ? $_POST['descricao_servico'] : '';
    $codigo_servico = isset($_POST['codigo_servico']) ? $_POST['codigo_servico'] : '';
    $data_emissao = isset($_POST['data_emissao']) ? $_POST['data_emissao'] : '';
    $numero_nf = isset($_POST['numero_nf']) ? $_POST['numero_nf'] : '';
    $serie = isset($_POST['serie']) ? $_POST['serie'] : '';
    $codigo_verificacao = isset($_POST['codigo_verificacao']) ? $_POST['codigo_verificacao'] : '';
    $outras_retencoes = isset($_POST['outras_retencoes']) ? $_POST['outras_retencoes'] : '';
    $inscricao_municipal = isset($_POST['inscricao_municipal']) ? $_POST['inscricao_municipal'] : '';
    $inscricao_subst_trib = isset($_POST['inscricao_subst_trib']) ? $_POST['inscricao_subst_trib'] : '';
    $hora_entrada_saida = isset($_POST['hora_entrada_saida']) ? $_POST['hora_entrada_saida'] : '';
    $natureza_operacao = isset($_POST['natureza_operacao']) ? $_POST['natureza_operacao'] : '';
    $regime_tributacao = isset($_POST['regime_tributacao']) ? $_POST['regime_tributacao'] : '';
    $optante_simples = isset($_POST['optante_simples']) ? $_POST['optante_simples'] : '';
    $iss_retido = isset($_POST['iss_retido']) ? $_POST['iss_retido'] : '';
    $responsavel_iss = isset($_POST['responsavel_iss']) ? $_POST['responsavel_iss'] : '';
    $base_calculo_icms = isset($_POST['base_calculo_icms']) ? $_POST['base_calculo_icms'] : '';
    $valor_icms = isset($_POST['valor_icms']) ? $_POST['valor_icms'] : '';
    $valor_ipi = isset($_POST['valor_ipi']) ? $_POST['valor_ipi'] : '';
    $valor_unitario = isset($_POST['valor_unitario']) ? $_POST['valor_unitario'] : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
    $desconto = isset($_POST['desconto']) ? $_POST['desconto'] : '';
    $valor_frete = isset($_POST['valor_frete']) ? $_POST['valor_frete'] : '';
    $valor_seguro = isset($_POST['valor_seguro']) ? $_POST['valor_seguro'] : '';
    $outras_despesas = isset($_POST['outras_despesas']) ? $_POST['outras_despesas'] : '';
    $aliq_icms = isset($_POST['aliq_icms']) ? $_POST['aliq_icms'] : '';
    $aliq_ipi = isset($_POST['aliq_ipi']) ? $_POST['aliq_ipi'] : '';
    $valor_total_produtos = isset($_POST['valor_total_produtos']) ? $_POST['valor_total_produtos'] : '';
    $aliquota_iss = isset($_POST['aliquota_iss']) ? $_POST['aliquota_iss'] : '';
    $valor_iss = isset($_POST['valor_iss']) ? $_POST['valor_iss'] : '';
    $base_calculo = isset($_POST['base_calculo']) ? $_POST['base_calculo'] : '';
    $valor_servico = isset($_POST['valor_servico']) ? $_POST['valor_servico'] : '';
    $valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : '';
    $formato_saida = isset($_POST['formato_saida']) ? $_POST['formato_saida'] : '';
    $forma_pagamento = isset($_POST['forma_pagamento']) ? $_POST['forma_pagamento'] : '';

    if (empty($estado) || empty($data_emissao) || empty($serie) || empty($numero_nf) || empty($cnpj)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    $uf = validarEstado($estado); 
    if ($uf === "0") {
        echo "Estado inválido.";
        exit;
    }

    $ano = substr($data_emissao, 2, 2);
    $mes = substr($data_emissao, 5, 2);
    $codigoAleatorio = rand(100000000, 999999999);
    $modelo = "55";
    $serie = str_pad($serie, 3, '0', STR_PAD_LEFT);
    $numeroNota = str_pad($numero_nf, 9, '0', STR_PAD_LEFT);

    $key = gerarChaveAcesso($uf, $ano, $mes, $cnpj, $modelo, $serie, $numeroNota, $codigoAleatorio);
    $formattedKey = chunk_split($key, 4, ' ');

    echo "Chave de Acesso: " . $formattedKey;
    }


if (isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];

    if (!validarCPF($cpf)) {
        echo "<script>alert('CPF inválido');</script>";
        exit;
    }
} else {
    echo "<script>alert('CPF não fornecido');</script>";
    exit;
}

if (isset($_POST['cnpj']) && !validarCNPJ($_POST['cnpj'])) {
    echo "<script>alert('CNPJ inválido');</script>";
    exit;
}
    $nota_fiscal = '
  <style type="text/css">
    @media print {
    @page {
        size: 180mm 250mm; 
        margin-left: 10mm;
        margin-right: 10mm;
        margin-top: 5mm;
        margin-bottom: 5mm;
    }
}


        footer {
            page-break-after: always;
        }
    }

    * {
        margin: 0;
    }

    .ui-widget-content {
        border: none !important;
    }

    .nfe-square {
        margin: 0 auto 2cm;
        box-sizing: border-box;
        width: 2cm;
        height: 1cm;
        border: 1px solid #000;
    }

    .nfeArea.page {
        width: 18cm;
        position: relative;
        font-family: "Times New Roman", serif;
        color: #000;
        margin: 0 auto;
        overflow: hidden;
    }

    .nfeArea .font-12 {
        font-size: 12pt;
    }

    .nfeArea .font-8 {
        font-size: 8pt;
    }

    .nfeArea .bold {
        font-weight: bold;
    }
    /* == TABELA == */
    .nfeArea .area-name {
        font-family: "Times New Roman", serif;
        color: #000;
        font-weight: bold;
        margin: 5px 0 0;
        font-size: 6pt;
        text-transform: uppercase;
    }

    .nfeArea .txt-upper {
        text-transform: uppercase;
    }

    .nfeArea .txt-center {
        text-align: center;
    }

    .nfeArea .txt-right {
        text-align: right;
    }

    .nfeArea .nf-label {
        text-transform: uppercase;
        margin-bottom: 3px;
        display: block;
    }

        .nfeArea .nf-label.label-small {
            letter-spacing: -0.5px;
            font-size: 4pt;
        }

    .nfeArea .info {
        font-weight: bold;
        font-size: 8pt;
        display: block;
        line-height: 1em;
    }

    .nfeArea table {
        font-family: "Times New Roman", serif;
        color: #000;
        font-size: 5pt;
        border-collapse: collapse;
        width: 100%;
        border-color: #000;
        border-radius: 5px;
    }

    .nfeArea .no-top {
        margin-top: -1px;
    }

    .nfeArea .mt-table {
        margin-top: 3px;
    }

    .nfeArea .valign-middle {
        vertical-align: middle;
    }

    .nfeArea td {
        vertical-align: top;
        box-sizing: border-box;
        overflow: hidden;
        border-color: #000;
        padding: 1px;
        height: 5mm;
    }

    .nfeArea .tserie {
        width: 32.2mm;
        vertical-align: middle;
        font-size: 8pt;
        font-weight: bold;
    }

        .nfeArea .tserie span {
            display: block;
        }

        .nfeArea .tserie h3 {
            display: inline-block;
        }

    .nfeArea .entradaSaida .legenda {
        text-align: left;
        margin-left: 2mm;
        display: block;
    }

        .nfeArea .entradaSaida .legenda span {
            display: block;
        }

    .nfeArea .entradaSaida .identificacao {
        float: right;
        margin-right: 2mm;
        border: 1px solid black;
        width: 5mm;
        height: 5mm;
        text-align: center;
        padding-top: 0;
        line-height: 5mm;
    }

    .nfeArea .hr-dashed {
        border: none;
        border-top: 1px dashed #444;
        margin: 5px 0;
    }

    .nfeArea .client_logo {
        height: 27.5mm;
        width: 28mm;
        margin: 0.5mm;
    }

    .nfeArea .title {
        font-size: 10pt;
        margin-bottom: 2mm;
    }

    .nfeArea .txtc {
        text-align: center;
    }

    .nfeArea .pd-0 {
        padding: 0;
    }

    .nfeArea .mb2 {
        margin-bottom: 2mm;
    }

    .nfeArea table table {
        margin: -1pt;
        width: 100.5%;
    }

    .nfeArea .wrapper-table {
        margin-bottom: 2pt;
    }

        .nfeArea .wrapper-table table {
            margin-bottom: 0;
        }

            .nfeArea .wrapper-table table + table {
                margin-top: -1px;
            }

    .nfeArea .boxImposto {
        table-layout: fixed;
    }

        .nfeArea .boxImposto td {
            width: 11.11%;
        }

        .nfeArea .boxImposto .nf-label {
            font-size: 5pt;
        }

        .nfeArea .boxImposto .info {
            text-align: right;
        }

    .nfeArea .wrapper-border {
        border: 1px solid #000;
        border-width: 0 1px 1px;
        height: 75.7mm;
    }

        .nfeArea .wrapper-border table {
            margin: 0 -1px;
            width: 100.4%;
        }

    .nfeArea .content-spacer {
        display: block;
        height: 10px;
    }

    .nfeArea .titles th {
        padding: 3px 0;
    }

    .nfeArea .listProdutoServico td {
        padding: 0;
    }

    .nfeArea .codigo {
        display: block;
        text-align: center;
        margin-top: 5px;
    }

    .nfeArea .boxProdutoServico tr td:first-child {
        border-left: none;
    }

    .nfeArea .boxProdutoServico td {
        font-size: 6pt;
        height: auto;
    }

    .nfeArea .boxFatura span {
        display: block;
    }

    .nfeArea .boxFatura td {
        border: 1px solid #000;
    }

    .nfeArea .freteConta .border {
        width: 5mm;
        height: 5mm;
        float: right;
        text-align: center;
        line-height: 5mm;
        border: 1px solid black;
    }

    .nfeArea .freteConta .info {
        line-height: 5mm;
    }

    .page .boxFields td p {
        font-family: "Times New Roman", serif;
        font-size: 5pt;
        line-height: 1.2em;
        color: #000;
    }

    .nfeArea .imgCanceled {
        position: absolute;
        top: 75mm;
        left: 30mm;
        z-index: 3;
        opacity: 0.8;
        display: none;
    }

    .nfeArea.invoiceCanceled .imgCanceled {
        display: block;
    }

    .nfeArea .imgNull {
        position: absolute;
        top: 75mm;
        left: 20mm;
        z-index: 3;
        opacity: 0.8;
        display: none;
    }

    .nfeArea.invoiceNull .imgNull {
        display: block;
    }

    .nfeArea.invoiceCancelNull .imgCanceled {
        top: 100mm;
        left: 35mm;
        display: block;
    }

    .nfeArea.invoiceCancelNull .imgNull {
        top: 65mm;
        left: 15mm;
        display: block;
    }

    .nfeArea .page-break {
        page-break-before: always;
    }

    .nfeArea .block {
        display: block;
    }

    .label-mktup {
        font-family: Arial !important;
        font-size: 8px !important;
        padding-top: 8px !important;
    }
</style>
<html>
<body>
<table>
</td>
                    <td rowspan="3" class="txtc txt-upper" style="width: 34mm; height: 29.5mm;">
                        <h3 class="title">Danfe</h3>
                        <p class="mb2">Documento auxiliar da Nota Fiscal Eletrônica </p>
                        <p class="entradaSaida mb2">
                            <span class="identificacao">
                                <span></span>
                            </span>
                            <span class="legenda">
                                <span>0 - Entrada</span>
                                <span>1 - Saída</span>
                            </span>
                        </p>
                        <p>
                            <span class="block bold">
                                <span>Nº</span>
                                <span>'.$numero_nf.'</span>
                            </span>
                            <span class="block bold">
                                <span>SÉRIE:</span>
                                <span>'.$serie.'</span>
                            </span>
                            <span class="block">
                                <span>Página</span>
                                <span></span>
                                <span>de</span>
                                <span></span>
                            </span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="nf-label">CHAVE DE ACESSO</span>
                        <span class="bold block txt-center info">
                        <br>'. $formattedKey .'</span>
                    </td>
                </tr>
                <tr>
                    <td class="txt-center valign-middle">
                        <span class="block">Consulta de autenticidade no portal nacional da NF-e </span> www.nfe.fazenda.gov.br/portal ou no site da Sefaz Autorizada.
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Natureza da Operação -->
        <table cellpadding="0" cellspacing="0" class="boxNaturezaOperacao no-top" border="1">
            <tbody>
                <tr>
                    <td>
                        <span class="nf-label">NATUREZA DA OPERAÇÃO</span>
                        <span class="info">'.$natureza_operacao.'</span>
                    </td>
                    <td style="width: 84.7mm;">
                        <span class="nf-label"></span>
                        <span class="info"></span>
                    </td>
                </tr>
            </tbody>
        </table>
 
        <!-- Inscrição -->
        <table cellpadding="0" cellspacing="0" class="boxInscricao no-top" border="1">
            <tbody>
                <tr>
                    <td>
                        <span class="nf-label">INSCRIÇÃO ESTADUAL</span>
                        <span class="info">'.$ie.'</span>
                    </td>
                    <td style="width: 67.5mm;">
                        <span class="nf-label">INSCRIÇÃO ESTADUAL DO SUBST. TRIB.</span>
                        <span class="info">'. $inscricao_subst_trib .'</span>
                    </td>
                    <td style="width: 64.3mm">
                        <span class="nf-label">CNPJ</span>
                        <span class="info">'.$cnpj.'</span>
                    </td>
                </tr>
            </tbody>
        </table>
 
        <!-- Destinatário/Emitente -->
        <p class="area-name">Destinatário/Emitente</p>
        <table cellpadding="0" cellspacing="0" class="boxDestinatario" border="1">
            <tbody>
                <tr>
                    <td class="pd-0">
                        <table cellpadding="0" cellspacing="0" border="1">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="nf-label">NOME/RAZÃO SOCIAL</span>
                                        <span class="info">'.$nome_cliente.'</span>
                                    </td>
                                    <td style="width: 40mm">
                                        <span class="nf-label">CNPJ/CPF</span>
                                        <span class="info">'.$cnpj.' - '.$cpf.'</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="width: 22mm">
                        <span class="nf-label">DATA DE EMISSÃO</span>
                        <span class="info">'.$data_emissao.'</span>
                    </td>
                </tr>
                <tr>
                    <td class="pd-0">
                        <table cellpadding="0" cellspacing="0" border="1">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="nf-label">ENDEREÇO</span>
                                        <span class="info">'.$logradouro_cliente.'</span>
                                    </td>
                                    <td style="width: 47mm;">
                                        <span class="nf-label">BAIRRO/DISTRITO</span>
                                        <span class="info">'.$bairro_cliente.'</span>
                                    </td>
                                    <td style="width: 37.2 mm">
                                        <span class="nf-label">CEP</span>
                                        <span class="info">'.$cep_cliente.'</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <span class="nf-label">DATA DE ENTR./SAÍDA</span>
                        <span class="info">'.$data_emissao.'</span>
                    </td>
                </tr>
                <tr>
                    <td class="pd-0">
                        <table cellpadding="0" cellspacing="0" style="margin-bottom: -1px;" border="1">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="nf-label">MUNICÍPIO</span>
                                        <span class="info">'.$cidade_cliente.'</span>
                                    </td>
                                    <td style="width: 34mm">
                                        <span class="nf-label">FONE/FAX</span>
                                        <span class="info">'.$numero_cliente.'</span>
                                    </td>
                                    <td style="width: 28mm">
                                        <span class="nf-label">UF</span>
                                        <span class="info">'.$estado_cliente.'</span>
                                    </td>
                                    <td style="width: 51mm">
                                        <span class="nf-label">INSCRIÇÃO ESTADUAL</span>
                                        <span class="info">'.$ie.'</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <span class="nf-label">HORA ENTR./SAÍDA</span>
                        <span id="info">'.$hora_entrada_saida.'</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Fatura -->
        <div class="boxFatura">
            <p class="area-name">Fatura</p>
           
        </div>
 
       
        <p class="area-name">Cálculo do Imposto</p>
        <div class="wrapper-table">
            <table cellpadding="0" cellspacing="0" border="1" class="boxImposto">
                <tbody>
                    <tr>
                        <td>
                            <span class="nf-label label-small">BASE DE CÁLC. DO ICMS</span>
                            <span class="info">'.$base_calculo_icms.'</span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO ICMS</span>
                            <span class="info">'.$valor_icms.'</span>
                        </td>
                        
                        <td>
                            <span class="nf-label label-small">V. TOTAL DE PRODUTOS</span>
                            <span class="info">'.$valor_total_produtos.'</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="nf-label">VALOR DO FRETE</span>
                            <span class="info">'.$valor_frete.'</span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO SEGURO</span>
                            <span class="info">'.$valor_seguro.'</span>
                        </td>
                        <td>
                            <span class="nf-label">DESCONTO</span>
                            <span class="info">'.$desconto.'</span>
                        </td>
                        <td>
                            <span class="nf-label">OUTRAS DESP.</span>
                            <span class="info">'.$outras_despesas.'</span>
                        </td>                    
                        <td>
                            <span class="nf-label label-small">V. TOTAL DA NOTA</span>
                            <span class="info">'.$valor_total.'</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
       
        <!-- Dados do produto/serviço -->
        <p class="area-name">Dados do produto/serviço</p>
        <div class="wrapper-border">
            <table cellpadding="0" cellspacing="0" border="1" class="boxProdutoServico">
                <thead class="listProdutoServico" id="table">
                    <tr class="titles">
                        <th class="cod" style="width: 15.5mm">CÓDIGO</th>
                        <th class="descrit" style="width: 66.1mm">DESCRIÇÃO DO PRODUTO/SERVIÇO</th>
                        <th class="ncmsh">NCMSH</th>
                        <th class="cst">CST</th>
                        <th class="cfop">CFOP</th>
                        <th class="un">UN</th>
                        <th class="amount">QTD.</th>
                        <th class="valUnit">VLR.UNIT</th>
                        <th class="valTotal">VLR.TOTAL</th>
                        <th class="bcIcms">BC ICMS</th>
                        <th class="valIcms">VLR.ICMS</th>
                        <th class="valIpi">VLR.IPI</th>
                        <th class="aliqIcms">ALIQ.ICMS</th>
                        <th class="aliqIpi">ALIQ.IPI</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
 
        <!-- Calculo de ISSQN -->
        <p class="area-name">Calculo do issqn</p>
        <table cellpadding="0" cellspacing="0" border="1" class="boxIssqn">
            <tbody>
                <tr>
                    <td class="field inscrMunicipal">
                        <span class="nf-label">INSCRIÇÃO MUNICIPAL</span>
                        <span class="info txt-center">'. $inscricao_municipal .'</span>
                    </td>
                    <td class="field valorTotal">
                        <span class="nf-label">VALOR TOTAL DOS SERVIÇOS</span>
                        <span class="info txt-right">'.$valor_total.'</span>
                    </td>
                    <td class="field baseCalculo">
                        <span class="nf-label">BASE DE CÁLCULO DO ISSQN</span>
                        <span class="info txt-right">'.$iss_retido.'</span>
                    </td>
                </tr>
            </tbody>
        </table>
 
        <!-- Dados adicionais -->
        <p class="area-name">Dados adicionais</p>
        <table cellpadding="0" cellspacing="0" border="1" class="boxDadosAdicionais">
            <tbody>
                <tr>
                    <td class="field infoComplementar">
                        <span class="nf-label">INFORMAÇÕES COMPLEMENTARES</span>
                        <span>'. $outras_retencoes .'</span>
                    </td>
                </tr>
            </tbody>
        </table>
 
          <footer>
        <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid #000;">
            <tbody>
                <tr>
                    <td style="text-align: center">
                        <span>Codigo de barras: </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>

</body>
</html>
';
    require_once __DIR__ . '/vendor/autoload.php';


    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($nota_fiscal);

    $dompdf->setPaper('A4', 'portrait'); 

    $dompdf->render();

    $diretorio_pdf = __DIR__ . '/notas_fiscais/';
    if (!is_dir($diretorio_pdf)) {
        mkdir($diretorio_pdf, 0755, true); 
    }

    $filename = $diretorio_pdf . "nota_fiscal_" . date('YmdHis') . ".pdf";

    if ($forma_pagamento === 'Boleto Bancário') {
        $barcode_generator = new BarcodeGeneratorPNG();
        $codigo_barras = $barcode_generator->getBarcode('12345678901234567890123456', $barcode_generator::TYPE_CODE_128);
        
        $barcode_base64 = base64_encode($codigo_barras);
        
        $dompdf->getCanvas()->image('data:image/png;base64,' . $barcode_base64, 100, 15, 400, 150);
        
    }
    
    file_put_contents($filename, $dompdf->output());

    echo "<div style='text-align:center;'>
            <h2>Nota Fiscal gerada com sucesso!</h2>
            <p>O PDF foi gerado e salvo com sucesso!</p>
        </div>";

    echo "<script>
            setTimeout(function() {
                window.location.href = 'formulario_nota_fiscal.php'; 
            }, 3000); 
        </script>";

 ?>