import { de } from "@faker-js/faker";

function gerarCpfValido() {
    
    const parte1 = Math.floor(Math.random() * 900 + 100);
    const parte2 = Math.floor(Math.random() * 900 + 100); 
    const parte3 = Math.floor(Math.random() * 900 + 100); 

    const cpfBase = `${parte1}${parte2}${parte3}`;
    function calcularDigito(cpf) {
        let soma = 0;
        let multiplicador = cpf.length + 1;
        for (let i = 0; i < cpf.length; i++) {
            soma += parseInt(cpf.charAt(i)) * multiplicador--;
        }
        let resto = soma % 11;
        return resto < 2 ? 0 : 11 - resto;
    }

    const digito1 = calcularDigito(cpfBase);

    const digito2 = calcularDigito(cpfBase + digito1);

    return `${cpfBase}${digito1}${digito2}`;
}

export default gerarCpfValido;