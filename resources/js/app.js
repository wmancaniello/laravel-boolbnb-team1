import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";
import { galleryAnteprima, mostraAnteprima, mostraToast, nascondiToast, TomTomApi, validationFormFlats} from "./function/function";

const fileElem = document.querySelector('.ms_file');
const addressElem = document.getElementById('address');
const toastElem = document.querySelector('.ms_toast');

const formElem = document.getElementById('register-form');
const logFormElem = document.querySelector('.form-elem');


const multipleFileElem = document.getElementById('photos');

const formFlatsElem = document.getElementById('form-flats');


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


if(formElem){
    formElem.addEventListener('submit', function(e){
        e.preventDefault();

        // Elementi del form, nome,cognome,data..
        const nameElem = document.getElementById('name');
        const surnameElem = document.getElementById('surname');
        const dateBirthElem = document.getElementById('date_of_birth');
        const emailElem = document.getElementById('email');
        const pswElem = document.getElementById('password');
        const checkpswElem = document.getElementById('password-confirm');
        // Const Errore per ogni elemento
        const nameErrorElem = nameElem.parentElement.querySelector('.invalid-feedback');
        const surnameErrorElem = surnameElem.parentElement.querySelector('.invalid-feedback');
        const dateErrorElem = dateBirthElem.parentElement.querySelector('.invalid-feedback');
        const emailErrorElem = emailElem.parentElement.querySelector('.invalid-feedback');
        const passwordErrorElem = pswElem.parentElement.querySelector('.invalid-feedback');
        const checkPswErrorElem = checkpswElem.parentElement.querySelector('.invalid-feedback');

        // Reset degli errori
        nameErrorElem.innerText = '';
        surnameErrorElem.innerText = '';
        dateErrorElem.innerText = '';
        emailErrorElem.innerText = '';
        passwordErrorElem.innerText = '';
        checkPswErrorElem.innerText = '';

        // Rimuovi la classe 'is-invalid' da tutti gli elementi
        nameElem.classList.remove('is-invalid');
        surnameElem.classList.remove('is-invalid');
        dateBirthElem.classList.remove('is-invalid');
        emailElem.classList.remove('is-invalid');
        pswElem.classList.remove('is-invalid');
        checkpswElem.classList.remove('is-invalid'); 

        // Validazione Name
        if (/\d/.test(nameElem.value.trim())) {
            nameErrorElem.innerText = 'Il campo nome non deve contenere numeri.';
            nameElem.classList.add('is-invalid');
        }
        // Validazione Cognome
        if (/\d/.test(surnameElem.value.trim())) {
            surnameErrorElem.innerText = 'Il campo cognome non deve contenere numeri.';
            surnameElem.classList.add('is-invalid');
        }

        const dateOfBirth = new Date(dateBirthElem.value);
        const mature = new Date();
        mature.setFullYear(mature.getFullYear() - 18);
        if (dateOfBirth >= mature) {
            dateErrorElem.innerText = 'Devi essere maggiorenne per registrarti.';
            dateBirthElem.classList.add('is-invalid');
        }

        // Validazione campo Password
        if (!pswElem.value.trim()) {
            passwordErrorElem.innerText = 'Il campo Password è obbligatorio.';
            pswElem.classList.add('is-invalid');
        } else if (pswElem.value.length < 8) {
            passwordErrorElem.innerText = 'La password deve contenere almeno 8 caratteri.';
            pswElem.classList.add('is-invalid');
        }

        // Validazione campo Conferma Password
        if (!checkpswElem.value.trim()) {
            checkPswErrorElem.innerText = 'Il campo Conferma Password è obbligatorio.';
            checkpswElem.classList.add('is-invalid');
        } else if (pswElem.value.trim() !== checkpswElem.value.trim()) {
            checkPswErrorElem.innerText = 'Le password non corrispondono.';
            checkpswElem.classList.add('is-invalid');
        }

        // Se non ci sono errori, invia il form
        if (!nameElem.classList.contains('is-invalid') &&
            !surnameElem.classList.contains('is-invalid') &&
            !dateBirthElem.classList.contains('is-invalid') &&
            !emailElem.classList.contains('is-invalid') &&
            !pswElem.classList.contains('is-invalid') &&
            !checkpswElem.classList.contains('is-invalid')) {
            this.submit();
        }
    });

}

if(logFormElem){
    logFormElem.addEventListener('submit', function(e) {
        e.preventDefault();

        const emailLog = document.getElementById('email');
        const pswLog = document.getElementById('password');

        const emailError = emailLog.parentElement.querySelector('.invalid-feedback');
        const pswError = pswLog.parentElement.querySelector('.invalid-feedback');

        //reset errori
        emailError.innerText = '';
        pswError.innerText = '';

        emailError.classList.remove('is-invalid');
        pswError.classList.remove('is-invalid');

        if(!emailLog.value.trim()){
            emailError.innerText = 'Inserisci la mail';
            emailLog.classList.add('is-invalid');
        }

        if(!pswLog.value.trim()){
            pswError.innerText = 'Inserire la password';
            pswLog.classList.add('is-invalid');
        } else if(pswLog.value.length < 8){
            pswError.innerText = 'La password deve essere di almeno 8 caratteri';
            pswLog.classList.add('is-invalid');

        }

        logFormElem.submit();

    })
}

if(multipleFileElem) {
    multipleFileElem.addEventListener('change', galleryAnteprima);
}

if(formFlatsElem){
    
    formFlatsElem.addEventListener('submit', (e)=>{
        e.preventDefault();
        validationFormFlats(formFlatsElem);
    })
}



