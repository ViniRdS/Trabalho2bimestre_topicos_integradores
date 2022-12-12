// TODAS AS QUERYS DE SELEÇÃO DE CAMPO HTML
const atualiza = document.querySelector("#btnatualiza");
const salvar = document.querySelector("#btnsalvar");
const salvarEditar = document.querySelector("#btnsalvarEditar");

const alerta = document.querySelector("#alerta");
const titulo = document.querySelector("#titulo");
const carregando = document.querySelector("#carregando");
const cadastro = document.querySelector("#btncadastro");

//LABELS DO CADASTRAR
const labelNomeProd = document.querySelector("#labelNome_prod")
const labelDescricao_Prod = document.querySelector("#labelDescricao_Prod")
const labelPreco_Prod = document.querySelector("#labelPreco_Prod")
const labelDtfabricacao = document.querySelector("#labelDtfabricacao")
const labelMarca = document.querySelector("#labelMarca_prod")



//DIV ONDE FICA OS INPUTS NO CADASTRAR
const inputs = document.querySelector('#inputs');
const tituloModal = document.querySelector('#staticBackdropLabel');


//BOTÕES E DIV DE BOTÃO
const fechar = document.querySelector('#fechar');
const voltarX = document.querySelector("#voltarX");
const fecharX = document.querySelector("#fecharX");


//INPUT CADASTRO
const marca_prod = document.querySelector('#marca_prod');
const nome_prod = document.querySelector('#nome_produto');
const dtfabricacao = document.querySelector('#dtfabricacao');
const descricao_prod = document.querySelector('#descricao_prod');
const preco_produto = document.querySelector('#preco_prod');

const marca_prod_Editar = document.querySelector('#estoque_prodEditar');
const nome_prod_Editar = document.querySelector('#nome_prodEditar');
const dtfabricacaoEditar = document.querySelector('#dtfabricacaoEditar');
const descricao_prod_Editar = document.querySelector('#descricao_prodEditar');
const preco_produto_Editar = document.querySelector('#preco_prodEditar');

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

    document.getElementById('idproduto').value = id;
    idproduto =document.getElementById('idproduto').value;

    const response = await fetch(`/deletarproduto/${idproduto}`);


    atualizar()
}

async function alterar(id) {
    document.getElementById('acao').value = 'update';
    const produtos = await lista_produto()
    const busca = produtos.find(function(elemento){
        return elemento.id==id
    })
    

    const marca_prod_Editar = busca.marca;
    const nome_prod_Editar = busca.nome;
    const dtfabricacaoEditar = busca.dtfabricacao;
    const descricao_prod_Editar = busca.descricao;
    const preco_prod_Editar = busca.preco;


   

    $("#acao").val('update');
    $("#idEditar").val(id);
    $("#nome_produtoEditar").val(nome_prod_Editar);
    $("#descricao_prodEditar").val(descricao_prod_Editar);
    $("#marca_prodEditar").val(marca_prod_Editar);
    $("#dtfabricacaoEditar").val(dtfabricacaoEditar);
    $("#preco_prodEditar").val(preco_prod_Editar);


    

    //exibimos o modal
    $("#editarproduto").modal('show');
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
    const response = await fetch(`/atualizarproduto/${id}`,opt);
   
        atualizar();
        //ocultamos o modal
        $("#editarproduto").modal('hide');

    
}

