var validCep = false;
var validEmail = false;
var validTelefone = false;

function validarFormulario() {
    return validCep && validEmail && validTelefone;
}

$(document).ready(function () {
    $("#frmCadastro").submit(function (event) {
        event.preventDefault();
        alert("Depois me preocupo em submeter o form pro php!");
        if (validarFormulario()) {
        } else {
            alert("Arrume os dados!");
        }
    });

    $("input").keypress(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $(this).blur();
        }
    });
    $("#cpf, #telefone").on('input', function(e) {
        var inputVal = $(this).val();
        var sanitizedVal = inputVal.replace(/[.-]/g, ''); // Remove pontos e hífens

        $(this).val(sanitizedVal); // Atualiza o valor do campo
    });
    $("#cep").blur(function (event) {
        let cepStr = $(event.target).val().trim();

        if (cepStr.trim().replace("-", "").match(/^[\d]{8}$/g)) {
            let url = "https://viacep.com.br/ws/" + cepStr + "/json/";
            $.get(url, function (data, status) {
                if (!("erro" in data)) {
                    $("#logradouro").val(data.logradouro);
                    $("#complemento").val(data.complemento);
                    $("#bairro").val(data.bairro);
                    $("#localidade").val(data.localidade);
                    $("#uf").val(data.uf);
                    validCep = true;
                    $(event.target).css("color", "black");
                    $("#msgCep").hide();
                } else {
                    $(event.target).css("color", "red");
                    $(event.target).focus();
                    $("#msgCep").html("CEP não encontrado!").css("color", "red").show();
                    validCep = false;
                }
            }).fail(function () {
                $(event.target).css("color", "red");
                $(event.target).focus();
                $("#msgCep").html("Erro ao consultar o CEP!").css("color", "red").show();
                validCep = false;
            });
        } else {
            $(event.target).css("color", "red");
            $(event.target).focus();
            $("#msgCep").html("CEP Inválido!").css("color", "red").show();
            validCep = false;
        }
    });
    $("#cpf").blur(function (event) {
        let cpfStr = $(event.target).val().trim().replace(/\D/g, '');
        let cpfRegex = /^\d{11}$/;
    
        if (cpfRegex.test(cpfStr)) {
            validCpf = true;
            $(event.target).css("color", "black");
            $("#msgCpf").hide();
        } else {
            $(event.target).css("color", "red");
            $(event.target).focus();
            $("#msgCpf").html("CPF Inválido! Use o formato 123.456.789-00 ou 12345678900").css("color", "red").show();
            validCpf = false;
        }
    });
    

    
    $("#telefone").on('input', function (event) {
        let telefoneStr = $(event.target).val().trim();
        let telefoneRegex = /^(?:\d{2}\s?)?\d{9}$/;
    
        if (telefoneRegex.test(telefoneStr)) {
            // Remova qualquer espaço em branco e caracteres não numéricos
            telefoneStr = telefoneStr.replace(/\D/g, "");
    
            // Formate o número de telefone
            let telefoneFormatado = telefoneStr.replace(/^(\d{2})(\d{9})$/, "$1 $2");
            $(event.target).val(telefoneFormatado);
            validTelefone = true;
            $(event.target).css("color", "black");
            $("#msgTelefone").hide();
        } else {
            $(event.target).css("color", "red");
            $(event.target).focus();
            $("#msgTelefone").html("Telefone Inválido! Use o formato XX 923456789 ou xx923456789").css("color", "red").show();
            validTelefone = false;
        }
    });
    
    $("#email").blur(function (event) {
        let emailStr = $(event.target).val().trim();
        let emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

        if (emailRegex.test(emailStr)) {
            validEmail = true;
            $(event.target).css("color", "black");
            $("#msgEmail").hide();
        } else {
            $(event.target).css("color", "red");
            $(event.target).focus();
            $("#msgEmail").html("Email Inválido!").css("color", "red").show();
            validEmail = false;
        }
    });
   
$("#frmCadastro").submit(function (event) {
    event.preventDefault();
    let cpfInput = $("#cpf");
    let cpfStr = cpfInput.val().trim().replace(/\D/g, '');
    cpfInput.val(cpfStr);

    if (validarFormulario()) {
        // Simulação de envio do formulário para o servidor (você pode substituir por sua lógica real)
        $.ajax({
            type: "POST",
            url: "controller/controlVendedora.php",
            data: $(this).serialize(),
            success: function () {
                // Limpar os campos do formulário (opcional)
                $("#frmCadastro")[0].reset();

                // Ocultar o formulário
                $("#frmCadastro").hide();

                // Exibir a mensagem de sucesso
                $("#mensagemSucesso").show();
            },
            error: function () {
                alert("Erro ao enviar o formulário.");
            }
        });
    } else {
        alert("Arrume os dados!");
    }
});
    
});
