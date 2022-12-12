const tbody = document.getElementById('dados')


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