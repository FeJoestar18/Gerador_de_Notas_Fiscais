function calcularValores() {

    const valorServico = parseFloat(document.getElementById("valor_servico").value) || 0;
    const aliquotaISS = parseFloat(document.getElementById("aliquota_iss").value) || 0;
    const outrasRetencoes = parseFloat(document.getElementById("outras_retencoes").value) || 0;

    const valorISS = (valorServico * aliquotaISS) / 100;

    document.getElementById("valor_iss").value = valorISS.toFixed(2);
    document.getElementById("base_calculo").value = valorServico.toFixed(2);

    const valorTotal = valorServico + valorISS + outrasRetencoes;

    document.getElementById("valor_total").value = valorTotal.toFixed(2);

    const baseCalculoICMS = calcularBaseCalculoICMS(valorServico, parseFloat(document.getElementById("desconto").value) || 0, parseFloat(document.getElementById("outras_despesas").value) || 0, parseFloat(document.getElementById("valor_frete").value) || 0, parseFloat(document.getElementById("valor_seguro").value) || 0);
    document.getElementById("base_calculo_icms").value = baseCalculoICMS.toFixed(2);

    const valorICMS = calcularICMS(baseCalculoICMS, parseFloat(document.getElementById("aliquota_icms").value) || 0);
    document.getElementById("valor_icms").value = valorICMS.toFixed(2);

    const baseCalculoICMSST = calcularBaseCalculoICMSST(baseCalculoICMS, parseFloat(document.getElementById("mva").value) || 0);
    document.getElementById("base_calculo_icms_st").value = baseCalculoICMSST.toFixed(2);

    const valorICMSST = calcularICMSST(baseCalculoICMSST, parseFloat(document.getElementById("aliquota_icms_st").value) || 0, valorICMS);
    document.getElementById("valor_icms_st").value = valorICMSST.toFixed(2);

    const valorFCP = calcularFCP(baseCalculoICMS, parseFloat(document.getElementById("aliquota_fcp").value) || 0);
    document.getElementById("valor_fcp").value = valorFCP.toFixed(2);

    const valorIPI = calcularIPI(valorServico, parseFloat(document.getElementById("aliquota_ipi").value) || 0);
    document.getElementById("valor_ipi").value = valorIPI.toFixed(2);

    const valorPIS = calcularPIS(valorServico, parseFloat(document.getElementById("aliquota_pis").value) || 0);
    document.getElementById("valor_pis").value = valorPIS.toFixed(2);

    const valorCOFINS = calcularCOFINS(valorServico, parseFloat(document.getElementById("aliquota_cofins").value) || 0);
    document.getElementById("valor_cofins").value = valorCOFINS.toFixed(2);

    const valorTotalNota = calcularTotalNota(valorServico, valorICMS, valorICMSST, valorIPI, valorFCP, valorPIS, valorCOFINS, parseFloat(document.getElementById("valor_frete").value) || 0, parseFloat(document.getElementById("valor_seguro").value) || 0, parseFloat(document.getElementById("outras_despesas").value) || 0);
    document.getElementById("valor_total_nota").value = valorTotalNota.toFixed(2);
}

window.onload = () => {
    const campos = ["valor_servico", "aliquota_iss", "outras_retencoes", "desconto", "outras_despesas", "valor_frete", "valor_seguro", "aliquota_icms", "mva", "aliquota_icms_st", "aliquota_fcp", "aliquota_ipi", "aliquota_pis", "aliquota_cofins"];
    campos.forEach(id => {
        document.getElementById(id).addEventListener("input", calcularValores);
    });
}