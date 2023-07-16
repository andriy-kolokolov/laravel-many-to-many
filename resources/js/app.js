import './bootstrap';

import '~resources/scss/app.scss';
import.meta.glob([
    '../img/**'
]);
import * as bootstrap from 'bootstrap';
import './partials/footer.js'


const confirmDelete = document.querySelector('#confirm-delete');
if (confirmDelete) {
    document.querySelectorAll('.js-delete').forEach(button => {
        button.addEventListener('click', function () {
            confirmDelete.action = confirmDelete.dataset.template.replace('*****', this.dataset.id);
        });
    })
}

// alert success fade out animation
if (document.querySelector('.js-success-alert')) {
    setTimeout(function() {
        let successAlert = document.querySelector('.js-success-alert');
        successAlert.classList.remove('show');
        successAlert.addEventListener('transitionend', function() {
            successAlert.style.display = 'none';
        });
    }, 2000);
}

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
