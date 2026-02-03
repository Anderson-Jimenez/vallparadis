document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('view-followup');
    const closeBtn = document.getElementById('close_view_followup');
    const closeBtnFooter = document.getElementById('close_view_followup_btn');

    function closeModal() {
        modal.classList.add('hidden');
    }

    closeBtn.addEventListener('click', closeModal);
    closeBtnFooter.addEventListener('click', closeModal);

    // Abrir modal y rellenar datos
    document.querySelectorAll('.followup-item').forEach(item => {
        item.addEventListener('click', () => {

            document.getElementById('view_followup_date').innerText = item.dataset.date;
            document.getElementById('view_followup_issue').innerText = item.dataset.issue;
            document.getElementById('view_followup_professional').innerText = item.dataset.professional;
            document.getElementById('view_followup_description').innerText = item.dataset.description;

            // Documentos (copiar HTML ya renderizado)
            const docsContainer = document.getElementById('view_followup_docs');
            docsContainer.innerHTML = '';

            const docsHtml = item.querySelector('.followup-docs')?.innerHTML;
            docsContainer.innerHTML = docsHtml ? docsHtml : '<span class="text-sm text-gray-400">No hi ha documents</span>';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    // Cerrar clicando fuera
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Cerrar con ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

});
