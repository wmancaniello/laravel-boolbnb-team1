import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";
import { galleryAnteprima, mostraAnteprima, mostraToast, nascondiToast, TomTomApi} from "./function/function";

const fileElem = document.querySelector('.ms_file');
const addressElem = document.getElementById('address');
const toastElem = document.querySelector('.ms_toast');
const multipleFileElem = document.getElementById('photos');



if(fileElem) {

    fileElem.addEventListener('change', mostraAnteprima);

}

if(addressElem) {
    addressElem.addEventListener('input', TomTomApi);
}

if(toastElem) {

    toastElem.classList.toggle('ms_hidden');

    setTimeout(mostraToast, 200);
    
    const time = setTimeout(nascondiToast, 5000);
}

if(multipleFileElem) {
    multipleFileElem.addEventListener('change', galleryAnteprima);
}