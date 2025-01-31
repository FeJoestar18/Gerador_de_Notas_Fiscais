document.addEventListener("DOMContentLoaded", function () {
    function calcularNotaFiscal() {
        console.log("Calculando Nota Fiscal...");

        function getNumber(id) {
            let el = document.getElementById(id);
            return el ? parseFloat(el.value) || 0 : 0;
        }

        let valorUnitario = getNumber("valor_unitario");
        let quantidade = getNumber("quantidade");
        let desconto = getNumber("desconto");
        let frete = getNumber("valor_frete");
        let seguro = getNumber("valor_seguro");
        let outrasDespesas = getNumber("outras_despesas");
        let aliqICMS = getNumber("aliq_icms");
        let aliqIPI = getNumber("aliq_ipi");
        let valorServico = getNumber("valor_servico");
        let aliqISS = getNumber("aliquota_iss");

        let valorTotalProdutos = (valorUnitario * quantidade) - desconto;

        let valorIPI = (aliqIPI / 100) * valorTotalProdutos;

        let baseCalculoICMS = valorTotalProdutos + valorIPI + frete + seguro + outrasDespesas;

        let valorICMS = (aliqICMS / 100) * baseCalculoICMS;

        let valorISS = (aliqISS / 100) * valorServico;

        let valorTotalNota = valorTotalProdutos + valorIPI + valorICMS + valorISS + frete + seguro + outrasDespesas;

        let baseCalculo = baseCalculoICMS + valorISS;

        // 8. Atualizar os campos no HTML
        function setFieldValue(id, value) {
            let el = document.getElementById(id);
            if (el) {
                el.value = value.toFixed(2);
                el.removeAttribute("readonly"); 
            }
        }

        setFieldValue("valor_total_produtos", valorTotalProdutos);
        setFieldValue("valor_ipi", valorIPI);
        setFieldValue("base_calculo_icms", baseCalculoICMS);
        setFieldValue("valor_icms", valorICMS);
        setFieldValue("valor_iss", valorISS);
        setFieldValue("valor_total_nota", valorTotalNota);
        setFieldValue("base_calculo", baseCalculo);
        setFieldValue("valor_total", valorTotalNota);
    }

    let campos = [
        "valor_unitario", "quantidade", "desconto", "valor_frete",
        "valor_seguro", "outras_despesas", "aliq_icms", "aliq_ipi",
        "valor_servico", "aliquota_iss"
    ];

    campos.forEach(id => {
        let el = document.getElementById(id);
        if (el) {
            el.addEventListener("input", calcularNotaFiscal);
        }
    });

    calcularNotaFiscal();
});
