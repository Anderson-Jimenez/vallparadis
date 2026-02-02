document.addEventListener('DOMContentLoaded', () => {
    // Elements del DOM
    const addMonitoringBtn = document.getElementById('add_monitoring_btn');
    const addMonitoringEmptyBtn = document.getElementById('add_monitoring_empty_btn');
    const addMonitoringModal = document.getElementById('add_monitoring_modal');
    const closeAddMonitoring = document.getElementById('close_add_monitoring');
    const cancelAddMonitoring = document.getElementById('cancel_add_monitoring');
    const register_by = document.getElementById('register_by').value;
 
    const viewMonitoringModal = document.getElementById('view_monitoring_modal');
    const closeViewMonitoring = document.getElementById('close_view_monitoring');
    const closeViewModalBtn = document.getElementById('close_view_modal_btn');
    
    // Funcions per obrir modals
    function openAddMonitoringModal() {
        addMonitoringModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function openViewMonitoringModal() {
        viewMonitoringModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    // Funcions per tancar modals
    function closeAllModals() {
        addMonitoringModal.classList.add('hidden');
        viewMonitoringModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Event listeners per botons
    addMonitoringBtn?.addEventListener('click', openAddMonitoringModal);
    addMonitoringEmptyBtn?.addEventListener('click', openAddMonitoringModal);
    
    // Tancar modals
    closeAddMonitoring?.addEventListener('click', closeAllModals);
    cancelAddMonitoring?.addEventListener('click', closeAllModals);
    closeViewMonitoring?.addEventListener('click', closeAllModals);
    closeViewModalBtn?.addEventListener('click', closeAllModals);
    
    // Tancar modal en fer clic fora
    [addMonitoringModal, viewMonitoringModal].forEach(modal => {
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeAllModals();
            }
        });
    });
    
    // Event listener per seguiments
    document.querySelectorAll('.monitoring-info').forEach(monitoring => {
        monitoring.addEventListener('click', () => {
            // Obtenir dades de data attributes
            const monitoringId = monitoring.dataset.id;
            const issue = monitoring.dataset.issue;
            const type = monitoring.dataset.type;
            const date = monitoring.dataset.date;
            const comments = monitoring.dataset.comments;
            const professionalName = monitoring.dataset.professionalName;
            
            // Omplir modal de visualització
            document.getElementById('view_monitoring_id').textContent = `#${monitoringId}`;
            document.getElementById('view_monitoring_date').textContent = date;
            document.getElementById('view_monitoring_type').textContent = type;
            document.getElementById('view_monitoring_issue').textContent = issue;
            document.getElementById('view_monitoring_comments').textContent = comments;
            document.getElementById('view_professional_name').textContent = professionalName;
            document.getElementById('view_monitoring_by').textContent = register_by;
            
            // Obrir modal
            openViewMonitoringModal();
        });
    });
    
    // Prevenir l'enviament del formulari si hi ha errors de validació
    const form = document.querySelector('form[action*="monitoring.store"]');
    form?.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#ef4444';
                isValid = false;
            } else {
                field.style.borderColor = '#d1d5db';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Si us plau, omple tots els camps obligatoris.');
        }
    });
});