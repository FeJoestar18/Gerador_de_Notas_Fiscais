</td>
                    <td rowspan="3" class="txtc txt-upper" style="width: 34mm; height: 29.5mm;">
                        <h3 class="title">Danfe</h3>
                        <p class="mb2">Documento auxiliar da Nota Fiscal Eletrônica </p>
                        <p class="entradaSaida mb2">
                            <span class="identificacao">
                                <span>'.ds_code_operation_type.'</span>
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
                                <span>'.actual_page.'</span>
                                <span>de</span>
                                <span>'.total_pages.'</span>
                            </span>
                        </p>
                    </td>
                    <td class="txt-upper" style="width: 85mm;">
                        <span class="nf-label">Controle do Fisco</span>
                        <span class="codigo">{BarCode}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="nf-label">CHAVE DE ACESSO</span>
                        <span class="bold block txt-center info">'.ds_danfe.'</span>
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
                        <span class="nf-label">'.protocol_label.'</span>
                        <span class="info">'.ds_protocol.'</span>
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
                        <span class="info">'.nl_company_ie_st.'</span>
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
                                        <span class="info">'.ds_client_ie.'</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <span class="nf-label">HORA ENTR./SAÍDA</span>
                        <span id="info">'.hr_input_output.'</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Fatura -->
        <div class="boxFatura">
            <p class="area-name">Fatura</p>
            '.duplicates.'
        </div>
 
        <!-- Calculo do Imposto -->
        <p class="area-name">Calculo do imposto</p>
        <div class="wrapper-table">
            <table cellpadding="0" cellspacing="0" border="1" class="boxImposto">
                <tbody>
                    <tr>
                        <td>
                            <span class="nf-label label-small">BASE DE CÁLC. DO ICMS</span>
                            <span class="info">'.tot_bc_icms.'</span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO ICMS</span>
                            <span class="info">'.tot_icms.'</span>
                        </td>
                        <td>
                            <span class="nf-label label-small" style="font-size: 4pt;">BASE DE CÁLC. DO ICMS ST</span>
                            <span class="info">'.tot_bc_icms_st.'</span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO ICMS ST</span>
                            <span class="info">'.tot_icms_st.'</span>
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
                            <span class="info">'.tot_icms_fcp.'</span>
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
                            <span class="info">'.vl_shipping.'</span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO SEGURO</span>
                            <span class="info">'.vl_insurance.'</span>
                        </td>
                        <td>
                            <span class="nf-label">DESCONTO</span>
                            <span class="info">'.vl_discount.'</span>
                        </td>
                        <td>
                            <span class="nf-label">OUTRAS DESP.</span>
                            <span class="info">'.vl_other_expense.'</span>
                        </td>
                        <td>
                            <span class="nf-label">VALOR DO IPI</span>
                            <span class="info">'.tot_total_ipi_tax.'</span>
                        </td>
                        <td>
                            <span class="nf-label">V. ICMS UF DEST.</span>
                            <span class="info"></span>
                        </td>
                        <td>
                            <span class="nf-label label-small">V. APROX. DO TRIBUTO</span>
                            <span class="info">{ApproximateTax}</span>
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
                    '.items.'
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
                        <span class="info txt-center">'.ds_company_im.'</span>
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
                        <span class="info txt-right">'.tot_issqn.'</span>
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