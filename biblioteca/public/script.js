// Função para redirecionar ao clicar nos botões de Home
function buttonRedirect(redirect) {
  if (redirect === 'livro') {window.location.href = "livros.php";}
  else if (redirect === 'emprestimo') {window.location.href = "emprestimos.php";}
  else if (redirect === 'usuario') {window.location.href = "usuarios.php";}
}

// Função para redirecionar o logout
function sair() {
    window.location.href = "../painel/logout.php";
}

// Função para abrir o formulário pop-up
function abrirForm(popup) {
    if (popup === 'add-overlay') {
        document.querySelector('.add-overlay').style.display  = 'flex';
    } else if (popup === 'edit-overlay') {
        document.querySelector('.edit-overlay').style.display  = 'flex';
    }  else if (popup === 'devolucao-overlay') {
        document.querySelector('.devolucao-overlay').style.display  = 'flex';
    }else if (popup === 'retirado-overlay') {
      document.querySelector('.retirado-overlay').style.display  = 'flex';
    } else if (popup === 'remove-overlay') {
      document.querySelector('.remove-overlay').style.display  = 'flex';
  }
}

// Função para fechar o formulário pop-up
function fecharForm(popup) {
    document.querySelector('.add-overlay').style.display = 'none';
    document.querySelector('.edit-overlay').style.display = 'none';
    document.querySelector('.remove-overlay').style.display = 'none';
    document.querySelector('.retirado-overlay').style.display = 'none';
    document.querySelector('.devolucao-overlay').style.display = 'none';    
}

//Verificar senha
function verificarSenhas(popup) {
    let senha1;
    let senha2;
    let btn;
    if (popup === 'add-overlay') {
        senha1 = document.querySelector('#senha-add1').value;
        senha2 = document.querySelector('#senha-add2').value;
        btn = document.querySelector('#enviar-add');
    } else if (popup === 'edit-overlay') {
        senha1 = document.querySelector('#senha-edit1').value;
        senha2 = document.querySelector('#senha-edit2').value;
        btn = document.querySelector('#enviar-edit');
    } 
    if (senha1 == senha2) {
        btn.removeAttribute('disabled');
    } else {
        btn.setAttribute('disabled', '');
    }
}

/*----------------------Paginação----------------------*/
var currentPage = 1; // Página atual
var rowsPerPage = 10; // Quantidade de linhas por página

function mostrarPagina(page) {
  var linhas = document.getElementById('tabela-paginacao').getElementsByTagName('tbody')[0].rows;
  var totalPages = Math.ceil(linhas.length / rowsPerPage); // Total de páginas

  // Esconder todas as linhas da tabela
  for (var i = 0; i < linhas.length; i++) {
    linhas[i].style.display = 'none';
  }

  // Mostrar as linhas correspondentes à página atual
  var startIndex = (page - 1) * rowsPerPage;
  var endIndex = startIndex + rowsPerPage;
  for (var j = startIndex; j < endIndex && j < linhas.length; j++) {
    linhas[j].style.display = 'table-row';
  }

  // Desabilitar/habilitar os botões de navegação conforme necessário
  var btnAnterior = document.getElementById('paginacao').getElementsByTagName('button')[0];
  var btnProxima = document.getElementById('paginacao').getElementsByTagName('button')[1];
  btnAnterior.disabled = (page === 1);
  btnProxima.disabled = (page === totalPages);

  // Ocultar os botões de navegação se houver 10 ou menos linhas
  var paginacao = document.getElementById('paginacao');
  if (totalPages <= 1) {
    paginacao.style.display = 'none';
  } else {
    paginacao.style.display = 'block';
  }
}

function proximaPagina() {
  var linhas = document.getElementById('tabela-paginacao').getElementsByTagName('tbody')[0].rows;
  var totalPages = Math.ceil(linhas.length / rowsPerPage); // Total de páginas
  if (currentPage < totalPages) {
    currentPage++;
    mostrarPagina(currentPage);
  }
}

function paginaAnterior() {
  if (currentPage > 1) {
    currentPage--;
    mostrarPagina(currentPage);
  }
}

// Mostrar a primeira página ao carregar a página
mostrarPagina(currentPage);