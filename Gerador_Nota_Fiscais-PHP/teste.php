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
                    <td class="txt-upper" style="width: 85mm;">
                        <span class="nf-label">Controle do Fisco</span>
                        <span class="codigo"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="nf-label">CHAVE DE ACESSO</span>
                        <span class="bold block txt-center info">'. $key .'</span>
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
                        <span class="info"></span>
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
                                        <span class="info"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <span class="nf-label">HORA ENTR./SAÍDA</span>
                        <span id="info"></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Fatura -->
        <div class="boxFatura">
            <p class="area-name">Fatura</p>
           
        </div>
 
       
        <p class="area-name">Calculo do imposto</p>
        <div class="wrapper-table">
            <table cellpadding="0" cellspacing="0" border="1" class="boxImposto">
                <tbody>
                    <tr>
                        <td>
                            <span class="nf-label label-small">BASE DE CÁLC. DO ICMS</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO ICMS</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label label-small" style="font-size: 4pt;">BASE DE CÁLC. DO ICMS ST</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO ICMS ST</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label label-small">V. IMP. IMPORTAÇÃO</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label label-small">V. ICMS UF REMET.</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO FCP</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO PIS</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label label-small">V. TOTAL DE PRODUTOS</span>
                            <span class="info">'.$valor_total.'</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="nf-label">VALOR DO FRETE</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO SEGURO</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">DESCONTO</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">OUTRAS DESP.</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO IPI</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label">V. ICMS UF DEST.</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label label-small">V. APROX. DO TRIBUTO</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label label-small">VALOR DA CONFINS</span>
                            <span class="info"></span>
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
                    <td class="field valorIssqn">
                        <span class="nf-label">VALOR DO ISSQN</span>
                        <span class="info txt-right"></span>
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
                        <span>'.$outras_retencoes.'</span>
                    </td>
                    <td class="field reservaFisco" style="width: 85mm; height: 24mm">
                        <span class="nf-label">RESERVA AO FISCO</span>
                        <span></span>
                    </td>
                </tr>
            </tbody>
        </table>
 
        <footer>
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="text-align: right"><strong>Empresa de Software www.empresa.com</strong></td>
                    </tr>
                </tbody>
            </table>
        </footer>
    </div>
    
</div>
</table>
</body>
</html>