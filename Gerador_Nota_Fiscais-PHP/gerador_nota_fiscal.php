<?php
include('conexao.php');
use Picqer\Barcode\BarcodeGeneratorPNG;
require_once __DIR__ . '/vendor/autoload.php';

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
 class CustomPDF extends TCPDF {
        public function Header() {
            $this->SetFont('helvetica', 'B', 12);
            $this->Image('path/to/logo.png', 10, 10, 30);
            $this->Cell(0, 15, 'NOTA FISCAL ELETRÔNICA DE SERVIÇOS', 0, 1, 'C', false, '', 1, false, 'T', 'M');
            $this->SetFont('helvetica', '', 10);
            $this->Cell(0, 10, 'Prefeitura do Município de São Paulo - Secretaria Municipal de Finanças', 0, 1, 'C');
            $this->Ln(5);
            
        }
    
        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');
        }

        public function body() {
           
        }

    }

    $pdf = new CustomPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetMargins(10, 20, 10);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->AddPage();

    $html = "
    <style>
        .nota-fiscal { font-size: 10pt; line-height: 1.6; }
        .header, .footer { text-align: center; }
        .section-title { font-weight: bold; font-size: 11pt; margin-top: 10px; }
        .dados { margin: 10px 0; }
        .dados p { margin: 2px 0; }
        .table { width: 100%; border: 1px solid #000; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
    
    <div class='nota-fiscal'>
        <div class='dados'>
            <p><strong>Data de Emissão:</strong> $data_emissao</p>
            <p><strong>Número da Nota:</strong> $numero_nf</p>
            <p><strong>Código de Verificação:</strong> $codigo_verificacao</p>
        </div>
    
        <h2 class='section-title'>Prestador de Serviços</h2>
        <div class='dados'>
            <p><strong>Nome/Razão Social:</strong> $nome_empresa</p>
            <p><strong>CNPJ:</strong> $cnpj</p>
            <p><strong>Endereço:</strong> $logradouro, $numero - $bairro</p>
            <p><strong>Cidade/Estado:</strong> $cidade/$estado</p>
            <p><strong>CEP:</strong> $cep</p>
            <p><strong>Telefone:</strong> $telefone</p>
        </div>
    
        <h2 class='section-title'>Tomador de Serviços</h2>
        <div class='dados'>
            <p><strong>Nome/Razão Social:</strong> $nome_cliente</p>
            <p><strong>CPF:</strong> $cpf_cliente</p>
            <p><strong>Endereço:</strong> $logradouro_cliente, $numero_cliente - $bairro_cliente</p>
            <p><strong>Cidade/Estado:</strong> $cidade_cliente/$estado_cliente</p>
            <p><strong>CEP:</strong> $cep_cliente</p>
        </div>
    
        <h2 class='section-title'>Detalhes do Serviço Prestado</h2>
        <div class='dados'>
            <p><strong>Descrição do Serviço:</strong> $descricao_servico</p>
            <p><strong>Código do Serviço:</strong> $codigo_servico</p>
            <p><strong>Valor do Serviço:</strong> R$ " . number_format($valor_servico, 2, ',', '.') . "</p>
            <p><strong>Alíquota ISS:</strong> $aliquota_iss%</p>
            <p><strong>Valor do ISS:</strong> R$ " . number_format($valor_iss, 2, ',', '.') . "</p>
            <p><strong>Base de Cálculo:</strong> R$ " . number_format($base_calculo, 2, ',', '.') . "</p>
        </div>
    
        <!-- Tabela de serviços -->
        <h2 class='section-title'>Serviços</h2>
        <table class='table'>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$descricao_servico</td>
                    <td>R$ " . number_format($valor_servico, 2, ',', '.') . "</td>
                </tr>
            </tbody>
        </table>
    </div>
    ";

    $pdf->writeHTML($html, true, false, true, false, '');

    if ($forma_pagamento === 'Boleto Bancário') {
        $barcode_generator = new BarcodeGeneratorPNG();
        $codigo_barras = $barcode_generator->getBarcode('12345678901234567890123456', $barcode_generator::TYPE_CODE_128);
        $pdf->Image('@' . $codigo_barras, 15, 240, 180, 30, 'PNG');
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

    exit();
    }
?>