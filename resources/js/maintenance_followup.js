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

            // Limpiar documentos
            const docsContainer = document.getElementById('view_followup_docs');
            docsContainer.innerHTML = '';

            const docs = JSON.parse(item.dataset.docs || '[]');
            if(docs.length === 0){
                docsContainer.innerHTML = '<span class="text-sm text-gray-400">No hi ha documents</span>';
            } else {
                docs.forEach(doc => {
                    const a = document.createElement('a');
                    a.href = doc.url;
                    a.target = "_blank";
                    a.className = "flex items-center gap-1 hover:text-orange-600";
                    a.innerHTML = `
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4h16v-4M12 12v8m0 0l-4-4m3 3l4-4M12 4v8"></path>
                        </svg>
                        ${doc.name}
                    `;
                    docsContainer.appendChild(a);
                });
            }

            modal.classList.remove('hidden');
        });
    });

});
