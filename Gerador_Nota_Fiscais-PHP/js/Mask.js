  document.getElementById('cpf').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
      value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); 
    }
    event.target.value = value;
  });

  document.getElementById('cnpj').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, ''); 
    if (value.length <= 14) {
      value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
    }
    event.target.value = value;
  });

  document.getElementById('telefone').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
      value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    }
    event.target.value = value;
  });

  document.getElementById('ie').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, '');
    if (value.length <= 9) {
      value = value.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');  Estadual
    }
    event.target.value = value;
  });

  document.getElementById('cpf_cliente').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
      value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); 
    }
    event.target.value = value;
  });

  document.getElementById('valor_servico').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, ''); 
    if (value.length > 2) {
      value = value.replace(/(\d)(\d{2})$/, '$1,$2');
      value = value.replace(/(\d)(\d{3})(\d{3})$/, '$1.$2.$3'); 
      value = value.replace(/(\d)(\d{3})$/, '$1.$2'); 
    }
    event.target.value = 'R$ ' + value;
  });
  document.getElementById('valor_iss').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, ''); 
    if (value.length > 2) {
      value = value.replace(/(\d)(\d{2})$/, '$1,$2'); 
      value = value.replace(/(\d)(\d{3})(\d{3})$/, '$1.$2.$3'); 
      value = value.replace(/(\d)(\d{3})$/, '$1.$2'); 
    }
    event.target.value = 'R$ ' + value;
  });
  document.getElementById('base_calculo').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, ''); 
    if (value.length > 2) {
      value = value.replace(/(\d)(\d{2})$/, '$1,$2'); 
      value = value.replace(/(\d)(\d{3})(\d{3})$/, '$1.$2.$3'); 
      value = value.replace(/(\d)(\d{3})$/, '$1.$2'); 
    }
    event.target.value = 'R$ ' + value;
  });
  ocument.getElementById('valor_total').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, ''); 
    if (value.length > 2) {
      value = value.replace(/(\d)(\d{2})$/, '$1,$2'); 
      value = value.replace(/(\d)(\d{3})(\d{3})$/, '$1.$2.$3'); 
      value = value.replace(/(\d)(\d{3})$/, '$1.$2'); 
    }
    event.target.value = 'R$ ' + value;
  });
  document.getElementById('data_emissao').addEventListener('input', function(event) {
    let value = event.target.value.replace(/\D/g, ''); 
    if (value.length <= 8) {
      value = value.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3'); 
    }
    event.target.value = value;
  });

