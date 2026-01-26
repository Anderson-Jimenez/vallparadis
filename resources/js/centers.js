document.querySelectorAll('.center-item').forEach(item => {
    item.addEventListener('click', () => {

        document.getElementById('center-detail').classList.remove('hidden');

        document.getElementById('detail-name').textContent = item.dataset.name;
        document.getElementById('detail-location').textContent = item.dataset.location;
        document.getElementById('detail-phone').textContent = '+34 ' + item.dataset.phone;
        document.getElementById('detail-email').textContent = item.dataset.email;

        const status = item.dataset.status;
        const statusEl = document.getElementById('detail-status');

        if (status === 'active') {
            statusEl.textContent = 'Actiu';
            statusEl.className = 'text-green-600 font-semibold';
        } else {
            statusEl.textContent = 'Inactiu';
            statusEl.className = 'text-red-600 font-semibold';
        }
    });
});