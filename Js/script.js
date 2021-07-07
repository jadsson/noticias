// REDUZIR HEADER AO SCROLL

const menu = document.querySelector('header');

function reduzMenu() {
    let scroll = window.scrollY;
    if(scroll > 10) {
        menu.classList.add('scroll');
    } else {
        menu.classList.remove('scroll');
    }
}

window.addEventListener('scroll', reduzMenu);


/**
 * ABRIR IMAGEM NO MODAL
 */

const modal = document.querySelector('.modal');
const close = document.querySelector('.close');
const img = document.querySelectorAll('.img-pequena');
const imgModal = document.querySelector('#img_modal');
let link = "";

if(modal) {
    for(let i=0; i<img.length; i++) {
        img[i].addEventListener('click', ()=>{
            link = img[i].getAttribute('src');
            imgModal.setAttribute('src', link);
        })
    }
    
    
    window.addEventListener('click', clickFora);
    
    function clickFora(e) {
        if(e.target == modal) {
            modal.style.display = 'none';
        }
    }
    
    img.forEach((e, i) => {
        img[i].addEventListener('click', abrirModal);
    });
    
    close.addEventListener('click', ()=>{
        modal.style.display = 'none';
    })
    
    function abrirModal() {
        modal.style.display = 'block';
    }
    
    function fecharModal() {
        modal.style.display = 'none';
    }
}

/**
 * MODAL UPLOAD DE IMAGENS
 */
const upModal = document.querySelector('.upload-img-modal');
const iconUpload = document.querySelector('.icon-upload');
const fecha = document.querySelector('.close-img-modal');

if(iconUpload){
    iconUpload.addEventListener('click', ()=> {
        upModal.style.display = 'block';
    })
    
    fecha.addEventListener('click', ()=>{
        upModal.style.display = 'none';
    })
}


/**
 * MODAL DELETE NEWS
 */
const deleteNews = document.querySelector('#modal-delete-news');
const iconDelNews = document.querySelector('.icon-delete-news');

if(iconDelNews) {
    iconDelNews.addEventListener('click', ()=>{
        deleteNews.style.display = 'flex';
    });
    function modalDeleteNews() {
        deleteNews.style.display = 'flex';
    }
    
    window.addEventListener('click', (e)=>{
        if(e.target == deleteNews) {
            deleteNews.style.display = 'none';
        }
    })
}


/**
 * MODAL CONFIRM PASS
 */
const modalConfirmPass = document.querySelector('#modal-confirm-pass');
const closeModalConfirmPass = document.querySelector('.close-modal-confirm-pass');

if(closeModalConfirmPass) {
    closeModalConfirmPass.addEventListener('click', ()=>{
        modalConfirmPass.style.display = 'none';
    })
}


/**
 * MODAL DELETE IMG
 */
const modalDeleteImg = document.querySelector('#modal-delete-img');
const buttonDeleteImg = document.querySelectorAll('#delete-img-button');
const closeDelImg = document.querySelector('#close-modal-delete-img');
const imgOpenInModal = document.querySelector('#img-modal-delete-img');
const imgsInPage = document.querySelectorAll('.img-pequena');
const inputNomeImg = document.querySelector('#nome-da-imagem');
const imgDiretorio = document.querySelector('#link-img-diretorio');
var linkimg = "";

if(buttonDeleteImg) {
    for(let i=0; i<buttonDeleteImg.length; ++i) {
        buttonDeleteImg[i].addEventListener('click', ()=>{
            modalDeleteImg.style.display = 'flex';
            linkimg = imgsInPage[i].getAttribute('src');
            imgOpenInModal.setAttribute('src', linkimg);
            console.log(linkimg);

            /**
             * PASSANDO O NOME DA IMAGEM PARA DENTRO DO FORMULÁRIO
             */
            inputNomeImg.setAttribute('value', linkimg.substring(11));
            imgDiretorio.setAttribute('value', linkimg);
        })
    }
}
if(closeDelImg) {
    closeDelImg.addEventListener('click', ()=>{
        modalDeleteImg.style.display = 'none';
    })
}
