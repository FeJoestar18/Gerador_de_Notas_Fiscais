<?php
include('conexao.php');
use Picqer\Barcode\BarcodeGeneratorPNG;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Dados do Prestador de Serviços
    $nome_empresa = $_POST['nome_empresa'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cnpj = $_POST['cnpj'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $ie = $_POST['ie'];

    // Dados do Tomador de Serviços
    $nome_cliente = $_POST['nome_cliente'];
    $cpf_cliente = $_POST['cpf_cliente'];
    $cnpj_cliente = $_POST['cnpj'];
    $cep_cliente = $_POST['cep_cliente'];
    $logradouro_cliente = $_POST['logradouro_cliente'];
    $numero_cliente = $_POST['numero_cliente'];
    $endereco_cliente = $_POST['endereco_cliente'];
    $bairro_cliente = $_POST['bairro_cliente'];
    $cidade_cliente = $_POST['cidade_cliente'];
    $estado_cliente = $_POST['estado_cliente'];

    // Dados do Serviço Prestado
    $descricao_servico = $_POST['descricao_servico'];
    $codigo_servico = $_POST['codigo_servico'];
    $valor_servico = $_POST['valor_servico'];
    $aliquota_iss = $_POST['aliquota_iss'];
    $valor_iss = $_POST['valor_iss'];
    $base_calculo = $_POST['base_calculo'];

    // Informações Fiscais e Tributárias
    $natureza_operacao = $_POST['natureza_operacao'];
    $regime_tributacao = $_POST['regime_tributacao'];
    $optante_simples = $_POST['optante_simples'];
    $iss_retido = $_POST['iss_retido'];
    $responsavel_iss = $_POST['responsavel_iss'];

    // Outras Informações
    $data_emissao = $_POST['data_emissao'];
    $numero_nf = $_POST['numero_nf'];
    $serie = $_POST['serie'];
    $codigo_verificacao = $_POST['codigo_verificacao'];

    // Outras Incidências
    $outras_retencoes = $_POST['outras_retencoes'];

    // Formas de Pagamento
    $formato_saida = $_POST['formato_saida'];
    $forma_pagamento = $_POST['forma_pagamento'];
    $valor_total = $_POST['valor_total'];

    if (!validarCNPJ($cnpj)) {
        echo "<script>alert('CNPJ inválido!'); window.history.back();</script>";
        exit;
    }

    if (!validarCPF($cpf)) {
        echo "<script>alert('CPF inválido!'); window.history.back();</script>";
        exit;
    }

}


$nota_fiscal = "
<div class='nota-fiscal'>
    <header>
        <h1>Nota Fiscal</h1>
        <div class='empresa'>
            <h2>$nome_empresa</h2>
            <p>CEP: $cep</p>
            <p>$logradouro, $numero - $bairro</p>
            <p>$cidade - $estado</p>
            <p>CNPJ: $cnpj | CPF: $cpf</p>
            <p>IE: $ie | Telefone: $telefone</p>
        </div>
    </header>

    <section class='tomador'>
        <h2>Tomador de Serviços</h2>
        <div class='cliente'>
            <p>$nome_cliente</p>
            <p>CPF: $cpf_cliente </p>
            <p>$cep_cliente - $logradouro_cliente, $numero_cliente</p>
            <p>$bairro_cliente - $cidade_cliente/$estado_cliente</p>
        </div>
        <p class='valor-total'>Valor Total: R$ " . number_format($valor_total, 2, ',', '.') . "</p>
    </section>

    <section class='servico'>
        <h2>Dados do Serviço Prestado</h2>
        <div class='detalhes-servico'>
            <p>Descrição do Serviço: $descricao_servico</p>
            <p>Código do Serviço: $codigo_servico</p>
            <p>Valor do Serviço: R$ " . number_format($valor_servico, 2, ',', '.') . "</p>
            <p>Alíquota ISS: $aliquota_iss</p>
            <p>Valor do ISS: R$ " . number_format($valor_iss, 2, ',', '.') . "</p>
            <p>Base de Cálculo: R$ " . number_format($base_calculo, 2, ',', '.') . "</p>
        </div>
    </section>

    <section class='fiscal'>
        <h2>Informações Fiscais e Tributárias</h2>
        <div class='info-fiscal'>
            <p>Natureza da Operação: $natureza_operacao</p>
            <p>Regime Especial de Tributação: $regime_tributacao</p>
            <p>Optante pelo Simples Nacional: $optante_simples</p>
            <p>ISS Retido: $iss_retido</p>
            <p>Responsável pelo Recolhimento do ISS: $responsavel_iss</p>
        </div>
    </section>

    <section class='outras'>
        <h2>Outras Informações</h2>
        <div class='info-outras'>
            <p>Data de Emissão: $data_emissao</p>
            <p>Número da Nota Fiscal: $numero_nf</p>
            <p>Série: $serie</p>
            <p>Código de Verificação: $codigo_verificacao</p>
            <p>Outras Retenções: $outras_retencoes</p>
        </div>
    </section>
</div>

<style>
    .nota-fiscal {
        font-family: Arial, sans-serif;
        border: 1px solid #ccc;
        padding: 20px;
        max-width: 800px;
        margin: 0 auto;
    }

    .nota-fiscal h1, .nota-fiscal h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .nota-fiscal .empresa, .nota-fiscal .cliente, .nota-fiscal .detalhes-servico, .nota-fiscal .info-fiscal, .nota-fiscal .info-outras {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
    }

    .nota-fiscal .valor-total {
        text-align: right;
        font-weight: bold;
    }
</style>
";

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

?>
