export function mostraAnteprima(event) {
    const file = event.target.files[0];

    if (file && file.type.includes('image')) {
        // crea un oggetto che legge il contenuto del file
        const reader = new FileReader();

        // quando ha finito di leggerlo
        reader.onload = function (e) {
            // estrapola il codice codificato del file
            const immagine = e.target.result;
            const previewElem = document.querySelector('.preview-image');
            previewElem.innerHTML = "";
            const imageElem = document.createElement('img');
            const spanElem = document.createElement('span');
            spanElem.classList.add('x-image');
            imageElem.id = 'anteprima-immagine';
            // const imageElem = document.getElementById('anteprima-immagine');
            imageElem.src = immagine;
            imageElem.classList.add('image-preview');
            previewElem.appendChild(spanElem);
            previewElem.appendChild(imageElem);
            // previewElem.classList.add('x-image');
            
            document.querySelector('.x-image').addEventListener('click', resetAnteprima);
        };
        // converte il file in una stringa url
        reader.readAsDataURL(file);
    } else {
        const previewElem = document.querySelector('.preview-image');
        previewElem.innerHTML = "";
    }
}

function resetAnteprima() {
    const inputElem = document.querySelector('.main_img');
    const imageElem = document.getElementById('anteprima-immagine');
    const spanElem = document.querySelector('.x-image');
    inputElem.value = "";
    imageElem.src = "";
    imageElem.style.display = 'none';
    imageElem.classList.remove('image-preview');
    imageElem.classList.remove('mb-3');
    spanElem.classList.remove('x-image');
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
            const previewElem = document.createElement('div');
            const spanElem = document.createElement('span');
            spanElem.classList.add('x-image');
            previewElem.classList.add('preview-image', 'position-relative', 'd-inline-block');
            imgElem.classList.add('gallery-image', 'm-2', 'image-preview', 'rounded');
            galleryPreviewElem.appendChild(previewElem);
            previewElem.appendChild(imgElem);
            previewElem.appendChild(spanElem);

            spanElem.addEventListener('click', function () {
                galleryPreviewElem.removeChild(previewElem);
                resetInputFile(event.target, photo.name);
            });
        }
    });

    const galleryElem = document.querySelectorAll('.gallery-image');

    let i = 0
    galleryElem.forEach(img => {




        if (filePhoto[i] && filePhoto[i].type.includes('image')) {
            // crea un oggetto che legge il contenuto del file
            const reader = new FileReader();

            // quando ha finito di leggerlo
            reader.onload = function (e) {
                // estrapola il codice codificato del file
                const immagine = e.target.result;

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

function resetInputFile(inputElem, fileName) {
    const dataTransfer = new DataTransfer();
    const files = inputElem.files;
    console.log(files);
    for (let i = 0; i < files.length; i++) {
        if (files[i].name !== fileName) {
            dataTransfer.items.add(files[i]);
        }
    }

    inputElem.files = dataTransfer.files;
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

            let dropdownContent = '';
            suggestions.forEach(suggestion => {
                const address = suggestion.address.freeformAddress;
                dropdownContent += `<a class="suggerimenti" href="#" data-lat="${suggestion.position.lat}" data-lon="${suggestion.position.lon}">${address}</a>`;
            });
            const latElem = document.getElementById('latitude');
            const longElem = document.getElementById('longitude');
            latElem.value = "";
            longElem.value = "";

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



                });
            });
        })
        .catch(error => {
            console.error('Errore nella richiesta:', error);
        });



}

