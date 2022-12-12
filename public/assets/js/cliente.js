// TODAS AS QUERYS DE SELEÇÃO DE CAMPO HTML
const atualiza = document.querySelector("#btnatualiza");
const salvar = document.querySelector("#btnsalvar");
const salvarEditar = document.querySelector("#btnsalvarEditar");

const alerta = document.querySelector("#alerta");
const titulo = document.querySelector("#titulo");
const carregando = document.querySelector("#carregando");
const cadastro = document.querySelector("#btncadastro");

//LABELS DO CADASTRAR
const labelNome = document.querySelector("#labelNome_Fantasia")
const labelSobrenome = document.querySelector("#labelSobrenome_Razao")
const labelCpf = document.querySelector("#labelCpf_Cnpj")
const labelRg = document.querySelector("#labelRg_Ie")
const labelDtNascimento = document.querySelector("#labelDtNascimento_Abertura")


//DIV ONDE FICA OS INPUTS NO CADASTRAR
const inputs = document.querySelector('#inputs');
const tituloModal = document.querySelector('#staticBackdropLabel');


//BOTÕES E DIV DE BOTÃO
const fechar = document.querySelector('#fechar');
const voltarX = document.querySelector("#voltarX");
const fecharX = document.querySelector("#fecharX");


//INPUT CADASTRO
const cpf = document.querySelector('#cpf');
const nome = document.querySelector('#nome');
const dtnascimento = document.querySelector('#dtnascimento');
const sobrenome = document.querySelector('#sobrenome');
const rg = document.querySelector('#rg');

const cpfEditar = document.querySelector('#cpfEditar');
const nomeEditar = document.querySelector('#nomeEditar');
const dtnascimentoEditar = document.querySelector('#dtnascimentoEditar');
const sobrenomeEditar = document.querySelector('#sobrenomeEditar');
const rgEditar = document.querySelector('#rgEditar');

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
    idcliente =document.getElementById('idcliente').value;

    const response = await fetch(`/deletarcliente/${idcliente}`);


    atualizar()
}

async function alterar(id) {
    document.getElementById('acao').value = 'update';
    const clientes = await lista_cliente()
    const busca = clientes.find(function(elemento){
        return elemento.id==id
    })
    
    
    const nomeEditar = busca.nome;
    const sobrenomeEditar = busca.sobrenome;
    const cpfEditar = busca.cpf;
    const rgEditar = busca.rg;
    const dtnascimentoEditar = busca.dtnascimento;
   

    $("#acao").val('update');
    $("#idEditar").val(id);
    $("#nomeEditar").val(nomeEditar);
    $("#sobrenomeEditar").val(sobrenomeEditar);
    $("#cpfEditar").val(cpfEditar);
    $("#rgEditar").val(rgEditar);
    $("#dtnascimentoEditar").val(dtnascimentoEditar);

    

    //exibimos o modal
    $("#editarcliente").modal('show');
}

async function update() {
   
    const form = document.querySelector('#frmEditar');
    dados = new FormData(form);
    const id = document.querySelector("#idEditar").value
   
    const opt = {
        method: "POST",
        mode: 'cors',
        body: dados,
        cache: 'default'

    };
    const response = await fetch(`/atualizarcliente/${id}`,opt);
   
        atualizar();
        //ocultamos o modal
        $("#editarcliente").modal('hide');

    
}

