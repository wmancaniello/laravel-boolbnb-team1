export function mostraAnteprima(event) {
    const file = event.target.files[0];

    if ( file && file.type.includes('image')) {
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
            if ( filePhoto[i] && filePhoto[i].type.includes('image')) {
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