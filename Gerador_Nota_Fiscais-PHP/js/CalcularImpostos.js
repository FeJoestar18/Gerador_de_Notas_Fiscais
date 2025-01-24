         function calcularImpostos() {
           
            const valorServico = parseFloat(document.getElementById("valor_servico").value) || 0;
            const aliquotaISS = parseFloat(document.getElementById("aliquota_iss").value) || 0;

            const valorISS = (valorServico * aliquotaISS) / 100;

            document.getElementById("valor_iss").value = valorISS.toFixed(2);
            document.getElementById("base_calculo").value = valorServico.toFixed(2);
            document.getElementById("valor_total").value = (valorServico + valorISS).toFixed(2);
        }

        window.onload = () => {
            const campos = ["valor_servico", "aliquota_iss"];
            campos.forEach(id => {
                document.getElementById(id).addEventListener("input", calcularImpostos);
            });
        };