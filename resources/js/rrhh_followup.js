document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.followup-item');
    
    items.forEach(function(item) {
        item.addEventListener('click', function() {
            const date = this.getAttribute('data-date');
            const professional = this.getAttribute('data-professional');
            const description = this.getAttribute('data-description');
            const docs = JSON.parse(this.getAttribute('data-docs') || '[]');

            document.getElementById('view_followup_date').textContent = date;
            document.getElementById('view_followup_professional').textContent = professional;
            document.getElementById('view_followup_description').textContent = description;

            const docsContainer = document.getElementById('view_followup_docs');
            docsContainer.innerHTML = '';
            docs.forEach(doc => {
                const link = document.createElement('a');
                link.href = doc.url;
                link.textContent = doc.name;
                link.target = '_blank';
                link.className = 'text-blue-600 hover:underline';
                docsContainer.appendChild(link);
            });

            document.getElementById('view-followup').classList.remove('hidden');
            document.getElementById('view-followup').classList.add('flex');
        });
    });
    
    function closeModal() {
        document.getElementById('view-followup').classList.remove('flex');
        document.getElementById('view-followup').classList.add('hidden');
    }

    document.getElementById('close_view_followup').addEventListener('click', closeModal);
    document.getElementById('close_view_followup_btn').addEventListener('click', closeModal);
    document.getElementById('view-followup').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
});
