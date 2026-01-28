// resources/js/accident_followup.js
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.followup-item');
    
    items.forEach(function(item) {
        item.addEventListener('click', function() {
            const date = this.getAttribute('data-date');
            const issue = this.getAttribute('data-issue');
            const description = this.getAttribute('data-description');
            const professional = this.getAttribute('data-professional');
            
            document.getElementById('view_followup_date').textContent = date;
            document.getElementById('view_followup_issue').textContent = issue;
            document.getElementById('view_followup_description').textContent = description;
            document.getElementById('view_followup_professional').textContent = professional;
            
            document.getElementById('view-followup').classList.remove('hidden');
            document.getElementById('view-followup').classList.add('flex');
        });
    });
    
    document.getElementById('close_view_followup').addEventListener('click', function() {
        document.getElementById('view-followup').classList.remove('flex');
        document.getElementById('view-followup').classList.add('hidden');
    });
    
    document.getElementById('close_view_followup_btn').addEventListener('click', function() {
        document.getElementById('view-followup').classList.remove('flex');
        document.getElementById('view-followup').classList.add('hidden');
    });
    
    document.getElementById('view-followup').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('flex');
            this.classList.add('hidden');
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('view-followup').classList.add('hidden');
        }
    });
});