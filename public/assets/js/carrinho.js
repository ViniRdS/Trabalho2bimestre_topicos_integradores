const tbody = document.getElementById('dados')
const inputTotalVenda = document.getElementById('inputTotalVenda')


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
   console.log(json);
    
}

document.addEventListener("DOMContentLoaded", function () {
    total()
});