import Dropzone from "dropzone";

// Dz va a buscar un elemento que tenga la clase de dropzone, pero lo vamos a definir nosotros hacia que endpoint
Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube tu imagen aqui',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,
});

dropzone.on("sending", function(file, xhr, formData) {
    console.log(formData);
})

dropzone.on("success", function(file, response) {
    console.log(response);
})

dropzone.on("removedfile", function() {
    console.log('File deleted');
})