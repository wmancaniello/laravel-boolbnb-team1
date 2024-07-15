import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";
import { mostraAnteprima, mostraToast, nascondiToast} from "./function/function";

const fileElem = document.querySelector('.ms_file');
const addressElem = document.getElementById('address');
const toastElem = document.querySelector('.ms_toast');

if(fileElem) {

    fileElem.addEventListener('change', mostraAnteprima);

}

if(addressElem) {

    addressElem.addEventListener('change', function() {
        if(addressElem.value != ""){
            const address = addressElem.value;
            const latElem = document.getElementById('latitude');
            const longElem = document.getElementById('longitude');
            

            // axios.get(`https://api.tomtom.com/search/2/search/${address}.json?key=ctbRry2wPBSIJv1NiGJX1LpPGRnd73I1&countrySet=IT&limit=1`, {
            //     headers: {
            //         'X-Requested-With' : 'XMLHttpRequest',
            //     }
            // }).then((resp) => {
            //     console.log(resp);
            // })

            fetch(`https://api.tomtom.com/search/2/search/${address}.json?key=ctbRry2wPBSIJv1NiGJX1LpPGRnd73I1&countrySet=IT&limit=1`).then(response => response.json()).then(
                (data) => {
                    console.log(data.results[0]);
                    const result = data.results[0];
                    latElem.value = result.position.lat
                    longElem.value = result.position.lon
                    const addr = result.address;
                    addressElem.value = `${addr.streetName}${addr.streetNumber ? ', ' + addr.streetNumber : '' } - ${addr.municipality} (${addr.countrySecondarySubdivision})`

                }
            )
        }
    
    });
}

if(toastElem) {

    toastElem.classList.toggle('ms_hidden');

    setTimeout(mostraToast, 200);
    
    const time = setTimeout(nascondiToast, 5000);
}