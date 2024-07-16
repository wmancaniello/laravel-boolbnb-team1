export function mostraAnteprima(event) {
    const file = event.target.files[0];

    if (file && file.type.includes('image')) {
        // crea un oggetto che legge il contenuto del file
        const reader = new FileReader();

        // quando ha finito di leggerlo
        reader.onload = function (e) {
            // estrapola il codice codificato del file
            const immagine = e.target.result;
            const imageElem = document.getElementById('anteprima-immagine');
            imageElem.src = immagine;
            imageElem.classList.add('mb-3');
        };
        // converte il file in una stringa url
        reader.readAsDataURL(file);
    } else {
        const imageElem = document.getElementById('anteprima-immagine');
        imageElem.src = "";
        imageElem.classList.remove('mb-3');
    }
}

export function mostraToast() {
    const lineElem = document.querySelector('.ms_line');
    const toastElem = document.querySelector('.ms_toast');
    lineElem.classList.toggle('ms_hidden');
    lineElem.classList.toggle('w-100');
}

export function nascondiToast() {
    const lineElem = document.querySelector('.ms_line');
    const toastElem = document.querySelector('.ms_toast');
    toastElem.classList.toggle('ms_hidden');
    lineElem.classList.toggle('ms_hidden');
}

export function galleryAnteprima(event) {
    const galleryPreviewElem = document.getElementById('gallery-preview');
    const filePhoto = [...event.target.files];
    galleryPreviewElem.innerHTML = "";


    filePhoto.forEach(photo => {
        if (photo.type.includes('image')) {

            const imgElem = document.createElement('img');
            imgElem.classList.add('gallery-image', 'w-25', 'm-2');
            galleryPreviewElem.appendChild(imgElem);
        }
    });

    const galleryElem = document.querySelectorAll('.gallery-image');

    let i = 0
    galleryElem.forEach(img => {



        console.log(filePhoto[i]);
        if (filePhoto[i] && filePhoto[i].type.includes('image')) {
            // crea un oggetto che legge il contenuto del file
            const reader = new FileReader();

            // quando ha finito di leggerlo
            reader.onload = function (e) {
                // estrapola il codice codificato del file
                const immagine = e.target.result;
                console.log(immagine);
                img.src = immagine;
                // imageElem.classList.add('mb-3');
            };
            // converte il file in una stringa url
            reader.readAsDataURL(filePhoto[i]);
        } else {
            img.src = "";

        }

        i++;
    });
}

export function TomTomApi() {

    const query = this.value;
    if (query.length < 3) {
        document.getElementById('dropdown').innerHTML = '';
        document.getElementById('dropdown').classList.remove('show');
        return;
    }
    const apiKey = 'ZcdgGKenw2zWR1ufYKujLP0vgRMnGtMM';
    const versionNumber = '2';
    const ext = 'json';
    const url = `https://api.tomtom.com/search/${versionNumber}/search/${query}.${ext}?key=${apiKey}&typeahead=true&limit=10&countrySet=IT`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const suggestions = data.results;
            console.log(suggestions);
            let dropdownContent = '';
            suggestions.forEach(suggestion => {
                const address = suggestion.address.freeformAddress;
                dropdownContent += `<a class="suggerimenti" href="#" data-lat="${suggestion.position.lat}" data-lon="${suggestion.position.lon}">${address}</a>`;
            });
            document.getElementById('dropdown').innerHTML = dropdownContent;
            document.getElementById('dropdown').classList.add('show');

            const sugg = document.querySelectorAll('.suggerimenti');
            sugg.forEach(element => {
                element.addEventListener('click', function () {
                    document.getElementById('address').value = element.innerHTML;
                    document.getElementById('dropdown').innerHTML = '';
                    document.getElementById('dropdown').classList.remove('show');
                    const latElem = document.getElementById('latitude');
                    const longElem = document.getElementById('longitude');
                    
                    
                    latElem.value = element.dataset.lat;   
                    longElem.value = element.dataset.lon;

                    console.log(latElem);

                });
            });
        })
        .catch(error => {
            console.error('Errore nella richiesta:', error);
        });


}