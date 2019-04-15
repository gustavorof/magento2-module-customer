require(["jquery"], function($) {

    var cpfField = "#taxvat";
    var cnpjField = "#cnpj";

    $(document).on('keyup', cpfField, function(e) {
        $(cpfField).val(formatacaoParaNumero($(cpfField).val()));
    });

    $(document).on('focus', cpfField, function(e) {
        $(cpfField).val(formatacaoParaNumero($(cpfField).val()));
    });

    $(document).on('blur', cpfField, function(e) {
        cpfCnpj = $(cpfField).val();
        if(cpfCnpj !="") {
            if(!validaCPF(cpfCnpj)) {
                $(cpfField).addClass('mage-error');
                $(cpfField).val("");
            } else {
                $(cpfField).removeClass('mage-error');
                $(cpfField).val(formatacaoCpfCnpj(cpfCnpj));
            }
        }
    });

    $(document).on('keyup', cnpjField, function(e) {
        $(cnpjField).val(formatacaoParaNumero($(cnpjField).val()));
    });

    $(document).on('focus', cnpjField, function(e) {
        $(cnpjField).val(formatacaoParaNumero($(cnpjField).val()));
    });

    $(document).on('blur', cnpjField, function(e) {
        cpfCnpj = $(cnpjField).val();
        if(cpfCnpj !="") {
            if(!validaCNPJ(cpfCnpj)) {
                $(cnpjField).addClass('mage-error');
                $(cnpjField).val("");
            } else {
                $(cnpjField).removeClass('mage-error');
                $(cnpjField).val(formatacaoCpfCnpj(cpfCnpj));
            }
        }
    });

    function formatacaoParaNumero(string){
        return string.replace(/[^0-9$]/gi, '');
    }

    function validaCpfCnpj(cpfcnpj) {
        cpfcnpj = formatacaoParaNumero(cpfcnpj);
        if(cpfcnpj.length == 11) {
            return validaCPF(cpfcnpj);
        } else if(cpfcnpj.length==14) {
            return validaCNPJ(cpfcnpj)
        } else {
            return false;
        }
    }
});

function formatacaoCpfCnpj(cpfcnpj) {
    if(cpfcnpj.length == 11) {
        return cpfcnpj.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    } else if(cpfcnpj.length==14) {
        return cpfcnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
    } else {
        return "";
    }

}

function calculaDigitosPosicoes( digitos, posicoes = 10, soma_digitos = 0 ) {
    digitos = digitos.toString();
    for ( var i = 0; i < digitos.length; i++  ) {
        soma_digitos = soma_digitos + ( digitos[i] * posicoes );
        posicoes--;
        if ( posicoes < 2 ) {
            posicoes = 9;
        }
    }

    soma_digitos = soma_digitos % 11;
    if ( soma_digitos < 2 ) {
        soma_digitos = 0;
    } else {
        soma_digitos = 11 - soma_digitos;
    }

    var cpf = digitos + soma_digitos;
    return cpf;

}

function validaCNPJ(cnpj){
    valor = cnpj.toString();
    valor = valor.replace(/[^0-9]/g, '');
    var cnpj_original = valor;
    var primeiros_numeros_cnpj = valor.substr( 0, 12 );
    var primeiro_calculo = calculaDigitosPosicoes( primeiros_numeros_cnpj, 5 );
    var segundo_calculo = calculaDigitosPosicoes( primeiro_calculo, 6 );
    var cnpj = segundo_calculo;
    if ( cnpj === cnpj_original ) {
        return true;
    }

    return false;
}

function validaCPF(cpf){
    valor = cpf.toString();
    valor = valor.replace(/[^0-9]/g, '');
    var digitos = valor.substr(0, 9);
    var novo_cpf = calculaDigitosPosicoes( digitos );
    var novo_cpf = calculaDigitosPosicoes( novo_cpf, 11 );
    if ( novo_cpf === valor ) {
        return true;
    } else {
        // CPF inválido
        return false;
    }
}