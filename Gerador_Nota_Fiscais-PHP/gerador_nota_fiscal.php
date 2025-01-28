<?php
include('conexao.php');
use Dompdf\Dompdf;
use Dompdf\Options;
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

function GerarChavedeAcesso() {
    $key;

    for ($i = 0; $i < 44; $i++) {
        $key .= rand(0, 9);
    }

    return $key;
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
    $inscricao_municipal = isset($_POST['inscricao_municipal']) ? $_POST['inscricao_municipal'] : '';

    // Outras Incidências
    $outras_retencoes = isset($_POST['outras_retencoes']) ? $_POST['outras_retencoes'] : '';
    $inscricao_subst_trib = isset($_POST['inscricao_subst_trib']) ? $_POST['inscricao_subst_trib'] : '';
    $inscricao_estadual = isset($_POST['inscricao_estadual']) ? $_POST['inscricao_estadual'] : '';
    $hora_entrada_saida = isset($_POST['hora_entrada_saida']) ? $_POST['hora_entrada_saida'] : '';
    $base_calculo_icms = isset($_POST['base_calculo_icms']) ? $_POST['base_calculo_icms'] : '';
    $valor_icms = isset($_POST['valor_icms']) ? $_POST['valor_icms'] : '';
    $base_calculo_icms_st = isset($_POST['base_calculo_icms_st']) ? $_POST['base_calculo_icms_st'] : '';
    $valor_icms_st = isset($_POST['valor_icms_st']) ? $_POST['valor_icms_st'] : '';
    $valor_importacao = isset($_POST['valor_importacao']) ? $_POST['valor_importacao'] : '';
    $valor_icms_uf_remet = isset($_POST['valor_icms_uf_remet']) ? $_POST['valor_icms_uf_remet'] : '';
    $valor_fcp = isset($_POST['valor_fcp']) ? $_POST['valor_fcp'] : '';
    $valor_pis = isset($_POST['valor_pis']) ? $_POST['valor_pis'] : '';
    $valor_total_produtos = isset($_POST['valor_total_produtos']) ? $_POST['valor_total_produtos'] : '';
    $valor_frete = isset($_POST['valor_frete']) ? $_POST['valor_frete'] : '';
    $valor_seguro = isset($_POST['valor_seguro']) ? $_POST['valor_seguro'] : '';
    $desconto = isset($_POST['desconto']) ? $_POST['desconto'] : '';
    $outras_despesas = isset($_POST['outras_despesas']) ? $_POST['outras_despesas'] : '';
    $valor_ipi = isset($_POST['valor_ipi']) ? $_POST['valor_ipi'] : '';
    $valor_icms_uf_dest = isset($_POST['valor_icms_uf_dest']) ? $_POST['valor_icms_uf_dest'] : '';
    $valor_aprox_tributo = isset($_POST['valor_aprox_tributo']) ? $_POST['valor_aprox_tributo'] : '';
    $valor_confins = isset($_POST['valor_confins']) ? $_POST['valor_confins'] : '';
    $valor_total_nota = isset($_POST['valor_total_nota']) ? $_POST['valor_total_nota'] : '';
    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
    $descricao_produto = isset($_POST['descricao_produto']) ? $_POST['descricao_produto'] : '';
    $ncms = isset($_POST['ncms']) ? $_POST['ncms'] : '';
    $cst = isset($_POST['cst']) ? $_POST['cst'] : '';
    $cfop = isset($_POST['cfop']) ? $_POST['cfop'] : '';
    $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
    $valor_unitario = isset($_POST['valor_unitario']) ? $_POST['valor_unitario'] : '';
    $valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : '';
    $bc_icms = isset($_POST['bc_icms']) ? $_POST['bc_icms'] : '';
    $valor_icms_final = isset($_POST['valor_icms_final']) ? $_POST['valor_icms_final'] : '';
    $valor_ipi_final = isset($_POST['valor_ipi_final']) ? $_POST['valor_ipi_final'] : '';
    $aliq_icms = isset($_POST['aliq_icms']) ? $_POST['aliq_icms'] : '';
    $aliq_ipi = isset($_POST['aliq_ipi']) ? $_POST['aliq_ipi'] : '';
    $reserva_fisco = isset($_POST['reserva_fisco']) ? $_POST['reserva_fisco'] : '';

    // Formas de Pagamento
    $formato_saida = isset($_POST['formato_saida']) ? $_POST['formato_saida'] : '';
    $forma_pagamento = isset($_POST['forma_pagamento']) ? $_POST['forma_pagamento'] : '';
    $valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : '';

    $key = GerarChavedeAcesso();

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
    <table>
        <tr>
            <th>Nome da Empresa</th>
            <td>' . $nome_empresa . '</td>
        </tr>
        <tr>
            <th>CEP</th>
            <td>' . $cep . '</td>
        </tr>
        <tr>
            <th>Logradouro</th>
            <td>' . $logradouro . '</td>
        </tr>
        <tr>
            <th>Número</th>
            <td>' . $numero . '</td>
        </tr>
        <tr>
            <th>Bairro</th>
            <td>' . $bairro . '</td>
        </tr>
        <tr>
            <th>Cidade</th>
            <td>' . $cidade . '</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>' . $estado . '</td>
        </tr>
        <tr>
            <th>CNPJ</th>
            <td>' . $cnpj . '</td>
        </tr>
        <tr>
            <th>CPF</th>
            <td>' . $cpf . '</td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td>' . $telefone . '</td>
        </tr>
        <tr>
            <th>Inscrição Estadual</th>
            <td>' . $ie . '</td>
        </tr>

        <tr>
            <th>Nome do Cliente</th>
            <td>' . $nome_cliente . '</td>
        </tr>
        <tr>
            <th>CPF do Cliente</th>
            <td>' . $cpf_cliente . '</td>
        </tr>
        <tr>
            <th>CNPJ do Cliente</th>
            <td>' . $cnpj_cliente . '</td>
        </tr>
        <tr>
            <th>CEP do Cliente</th>
            <td>' . $cep_cliente . '</td>
        </tr>
        <tr>
            <th>Logradouro do Cliente</th>
            <td>' . $logradouro_cliente . '</td>
        </tr>
        <tr>
            <th>Número do Cliente</th>
            <td>' . $numero_cliente . '</td>
        </tr>
        <tr>
            <th>Bairro do Cliente</th>
            <td>' . $bairro_cliente . '</td>
        </tr>
        <tr>
            <th>Cidade do Cliente</th>
            <td>' . $cidade_cliente . '</td>
        </tr>
        <tr>
            <th>Estado do Cliente</th>
            <td>' . $estado_cliente . '</td>
        </tr>

        <tr>
            <th>Descrição do Serviço</th>
            <td>' . $descricao_servico . '</td>
        </tr>
        <tr>
            <th>Código do Serviço</th>
            <td>' . $codigo_servico . '</td>
        </tr>
        <tr>
            <th>Valor do Serviço</th>
            <td>' . $valor_servico . '</td>
        </tr>
        <tr>
            <th>Alíquota de ISS</th>
            <td>' . $aliquota_iss . '</td>
        </tr>
        <tr>
            <th>Valor de ISS</th>
            <td>' . $valor_iss . '</td>
        </tr>
        <tr>
            <th>Base de Cálculo</th>
            <td>' . $base_calculo . '</td>
        </tr>

        <tr>
            <th>Natureza da Operação</th>
            <td>' . $natureza_operacao . '</td>
        </tr>
        <tr>
            <th>Regime de Tributação</th>
            <td>' . $regime_tributacao . '</td>
        </tr>
        <tr>
            <th>Optante Simples</th>
            <td>' . $optante_simples . '</td>
        </tr>
        <tr>
            <th>ISS Retido</th>
            <td>' . $iss_retido . '</td>
        </tr>
        <tr>
            <th>Responsável pelo ISS</th>
            <td>' . $responsavel_iss . '</td>
        </tr>

        <tr>
            <th>Data de Emissão</th>
            <td>' . $data_emissao . '</td>
        </tr>
        <tr>
            <th>Número da NF</th>
            <td>' . $numero_nf . '</td>
        </tr>
        <tr>
            <th>Série</th>
            <td>' . $serie . '</td>
        </tr>
        <tr>
            <th>Código de Verificação</th>
            <td>' . $codigo_verificacao . '</td>
        </tr>
        <tr>
            <th>Inscrição Municipal</th>
            <td>' . $inscricao_municipal . '</td>
        </tr>

        <tr>
            <th>Outras Retenções</th>
            <td>' . $outras_retencoes . '</td>
        </tr>
        <tr>
            <th>Inscrição Substituição Tributária</th>
            <td>' . $inscricao_subst_trib . '</td>
        </tr>
        <tr>
            <th>Inscrição Estadual</th>
            <td>' . $inscricao_estadual . '</td>
        </tr>
        <tr>
            <th>Hora de Entrada e Saída</th>
            <td>' . $hora_entrada_saida . '</td>
        </tr>
        <tr>
            <th>Base de Cálculo ICMS</th>
            <td>' . $base_calculo_icms . '</td>
        </tr>
        <tr>
            <th>Valor ICMS</th>
            <td>' . $valor_icms . '</td>
        </tr>
        <tr>
            <th>Base de Cálculo ICMS Substituição Tributária</th>
            <td>' . $base_calculo_icms_st . '</td>
        </tr>
        <tr>
            <th>Valor ICMS Substituição Tributária</th>
            <td>' . $valor_icms_st . '</td>
        </tr>
        <tr>
            <th>Valor de Importação</th>
            <td>' . $valor_importacao . '</td>
        </tr>
        <tr>
            <th>Valor ICMS UF Remetente</th>
            <td>' . $valor_icms_uf_remet . '</td>
        </tr>
        <tr>
            <th>Valor FCP</th>
            <td>' . $valor_fcp . '</td>
        </tr>
        <tr>
            <th>Valor PIS</th>
            <td>' . $valor_pis . '</td>
        </tr>
        <tr>
            <th>Valor Total dos Produtos</th>
            <td>' . $valor_total_produtos . '</td>
        </tr>
        <tr>
            <th>Valor Frete</th>
            <td>' . $valor_frete . '</td>
        </tr>
        <tr>
            <th>Valor Seguro</th>
            <td>' . $valor_seguro . '</td>
        </tr>
        <tr>
            <th>Desconto</th>
            <td>' . $desconto . '</td>
        </tr>
        <tr>
            <th>Outras Despesas</th>
            <td>' . $outras_despesas . '</td>
        </tr>
        <tr>
            <th>Valor IPI</th>
            <td>' . $valor_ipi . '</td>
        </tr>
        <tr>
            <th>Valor ICMS UF Destinatário</th>
            <td>' . $valor_icms_uf_dest . '</td>
        </tr>
        <tr>
            <th>Valor Aproximado de Tributos</th>
            <td>' . $valor_aprox_tributo . '</td>
        </tr>
        <tr>
            <th>Valor Cofins</th>
            <td>' . $valor_confins . '</td>
        </tr>
        <tr>
            <th>Valor Total da Nota</th>
            <td>' . $valor_total_nota . '</td>
        </tr>

        <tr>
            <th>Código</th>
            <td>' . $codigo . '</td>
        </tr>
        <tr>
            <th>Descrição do Produto</th>
            <td>' . $descricao_produto . '</td>
        </tr>
        <tr>
            <th>NCMS</th>
            <td>' . $ncms . '</td>
        </tr>
        <tr>
            <th>CST</th>
            <td>' . $cst . '</td>
        </tr>
        <tr>
            <th>CFOP</th>
            <td>' . $cfop . '</td>
        </tr>
        <tr>
            <th>Unidade</th>
            <td>' . $unidade . '</td>
        </tr>
        <tr>
            <th>Quantidade</th>
            <td>' . $quantidade . '</td>
        </tr>
        <tr>
            <th>Valor Unitário</th>
            <td>' . $valor_unitario . '</td>
        </tr>
        <tr>
            <th>Valor Total</th>
            <td>' . $valor_total . '</td>
        </tr>
        <tr>
            <th>Base de Cálculo ICMS</th>
            <td>' . $bc_icms . '</td>
        </tr>
        <tr>
            <th>Valor Final ICMS</th>
            <td>' . $valor_icms_final . '</td>
        </tr>
        <tr>
            <th>Valor Final IPI</th>
            <td>' . $valor_ipi_final . '</td>
        </tr>
        <tr>
            <th>Alíquota ICMS</th>
            <td>' . $aliq_icms . '</td>
        </tr>
        <tr>
            <th>Alíquota IPI</th>
            <td>' . $aliq_ipi . '</td>
        </tr>
        <tr>
            <th>Reserva Fisco</th>
            <td>' . $reserva_fisco . '</td>
        </tr>
    </table>
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

        $image_data = 'data:image/png;base64,' . $barcode_base64;
        $dompdf->getCanvas()->image($image_data, 100, 250, 200, 30); 
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
}
?>