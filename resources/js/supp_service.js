document.addEventListener('DOMContentLoaded', () => { 
    // Elementos
    const viewModal = document.getElementById("viewServiceModal");
    const editModal = document.getElementById("editServiceModal");
    const editForm = document.getElementById("editServiceForm");
    
    // Funciones para manejar modales
    const openModal = (modal) => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('backdrop-blur-sm', 'bg-gray-100/80');
    };
    
    const closeModal = (modal) => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('backdrop-blur-sm', 'bg-gray-100/80');
    };
    
    // Abrir modal de vista
    document.querySelectorAll(".view-service-btn").forEach(button => {
        button.addEventListener('click', () => { 
            // Actualizar contenido
            document.getElementById("modalViewType").textContent = button.dataset.type || '—';
            document.getElementById("modalViewStartDate").textContent = button.dataset.start_date 
                ? new Date(button.dataset.start_date).toLocaleDateString('es-ES') 
                : '—';
            document.getElementById("modalViewManager").textContent = button.dataset.manager || '—';
            document.getElementById("modalViewEmail").textContent = button.dataset.email_address || '—';
            document.getElementById("modalViewPhone").textContent = button.dataset.phone_number || '—';
            document.getElementById("modalViewComments").textContent = button.dataset.comments || '—';
            
            openModal(viewModal);
        });
    });
    
    // Abrir modal de edición (CORREGIDO - estaba abriendo viewModal en lugar de editModal)
    document.querySelectorAll(".edit-service-btn").forEach(button => {
        button.addEventListener('click', () => { 
            editForm.action = `/supplementary_service/${button.dataset.id}`;
            
            // Actualizar campos del formulario
            document.getElementById("editType").value = button.dataset.type || '';
            document.getElementById("editStartDate").value = button.dataset.start_date || '';
            document.getElementById("editManager").value = button.dataset.manager || '';
            document.getElementById("editEmail").value = button.dataset.email_address || '';
            document.getElementById("editPhone").value = button.dataset.phone_number || '';
            document.getElementById("editComments").value = button.dataset.comments || '';
            
            openModal(editModal); // CORRECCIÓN: Ahora abre editModal
        });
    });
    
    // Eventos para cerrar modales
    document.getElementById("closeViewModal")?.addEventListener("click", () => closeModal(viewModal));
    document.getElementById("closeEditModal")?.addEventListener("click", () => closeModal(editModal));
    document.getElementById("cancelEditModal")?.addEventListener("click", () => closeModal(editModal));
    
    // Cerrar al hacer clic fuera
    [viewModal, editModal].forEach(modal => {
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) closeModal(modal);
        });
    });
    
    // Cerrar con tecla Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal(viewModal);
            closeModal(editModal);
        }
    });
});