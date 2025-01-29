document.addEventListener("DOMContentLoaded", function () {
    function calcularNotaFiscal() {
        console.log("Calculando Nota Fiscal..."); // Para verificar se a função está sendo chamada

        // Função para pegar valores sem dar erro de NaN
        function getNumber(id) {
            let el = document.getElementById(id);
            return el ? parseFloat(el.value) || 0 : 0;
        }

        // Pegar valores do formulário
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

        // 1. Calcular o valor total de produtos
        let valorTotalProdutos = (valorUnitario * quantidade) - desconto;

        // 2. Calcular o IPI
        let valorIPI = (aliqIPI / 100) * valorTotalProdutos;

        // 3. Base de Cálculo do ICMS
        let baseCalculoICMS = valorTotalProdutos + valorIPI + frete + seguro + outrasDespesas;

        // 4. Calcular o ICMS
        let valorICMS = (aliqICMS / 100) * baseCalculoICMS;

        // 5. Calcular o ISS (caso tenha serviços)
        let valorISS = (aliqISS / 100) * valorServico;

        // 6. Calcular o Valor Total da Nota
        let valorTotalNota = valorTotalProdutos + valorIPI + valorICMS + valorISS + frete + seguro + outrasDespesas;

        // 7. Calcular a Base de Cálculo total
        let baseCalculo = baseCalculoICMS + valorISS;

        // 8. Atualizar os campos no HTML
        function setFieldValue(id, value) {
            let el = document.getElementById(id);
            if (el) {
                el.value = value.toFixed(2);
                el.removeAttribute("readonly"); // Remove readonly caso necessário
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

    // Adicionar eventos para recalcular quando os valores mudarem
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

    // Chamar a função uma vez ao carregar
    calcularNotaFiscal();
});
