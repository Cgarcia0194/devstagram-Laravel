import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Arrastra o presiona clic aquí",
    acceptedFiles: ".jpg,.png,.jpeg,.gif,.svg",
    addRemoveLinks: true,
    dictRemoveFile: "Quitar archivo",
    maxFiles: 1,
    maxFilesize: 2,
    dictFileTooBig: 'El archivo supera el tamaño admitido (2MB)',
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 500;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});


dropzone.on('sending', (file, xhr, formData) => {
    // console.log(file);
});

dropzone.on('success', (file, response) => {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('error', (file, message) => {
    // console.log(message);
});

dropzone.on('removedfile', () => {
    // console.log('archivo removido');
    document.querySelector('[name="imagen"]').value = null;
});