async function lista_produto() {
   
       
      const opt = {
        method: 'GET',
        mode: 'cors',
        cache: 'default'
    }
    
    //A VARIAVEL response RECEBERÁ UMA PROMISSE
    //DE UMA TENTATIVA DE REQUISIÇÃO.
    const response = await fetch('/listarproduto') 
    
    
    //CONVERTEMOS O A RESPOSTA  PARA TEXTO
    //QUE TERÁ UMA ESTRUTURA HTML
    const html = await response.json();
    //console.log(html);
    //PRINTAMOS NO CONSOLE O RESULTADO
   
    return html
}
async function atualizar(){
   const produtos = await lista_produto();
   dados = "";
   produtos.forEach(produto => {
     dados +=`<tr id='tr ${produto.id}'>
    <td> ${produto.id}</td>
    <td> ${produto.nome} </td>
    <td> ${produto.marca} </td>
    <td> ${produto.descricao}</td>
    <td> ${produto.preco} </td>
    <td> ${produto.dtfabricacao}</td>
    <td>
    <div class='btn-group' role='group'>
    <button type='button' onclick='alterar(${produto.id})' type='button' class='btn btn-warning'>
    <i class='fa-solid fa-pen-to-square'> </i> Editar
    </button>
    <button onclick='deleta(${produto.id});' type='button' class='btn btn-danger'>
    <i class='fa-solid fa-trash'> </i> Excluir
    </button>
    <button onclick='deleta(${produto.id});' type='button' class='btn btn-primary'>
    <i class='fa-solid fa-basket-shopping'> </i> Comprar
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
     await fetch('/cadastrarproduto', opt)
    
   
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
            $("#cadastroproduto").modal('hide');
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

                marca_prod.classList.remove('is-valid')
                nome_prod.classList.remove('is-valid')
                dtfabricacao.classList.remove('is-valid')
                preco_produto.classList.remove('is-valid')
                descricao_prod.classList.remove('is-valid')

                carregando.classList.add('d-none');
                titulo.classList.remove('d-none')

                
                
                
                
            }, 500);
        } else if (document.getElementById('acao').value == 'insert') { 
            titulo.className = 'd-none';
            carregando.className = 'mb-0';
            setTimeout(() => {
                inserir();
                
                
                

                marca_prod.classList.remove('is-valid')
                nome_prod.classList.remove('is-valid')
                dtfabricacao.classList.remove('is-valid')
                preco_produto.classList.remove('is-valid')
                descricao_prod.classList.remove('is-valid')

                carregando.classList.add('d-none');
                titulo.classList.remove('d-none')

               
                
                
            }, 500);
        }
       
   }
});



// QUANDO CLICAR NO BOTÃO FECHAR PARA FECHAR O FORMULÁRION IRÁ VAI LIMPAR O FORMULÁRIO
fechar.addEventListener('click', () => {

    
    marca_prod.classList.remove('is-valid')
    nome_prod.classList.remove('is-valid')
    dtfabricacao.classList.remove('is-valid')
    preco_produto.classList.remove('is-valid')
    descricao_prod.classList.remove('is-valid')
    
    nome_prod.classList.remove('is-invalid')
    marca_prod.classList.remove('is-invalid')
    dtfabricacao.classList.remove('is-invalid')
    preco_produto.classList.remove('is-invalid')
    descricao_prod.classList.remove('is-invalid')
    if(document.getElementById('acao').value == 'insert'){
        marca_prod.value = ''
        nome_prod.value = ''
        descricao_prod.value = ''
        preco_produto.value = ''
        descricao_prod.value = ''
        }

    carregando.classList.add('d-none');
    titulo.classList.remove('d-none')
})

// QUANDO CLICAR PARA NO BOTÃO X PRARA FECHAR O FORMULÁRIO IRÁ VAI LIMPAR O FORMULÁRIO
fecharX.addEventListener('click', () => {


    


    marca_prod.classList.remove('is-valid')
    nome_prod.classList.remove('is-valid')
    dtfabricacao.classList.remove('is-valid')
    preco_produto.classList.remove('is-valid')
    descricao_prod.classList.remove('is-valid')

    nome_prod.classList.remove('is-invalid')
    marca_prod.classList.remove('is-invalid')
    dtfabricacao.classList.remove('is-invalid')
    preco_produto.classList.remove('is-invalid')
    descricao_prod.classList.remove('is-invalid')
    if(document.getElementById('acao').value == 'insert'){
        marca_prod.value = ''
        nome_prod.value = ''
        descricao_prod.value = ''
        preco_produto.value = ''
        descricao_prod.value = ''
        }

    carregando.classList.add('d-none');
    titulo.classList.remove('d-none')

})


