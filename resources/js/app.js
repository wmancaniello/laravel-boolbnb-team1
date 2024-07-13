import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";
import { mostraAnteprima} from "./function/function";

const fileElem = document.querySelector('.ms_file');
const addressElem = document.getElementById('address');

if(fileElem) {

    fileElem.addEventListener('change', mostraAnteprima);

}

if(addressElem) {
    
}