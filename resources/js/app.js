import Dropzone from "dropzone";
import './bootstrap';
import 'daisyui';

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alertSuccess = document.querySelector('#alert-success');
        if (alertSuccess) {
            alertSuccess.style.display = 'none';
        }
    }, 3000); // 3000 milisegundos = 3 segundos
});


// DROPZONE
Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Drop files here or click to upload',
    acceptedFiles: '.jpg, .jpeg, .png, .gif, .svg',
    addRemoveLinks: true,
    dictRemoveFile: 'Remove file',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const publishedImage = {}
            publishedImage.size = 1234;
            publishedImage.name = document.querySelector('[name="image"]').value

            this.options.addedfile.call(this, publishedImage);
            this.options.thumbnail.call(this, publishedImage, `/uploads/${publishedImage.name}`);

            publishedImage.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
})


// dropzone.on('addedfile', function (file) {
//     console.log(file);
// })

dropzone.on('success', function (file, response) {
    document.querySelector('[name="image"]').value = response.image
})

dropzone.on('error', function (file, response) {
    console.log(response);
})

dropzone.on('removedfile', function (file) {
    document.querySelector('[name="image"]').value = ''
})



