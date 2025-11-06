document.addEventListener('DOMContentLoaded', () => {
    let add_monitoring_btn = document.getElementById('add_monitoring_btn');
    let add_monitoring = document.getElementById('add_monitoring');

    function changeVisibility(){
        add_monitoring.classList.remove('hidden');
        add_monitoring.classList.add('flex');
        add_monitoring.classList.add('z-50');
    }

    add_monitoring_btn.addEventListener('click',changeVisibility);
});