// TODAS AS QUERYS DE SELEÇÃO DE CAMPO HTML
const atualiza = document.querySelector("#btnatualiza");
const salvar = document.querySelector("#btnsalvar");

const alerta = document.querySelector("#alerta");
const titulo = document.querySelector("#titulo");
const carregando = document.querySelector("#carregando");
const cadastro = document.querySelector("#btncadastro");

//LABELS DO CADASTRAR
const labelNome_Fantasia = document.querySelector("#labelNome_Fantasia")
const labelSobrenome_Razao = document.querySelector("#labelSobrenome_Razao")
const labelCpf_Cnpj = document.querySelector("#labelCpf_Cnpj")
const labelRg_Ie = document.querySelector("#labelRg_Ie")
const labelDtNascimento_Abertura = document.querySelector("#labelDtNascimento_Abertura")


//DIV ONDE FICA OS INPUTS NO CADASTRAR
const inputs = document.querySelector('#inputs');
const tituloModal = document.querySelector('#staticBackdropLabel');


//BOTÕES E DIV DE BOTÃO
const fechar = document.querySelector('#fechar');
const voltarX = document.querySelector("#voltarX");
const fecharX = document.querySelector("#fecharX");


//INPUT CADASTRO
const cpf_cnpj = document.querySelector('#cpf_cnpj');
const nome_fantasia = document.querySelector('#nome_fantasia');
const dtnascimento_abertura = document.querySelector('#dtnascimento_abertura');
const sobrenome_razao = document.querySelector('#sobrenome_razao');
const rg_ie = document.querySelector('#rg_ie');



//CONFIGURAÇÕES DOS PARAMENTRO DE VALIDAÇÃO DO FORMULÁRIO
  $('#frm').validate({
    //adiconamos regras de validação ao formulário
    rules: {
        //bloqueamos uma quantidade minima de caracteres
        //para o campo nome e sobre nome.
       
       
    },
    //definimos que as mensagem de formulário serão adicionadas a uma tag
    // <span>Mensagem</span>
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        $(element).addClass('is-valid');

    }


});


 
async function deleta(id) {
    document.getElementById('idcliente').value = id;
    const form = document.querySelector('#clientes');
    dados = new FormData(form);
    const opt = {
        method: 'POST',
        body: dados,
        mode: 'cors',
        cache: 'default'
    };
    const response = await fetch('delete.php', opt);
    const data = await response.text();
    if (data == 'true') {
        $('#tr' + id).remove();
    }
}
function alterar(cliente) {
    const id = cliente.id;
    const nome_fantasia = cliente.nome_fantasia;
    const sobrenome_razao = cliente.sobrenome_razao;
    const cpf_cnpj = cliente.cpf_cnpj;
    const rg_ie = cliente.rg_ie;
    const dtnascimento_abertura = cliente.dtnascimento_abertura;
    const tipo = cliente.tipo;

    $("#acao").val('update');
    $("#id").val(id);
    $("#nome_fantasia").val(nome_fantasia);
    $("#sobrenome_razao").val(sobrenome_razao);
    $("#cpf_cnpj").val(cpf_cnpj);
    $("#rg_ie").val(rg_ie);
    $("#dtnascimento_abertura").val(dtnascimento_abertura);
    document.querySelector("#tipo").value = tipo;

    

    //exibimos o modal
    $("#cadastrocliente").modal('show');
}

async function update() {
    /*alerta.className = 'alert alert-success';
    titulo.className = 'mb-0';
    titulo.innerHTML = `<p>Alteração realizada com sucesso!`;**/
    const form = document.querySelector("#frm")
    const dados = new FormData(form);

    const opt = {
        method: "POST",
        mode: 'cors',
        body: dados,
        cache: 'default'

    };
    const response = await fetch('cadastro.php', opt);
    const data = await response.text();
    if (data == 'true') {
        $("#acao").val('update');
        $("#id").val('');
        $("#nome_fantasia").val('');
        $("#sobrenome_razao").val('');
        $("#cpf_cnpj").val('');
        $("#rg_ie").val('');
        $("#dtnascimento_abertura").val('');
        $("#tipo").val('');
        lista_cliente();
        //ocultamos o modal
        $("#cadastrocliente").modal('hide');

    }
}

async function lista_cliente() {
    //monstamos a configuração da requição
    //ao servidor http
    const opt = {
        method: 'POST',
        mode: 'cors',
        cache: 'default'
    }
    //A VARIAVEL response RECEBERÁ UMA PROMISSE
    //DE UMA TENTATIVA DE REQUISIÇÃO.
    //const response = await fetch('', opt);
    //CONVERTEMOS O A RESPOSTA  PARA TEXTO
    //QUE TERÁ UMA ESTRUTURA HTML
   // const html = await response.text();
    //PRINTAMOS NO CONSOLE O RESULTADO

    //document.getElementById('dados').innerHTML = html;
}