async function lista_cliente() {
   
       
      const opt = {
        method: 'GET',
        mode: 'cors',
        cache: 'default'
    }
    
    //A VARIAVEL response RECEBERÁ UMA PROMISSE
    //DE UMA TENTATIVA DE REQUISIÇÃO.
    const response = await fetch('/listarcliente') 
    
    
    //CONVERTEMOS O A RESPOSTA  PARA TEXTO
    //QUE TERÁ UMA ESTRUTURA HTML
    const json = await response.json();
    //console.log(html);
    //PRINTAMOS NO CONSOLE O RESULTADO
   
    return json
}
async function atualizar(){
   const clientes = await lista_cliente();
   dados = "";
   clientes.forEach(cliente => {
     dados +=`<tr id='tr ${cliente.id}'>
    <td> ${cliente.id}</td>
    <td> ${cliente.nome} </td>
    <td> ${cliente.sobrenome} </td>
    <td> ${cliente.cpf}</td>
    <td> ${cliente.rg} </td>
    <td> ${cliente.dtnascimento}</td>
    <td>
    <div class='btn-group' role='group'>
    <button type='button' onclick='alterar(${cliente.id})' type='button' class='btn btn-warning'>
    <i class='fa-solid fa-pen-to-square'> </i> Editar
    </button>
    <button onclick='deleta(${cliente.id});' type='button' class='btn btn-danger'>
    <i class='fa-solid fa-trash'> </i> Excluir
    </div>
    </td>
    </tr>`
   });
   //console.log(dados);
   
   //console.log(dado);
   document.getElementById('dados').innerHTML = dados;
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
     await fetch('/cadastrarcliente', opt)
    
   
    //VARIFICAMOS SE A RESPOSTA DO PHP OU SERVER É TRUE
    
        //CASO SEJA TRUE, EXIBIMOS A MENSAGEM DE SALVO COM SUCESSO,
        //E ALTERAMOS A COR DO COMPONENTE ALERT PARA SUCCESS
        alerta.className = 'alert alert-success';
        titulo.className = 'mb-0';
        titulo.innerHTML = `<p>Cadastro realizado com sucesso!`;
        //OCULTA O ICONES CARREGANDO
        carregando.className = 'mb-0 d-none';
        atualizar();
        //aguardamos 0,5 seg para fechar o modal
        setTimeout(() => {
            //fecha o modal
            $("#cadastrocliente").modal('hide');
            $("#frm input").val('');
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
}

//MAPEAMOS O EVENTO DE CARREGAMENTO DO DOCUMENTO
document.addEventListener("DOMContentLoaded", function () {
    atualizar()
});

atualiza.addEventListener('click', async function () {
    atualizar()
    
});

cadastro.addEventListener('click', function () {
   $("#frm input").val('');
    document.getElementById('acao').value = 'insert';
    tituloModal.innerHTML = 'Dados do cliente';
       

});
salvarEditar.addEventListener('click', (e)=>{
    e.preventDefault()  
    update();      

})

salvar.addEventListener('click', function () {
    document.querySelector('#tipo').value = 'salvar';
   let tipo = document.querySelector('#tipo').value;
  
    
    //RECEBEMOS O RESULTADO DA VALIDAÇÃO DO FORMULARIO
    const valida = $('#frm').valid();
    // let acao = document.getElementById("edtacao");
     if (valida == true) {
        if (document.getElementById('acao').value == 'update') {
            titulo.className = 'd-none';
            carregando.className = 'mb-0';
            setTimeout(() => {
                update();

                cpf.classList.remove('is-valid')
                nome.classList.remove('is-valid')
                dtnascimento.classList.remove('is-valid')
                rg.classList.remove('is-valid')
                sobrenome.classList.remove('is-valid')

                carregando.classList.add('d-none');
                titulo.classList.remove('d-none')

                
                
                
                
            }, 500);
        } else if (document.getElementById('acao').value == 'insert') { 
            titulo.className = 'd-none';
            carregando.className = 'mb-0';
            setTimeout(() => {
                inserir();
                
                
                

                cpf.classList.remove('is-valid')
                nome.classList.remove('is-valid')
                dtnascimento.classList.remove('is-valid')
                rg.classList.remove('is-valid')
                sobrenome.classList.remove('is-valid')

                carregando.classList.add('d-none');
                titulo.classList.remove('d-none')

               
                
                
            }, 500);
        }
       
   }
});



// QUANDO CLICAR NO BOTÃO FECHAR PARA FECHAR O FORMULÁRION IRÁ VAI LIMPAR O FORMULÁRIO
fechar.addEventListener('click', () => {


    cpf.classList.remove('is-valid')
    nome.classList.remove('is-valid')
    dtnascimento.classList.remove('is-valid')
    rg.classList.remove('is-valid')
    sobrenome.classList.remove('is-valid')

    nome.classList.remove('is-invalid')
    sobrenome.classList.remove('is-invalid')
    rg.classList.remove('is-invalid')
    dtnascimento.classList.remove('is-invalid')
    if(document.getElementById('acao').value == 'insert'){
        cpf.value = ''
        nome.value = ''
        sobrenome.value = ''
        rg.value = ''
        dtnascimento.value = ''
        }

    carregando.classList.add('d-none');
    titulo.classList.remove('d-none')
})

// QUANDO CLICAR PARA NO BOTÃO X PRARA FECHAR O FORMULÁRIO IRÁ VAI LIMPAR O FORMULÁRIO
fecharX.addEventListener('click', () => {


    


    cpf.classList.remove('is-valid')
    nome.classList.remove('is-valid')
    dtnascimento.classList.remove('is-valid')
    rg.classList.remove('is-valid')
    sobrenome.classList.remove('is-valid')

    nome.classList.remove('is-invalid')
    sobrenome.classList.remove('is-invalid')
    rg.classList.remove('is-invalid')
    dtnascimento.classList.remove('is-invalid')
    if(document.getElementById('acao').value == 'insert'){
        cpf.value = ''
        nome.value = ''
        sobrenome.value = ''
        rg.value = ''
        dtnascimento.value = ''
        }

    carregando.classList.add('d-none');
    titulo.classList.remove('d-none')

})

$("#cpf").inputmask({
    mask: '999.999.999-99'
});

