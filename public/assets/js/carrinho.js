const tbody = document.getElementById('dados')
const inputTotalVenda = document.getElementById('inputTotalVenda')
const selectCli = document.getElementById('selectCli')
const idCarrinho = document.getElementById('idcarrinho')
const idtotal = document.getElementById('idtotal')


async function deletaItem(id) {

    idproduto = id

    const response = await fetch(`/deletarprodutoCarrinho/${idproduto}`);

    setTimeout(() => {
          window.location.reload()
    }, 500);
}

async function deletaTudo() {


    const response = await fetch(`/deletarCarrinho`);

    setTimeout(() => {
          window.location.reload()
    }, 500);
}

async function total() {

    const response = await fetch('/listarcarrinho') 
   
    const json = await response.json();
   total = 0
   json.forEach(item => {
    total += JSON.parse(item.preco)
    
   });
   inputTotalVenda.value = total
   idtotal.value = total
   
    
}

document.addEventListener("DOMContentLoaded", function () {
    total()
});
selectCli.addEventListener("change", function () {
    const select = selectCli.value
    idCarrinho.value = select
});

async function confirmar() {
    const form = document.querySelector("#frm");
    const formData = new FormData(form);
    if (idCarrinho.value == '' || null) {
        alert('Selecione um cliente primeiro')
    } else {

    const opt = {
        method: "POST",
        mode: 'cors',
        body: formData,
        cache: 'default'
    }
     await fetch('/adicionarvenda', opt)
    }
}