async function inserir() {
    const form = document.querySelector("#frm");
    const formData = new FormData(form);

    const opt = {
        method: "POST",
        mode: 'cors',
        body: formData,
        cache: 'default'
    }
    const response = await fetch('cadastro.php', opt);
    const dados = await response.text();
    console.log(dados);
    console.log(dados);
    //VARIFICAMOS SE A RESPOSTA DO PHP OU SERVER É TRUE
    if (dados == 'true') {
        //CASO SEJA TRUE, EXIBIMOS A MENSAGEM DE SALVO COM SUCESSO,
        //E ALTERAMOS A COR DO COMPONENTE ALERT PARA SUCCESS
        alerta.className = 'alert alert-success';
        titulo.className = 'mb-0';
        titulo.innerHTML = `<p>Cadastro realizado com sucesso!`;
        //OCULTA O ICONES CARREGANDO
        carregando.className = 'mb-0 d-none';
        lista_cliente();
        //aguardamos 0,5 seg para fechar o modal
        setTimeout(() => {
            //fecha o modal
            $("#cadastrocliente").modal('hide');
            $("#frmcliente input").val('');
            $("#alerta").removeClass('alert alert-success');
            $('#alerta').addClass('alert alert-warning');
            $("#titulo").removeClass('d-none');
            $("#titulo").addClass('mb-0');
            titulo.innerHTML = `
            <h6 class="alert-heading">Atenção!</h6>
            Todos os campos com <span class="text-danger"> * </span> 
            são obrigatórios para o
            cadastro!`;
        }, 1000);
    } else {
        titulo.className = `mb-0`;
        titulo.innerHTML = `<p>${dados}</p>`;
    }
}
//MAPEAMOS O EVENTO DE CARREGAMENTO DO DOCUMENTO
document.addEventListener("DOMContentLoaded", function () {
    lista_cliente();
});

atualiza.addEventListener('click', async function () {
    lista_cliente();
});

cadastro.addEventListener('click', function () {
   // $("#frm input").val('');
    document.getElementById('acao').value = 'insert';
    
       

});

salvar.addEventListener('click', function () {
    //RECEBEMOS O RESULTADO DA VALIDAÇÃO DO FORMULARIO
    //const valida = $('#frm').valid();
    // let acao = document.getElementById("edtacao");
    if (valida == true) {
        if (document.getElementById('acao').value == 'update') {
            titulo.className = 'd-none';
            carregando.className = 'mb-0';
            setTimeout(() => {
                update();

                cpf_cnpj.classList.remove('is-valid')
                nome_fantasia.classList.remove('is-valid')
                dtnascimento_abertura.classList.remove('is-valid')
                rg_ie.classList.remove('is-valid')
                sobrenome_razao.classList.remove('is-valid')

                carregando.classList.add('d-none');
                titulo.classList.remove('d-none')

                
                
                
                
            }, 500);
        } else if (document.getElementById('acao').value == 'insert') {
            titulo.className = 'd-none';
            carregando.className = 'mb-0';
            setTimeout(() => {
                inserir();
                
                
                

                cpf_cnpj.classList.remove('is-valid')
                nome_fantasia.classList.remove('is-valid')
                dtnascimento_abertura.classList.remove('is-valid')
                rg_ie.classList.remove('is-valid')
                sobrenome_razao.classList.remove('is-valid')

                carregando.classList.add('d-none');
                titulo.classList.remove('d-none')

               
                
                
            }, 500);
        }
       
    }
});



// QUANDO CLICAR NO BOTÃO FECHAR PARA FECHAR O FORMULÁRION IRÁ VAI LIMPAR O FORMULÁRIO
fechar.addEventListener('click', () => {


    cpf_cnpj.classList.remove('is-valid')
    nome_fantasia.classList.remove('is-valid')
    dtnascimento_abertura.classList.remove('is-valid')
    rg_ie.classList.remove('is-valid')
    sobrenome_razao.classList.remove('is-valid')

    nome_fantasia.classList.remove('is-invalid')
    sobrenome_razao.classList.remove('is-invalid')
    rg_ie.classList.remove('is-invalid')
    dtnascimento_abertura.classList.remove('is-invalid')
    if(document.getElementById('acao').value == 'insert'){
        cpf_cnpj.value = ''
        nome_fantasia.value = ''
        sobrenome_razao.value = ''
        rg_ie.value = ''
        dtnascimento_abertura.value = ''
        }

    carregando.classList.add('d-none');
    titulo.classList.remove('d-none')
})

// QUANDO CLICAR PARA NO BOTÃO X PRARA FECHAR O FORMULÁRIO IRÁ VAI LIMPAR O FORMULÁRIO
fecharX.addEventListener('click', () => {


    


    cpf_cnpj.classList.remove('is-valid')
    nome_fantasia.classList.remove('is-valid')
    dtnascimento_abertura.classList.remove('is-valid')
    rg_ie.classList.remove('is-valid')
    sobrenome_razao.classList.remove('is-valid')

    nome_fantasia.classList.remove('is-invalid')
    sobrenome_razao.classList.remove('is-invalid')
    rg_ie.classList.remove('is-invalid')
    dtnascimento_abertura.classList.remove('is-invalid')
    if(document.getElementById('acao').value == 'insert'){
        cpf_cnpj.value = ''
        nome_fantasia.value = ''
        sobrenome_razao.value = ''
        rg_ie.value = ''
        dtnascimento_abertura.value = ''
        }

    carregando.classList.add('d-none');
    titulo.classList.remove('d-none')

})

$("#cpf_cnpj").inputmask({
    mask: '999.999.999-99'
});

