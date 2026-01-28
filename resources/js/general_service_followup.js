document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.monitoring-item');
    
    items.forEach(function(item) {
        item.addEventListener('click', function() {
            const date = this.getAttribute('data-date');
            const issue = this.getAttribute('data-issue');
            const comment = this.getAttribute('data-comment');
            
            document.getElementById('view_monitoring_date').textContent = date;
            document.getElementById('view_monitoring_issue').textContent = issue;
            document.getElementById('view_monitoring_comments').textContent = comment;
            
            document.getElementById('view-monitoring').classList.remove('hidden');
            document.getElementById('view-monitoring').classList.add('flex');
            
        });
    });
    
    document.getElementById('close_view_monitoring').addEventListener('click', function() {
        document.getElementById('view-monitoring').classList.remove('flex');
        document.getElementById('view-monitoring').classList.add('hidden');
    });
    
    document.getElementById('close_view_btn').addEventListener('click', function() {
        document.getElementById('view-monitoring').classList.remove('flex');
        document.getElementById('view-monitoring').classList.add('hidden');
    });
    
    document.getElementById('view-monitoring').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('flex');
            this.classList.add('hidden');
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('view-monitoring').classList.add('hidden');
        }
    });
});