document.addEventListener('DOMContentLoaded', () => { 
    // --- MODAL "AÑADIR" ---
    const addBtn = document.getElementById('add_monitoring_btn');
    const addModal = document.getElementById('add_monitoring');
    const closeAddBtn = document.getElementById('close_add_monitoring');
    const overlay = document.getElementById("overlay");

    if (addBtn) {
        addBtn.addEventListener('click', (e) => {
            e.preventDefault();
            addModal.classList.remove('hidden');
            addModal.classList.add('flex', 'z-50');
            overlay.classList.remove('hidden');
        });
    }

    if (closeAddBtn) {
        closeAddBtn.addEventListener('click', (e) => {
            e.preventDefault();
            addModal.classList.add('hidden');
            addModal.classList.remove('flex', 'z-50');
            overlay.classList.add('hidden');
        });
    }

    // --- MODAL "VER" ---
    const followups = document.querySelectorAll('.monitoring-info');
    const viewModal = document.getElementById('view-monitoring');
    const closeViewBtn = document.getElementById('close_view_monitoring');

    followups.forEach(followup => {
        followup.addEventListener('click', () => {
            // Sacar valores de inputs ocultos
            const date = followup.querySelector('.followup-date').value;
            const issue = followup.querySelector('.followup-issue').value;
            const comment = followup.querySelector('.followup-comment').value;

            // Ponerlos en el modal
            document.getElementById('view_monitoring_date').textContent = date;
            document.getElementById('view_monitoring_issue').textContent = issue;
            document.getElementById('view_monitoring_comments').textContent = comment;

            // Mostrar modal
            viewModal.classList.remove('hidden');
            viewModal.classList.add('flex', 'z-50');
            overlay.classList.remove('hidden');
        });
    });

    if (closeViewBtn) {
        closeViewBtn.addEventListener('click', () => {
            viewModal.classList.add('hidden');
            viewModal.classList.remove('flex', 'z-50');
            overlay.classList.add('hidden');
        });
    }
});
