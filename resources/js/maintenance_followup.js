document.addEventListener('DOMContentLoaded', () => {

    const overlay = document.getElementById('overlay');

    const addBtn = document.getElementById('add_followup_btn');
    const addModal = document.getElementById('add_followup_modal');
    const closeAdd = document.getElementById('close_add_followup');

    const viewModal = document.getElementById('view_followup_modal');
    const closeView = document.getElementById('close_view_followup');

    addBtn.onclick = () => {
        addModal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    };

    closeAdd.onclick = () => {
        addModal.classList.add('hidden');
        overlay.classList.add('hidden');
    };

    document.querySelectorAll('.followup-card').forEach(card => {
        card.onclick = () => {
            document.getElementById('v_date').textContent =
                card.querySelector('.fu-date').value;

            document.getElementById('v_issue').textContent =
                card.querySelector('.fu-issue').value;

            document.getElementById('v_desc').textContent =
                card.querySelector('.fu-desc').value;

            const docs = JSON.parse(
                card.querySelector('.fu-docs').value
            );

            const docsContainer = document.getElementById('v_docs');
            docsContainer.innerHTML = '';

            docs.forEach(doc => {
                docsContainer.innerHTML += `
                    <a href="/maintenance-followup-doc/${doc.id}/download"
                       class="block text-orange-500 hover:underline">
                        📄 ${doc.name}
                    </a>`;
            });

            viewModal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        };
    });

    closeView.onclick = () => {
        viewModal.classList.add('hidden');
        overlay.classList.add('hidden');
    };
});