export function validationFormFlats(formFlatsElem) {

    // elementi input form
    const titleElem = document.getElementById('title');
    const maxGuestsElem = document.getElementById('max_guests');
    const roomsElem = document.getElementById('rooms');
    const bedsElem = document.getElementById('beds');
    const bathroomsElem = document.getElementById('bathrooms');
    const metersSquareElem = document.getElementById('meters_square');
    const visibleElem = document.getElementById('visible');
    const addressElem = document.getElementById('address');
    const descriptionElem = document.getElementById('description');
    const latElem = document.getElementById('latitude');
    const lonElem = document.getElementById('longitude');
    const servicesElem = document.querySelectorAll('[name^="service"]:checked');
    const mainImgElem = document.getElementById('main_img') ? document.getElementById('main_img').files : null;
    const mainImgEditElem = document.getElementById('main_img-edit') ? document.getElementById('main_img-edit').files : null;
    const photosElem = [...document.getElementById('photos').files];
    console.log(photosElem);

    // label
    const labelTitle = document.querySelector('[for="title"]');
    const labelMaxGuests = document.querySelector('[for="max_guests"]');
    const labelRooms = document.querySelector('[for="rooms"]');
    const labelBeds = document.querySelector('[for="beds"]');
    const labelBathrooms = document.querySelector('[for="bathrooms"]');
    const labelMetersSquare = document.querySelector('[for="meters_square"]');
    const labelVisible = document.querySelector('[for="visible"]');   
    const labelAddress = document.querySelector('[for="address"]'); 
    const labelDescription = document.querySelector('[for="description"]');
    const labelMainImg = document.querySelector('[for="main_img"]');
    const labelPhotos = document.querySelector('[for="photos"]');



    const modalServiceElem = document.querySelector('.modal-services');
    

    let error = false;

    if (titleElem) {
        const resp = validateInputString(titleElem, 5)
        if (!resp) {
            titleElem.classList.add('is-invalid');
            labelTitle.innerHTML = "Il titolo deve avere almeno 5 caratteri";
            error = true;
        } else {
            titleElem.classList.remove('is-invalid');
            labelTitle.innerHTML = "Inserisci Titolo *";

        }
    }

    if (maxGuestsElem) {
        const resp = validateInputNumber(maxGuestsElem, 1)
        if (!resp) {
            maxGuestsElem.classList.add('is-invalid');
            labelMaxGuests.innerHTML = "Numero minimo di ospiti 1";
            error = true;
        } else {
            maxGuestsElem.classList.remove('is-invalid');
            labelMaxGuests.innerHTML = "Numero Ospiti *";

        }
    }

    if (roomsElem) {
        const resp = validateInputNumber(roomsElem, 1)
        if (!resp) {
            roomsElem.classList.add('is-invalid');
            labelRooms.innerHTML = "Numero minimo di stanze 1";
            error = true;
        } else {
            roomsElem.classList.remove('is-invalid');
            labelRooms.innerHTML = "Numero Stanze *";
        }
    }

    if (bedsElem) {
        const resp = validateInputNumber(bedsElem, 1)
        if (!resp) {
            bedsElem.classList.add('is-invalid');
            labelBeds.innerHTML = "Numero minimo di letti 1";
            error = true;
        } else {
            bedsElem.classList.remove('is-invalid');
            labelBeds.innerHTML = "Numero Letti *";
        }
    }

    if (bathroomsElem) {
        const resp = validateInputNumber(bathroomsElem, 1)
        if (!resp) {
            bathroomsElem.classList.add('is-invalid');
            labelBathrooms.innerHTML = "Numero minimo di bagni 1";
            error = true;
        } else {
            bathroomsElem.classList.remove('is-invalid');
            labelBathrooms.innerHTML = "Numero Bagni *";

        }
    }

    if (metersSquareElem) {
        const resp = validateInputNumber(metersSquareElem, 1)
        if (!resp) {
            metersSquareElem.classList.add('is-invalid');
            labelMetersSquare.innerHTML = "Numero minimo di mq 5";
            error = true;
        } else {
            metersSquareElem.classList.remove('is-invalid');
            labelMetersSquare.innerHTML = "Metri quadrati *";
        }
    }

    if (visibleElem) {
        if (!(visibleElem.value === "1" || visibleElem.value === "0")) {
            visibleElem.classList.add('is-invalid');
            labelVisible.innerHTML = "Seleziona Si o No";
            error = true;
        } else {
            visibleElem.classList.remove('is-invalid');
            labelVisible.innerHTML = "Visibile *";
        }
    }

    if(addressElem) {
        const resp = validateInputString(latElem, 2) && validateInputNumber(lonElem, 2);
        
        if(!resp) {
            addressElem.classList.add('is-invalid');
            labelAddress.innerHTML = "Seleziona un indirizzo suggerito"
            error = true;
        } else {
            addressElem.classList.remove('is-invalid');
            labelAddress.innerHTML = "Indirizzo *";
        }
    }

        if(descriptionElem) {
            const resp = descriptionElem.value.trim().length >= 20;
            

            if(!resp) {
                descriptionElem.classList.add('is-invalid');
                labelDescription.innerHTML = "La descrizione deve avere minimo 20 caratteri"
                error = true;
            } else {
                descriptionElem.classList.remove('is-invalid');
                labelDescription.innerHTML = "Descrizione *";
            }

    }

    if(servicesElem && servicesElem.length>0) {
        const titleService = document.getElementById('title-service')

        for (let index = 0; index < servicesElem.length; index++) {
            
            if(parseInt(servicesElem[index].value) < 0 || parseInt(servicesElem[index].value) > 20 ) {
    
                modalServiceElem.classList.add('ms_is-invalid');
                modalServiceElem.classList.remove('ms_border');
                titleService.innerHTML = "Seleziona i servizi <br> Hai selezionato un valore non valido";
                error = true; 
                break;
            } else {
                modalServiceElem.classList.remove('ms_is-invalid');
                modalServiceElem.classList.add('ms_border');
                titleService.innerHTML = "Seleziona i servizi"
                
            }
            
        }
            
        
        

    }

    if (mainImgElem) {
        const boxmainImg = document.getElementById('box-main-img');

        if(mainImgElem.length > 0) {
            if(!mainImgElem[0].type.includes('image')) {
                boxmainImg.classList.add('ms_is-invalid');
                boxmainImg.classList.remove('ms_border');
                labelMainImg.innerHTML = "Inserisci foto principale: * <br> Il file selezionato non è un'immagine";
                error = true;
            } else if(mainImgElem[0].size > 5 * 1024 * 1024) {
                boxmainImg.classList.add('ms_is-invalid');
                boxmainImg.classList.remove('ms_border');
                labelMainImg.innerHTML = "Inserisci foto principale: * <br> Il file selezionato deve esse più piccolo di 5MB";
                error = true;
            } else {
                boxmainImg.classList.remove('ms_is-invalid');
                boxmainImg.classList.add('ms_border');
                labelMainImg.innerHTML = "Inserisci foto principale: *";
                console.log(mainImgElem[0].size);
            }

        } else {
            boxmainImg.classList.add('ms_is-invalid');
                boxmainImg.classList.remove('ms_border');
                labelMainImg.innerHTML = "Inserisci foto principale: * <br> L'immagine di copertina è obbligatoria";
                error = true;
        }
    }

    if (mainImgEditElem && mainImgEditElem.length > 0) {
        const boxmainImg = document.getElementById('box-main-img');

            if(!mainImgEditElem[0].type.includes('image')) {
                boxmainImg.classList.add('ms_is-invalid');
                boxmainImg.classList.remove('ms_border');
                labelMainImg.innerHTML = "Inserisci foto principale: * <br> Il file selezionato non è un'immagine";
                error = true;
            } else if(mainImgEditElem[0].size > 5 * 1024 * 1024) {
                boxmainImg.classList.add('ms_is-invalid');
                boxmainImg.classList.remove('ms_border');
                labelMainImg.innerHTML = "Inserisci foto principale: * <br> Il file selezionato deve esse più piccolo di 5MB";
                error = true;
            }else {
                boxmainImg.classList.remove('ms_is-invalid');
                boxmainImg.classList.add('ms_border');
                labelMainImg.innerHTML = "Inserisci foto principale: *"
            
            }

    }

    if (photosElem && photosElem.length > 0) {
        const boxphotosImg = document.getElementById('box-photos-img');
        console.log(photosElem);


                for (let index = 0; index < photosElem.length; index++) {
                    
                    if(!photosElem[index].type.includes('image')) {
                        boxphotosImg.classList.add('ms_is-invalid');
                        boxphotosImg.classList.remove('ms_border');
                        labelPhotos.innerHTML = "Inserisci foto aggiuntive: <br> I file selezionati non sono immagini";
                        error = true;
                        break;
                    } else if(photosElem[index].size >  5 * 1024 * 1024) {

                        boxphotosImg.classList.add('ms_is-invalid');
                        boxphotosImg.classList.remove('ms_border');
                        labelPhotos.innerHTML = "Inserisci foto aggiuntive: <br> I file selezionati superano la dimensione massima di 5MB a file";
                        error = true;
                        break;
                    } else {
                        boxphotosImg.classList.remove('ms_is-invalid');
                        boxphotosImg.classList.add('ms_border');
                        labelPhotos.innerHTML = "Inserisci foto aggiuntive:";
                    
                    }
                    
                }

            
        
        
            
        
    }



    window.scroll(0, 0);
    if(!error) {
        formFlatsElem.submit();
    }
}

function validateInputNumber(input, minNum) {
    return parseInt(input.value) >= minNum;
}

function validateInputString(input, minChar) {
    return input.value.trim().length >= minChar;
}
