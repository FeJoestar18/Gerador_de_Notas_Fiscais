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
    $nome_cliente = $_POST['nome_cliente'];
    $cpf_ou_cnpj = $_POST['cpf_ou_cnpj'];
    $cpf_cliente = $_POST['cpf'];
    $cnpj_cliente = $_POST['cnpj'];
    $cep_cliente = $_POST['cep'];
    $logradouro_cliente = $_POST['logradouro'];
    $numero_cliente = $_POST['numero'];
    $endereco_cliente = $_POST['endereco'];
    $bairro_cliente = $_POST['bairro'];
    $cidade_cliente = $_POST['cidade'];
    $estado_cliente = $_POST['estado'];
    $valor_total = $_POST['valor_total'];
    $descricao_servico = $_POST['descricao_servico'];
    $codigo_servico = $_POST['codigo_servico'];
    $valor_servico = $_POST['valor_servico'];
    $aliquota_iss = $_POST['aliquota_iss'];
    $valor_iss = $_POST['valor_iss'];
    $base_calculo = $_POST['base_calculo'];
    $natureza_operacao = $_POST['natureza_operacao'];
    $regime_tributacao = $_POST['regime_tributacao'];
    $optante_simples = $_POST['optante_simples'];
    $iss_retido = $_POST['iss_retido'];
    $responsavel_iss = $_POST['responsavel_iss'];
    $data_emissao = $_POST['data_emissao'];
    $numero_nf = $_POST['numero_nf'];
    $serie = $_POST['serie'];
    $codigo_verificacao = $_POST['codigo_verificacao'];
    $outras_retencoes = $_POST['outras_retencoes'];
    $formato_saida = $_POST['formato_saida'];
    $forma_pagamento = $_POST['forma_pagamento'];

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
        <h2>Nota Fiscal</h2>
        <table>
            <tr><th>Empresa</th><td>$nome_empresa</td></tr>
            <tr><th>Endereço</th><td>$endereco</td></tr>
            <tr><th>CNPJ</th><td>$cnpj</td></tr>
            <tr><th>Cliente</th><td>$nome_cliente</td></tr>
            <tr><th>CPF</th><td>$cpf</td></tr>
            <tr><th>Forma de Pagamento</th><td>$forma_pagamento</td></tr>
            <tr><th>Valor Total</th><td>R$ " . number_format($valor_total, 2, ',', '.') . "</td></tr>
        </table>
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
}
?>
