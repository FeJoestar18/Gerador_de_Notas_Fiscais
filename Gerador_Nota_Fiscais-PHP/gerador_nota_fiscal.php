<?php
include('conexao.php');

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
    $endereco = $_POST['endereco'];
    $cnpj = $_POST['cnpj'];
    $nome_cliente = $_POST['nome_cliente'];
    $cpf = $_POST['cpf'];
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
