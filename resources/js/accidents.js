// resources/js/accidents.js - VERSIÓN CORREGIDA
document.addEventListener('DOMContentLoaded', function() {
    console.log('Accidents JS loaded');
    
    // Función para desplegar/replegar detalles del accidente
    window.toggleAccidentDetails = function(accidentId) {
        const details = document.getElementById('details-' + accidentId);
        const arrow = document.getElementById('arrow-' + accidentId);
        
        if (!details || !arrow) {
            console.error('Elementos no encontrados para accidentId:', accidentId);
            return;
        }
        
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            details.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    };

    // Para mostrar el nombre del archivo seleccionado
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const accidentId = this.id.replace('file-', '');
            const fileName = this.files[0] ? this.files[0].name : 'Cap fitxer seleccionat';
            const displayElement = document.getElementById('file-name-' + accidentId);
            if (displayElement) {
                displayElement.textContent = fileName;
            }
        });
    });

    // Asignar eventos click a todos los elementos accident-item
    document.querySelectorAll('.accident-item').forEach(item => {
        const accidentId = item.getAttribute('data-accident-id');
        
        if (accidentId) {
            item.addEventListener('click', function(e) {
                // Evitar que se active si se hace click en un link, botón o input
                if (e.target.tagName === 'A' || 
                    e.target.tagName === 'BUTTON' || 
                    e.target.tagName === 'INPUT' ||
                    e.target.tagName === 'LABEL' ||
                    e.target.closest('a') || 
                    e.target.closest('button') ||
                    e.target.closest('input') ||
                    e.target.closest('label')) {
                    return;
                }
                toggleAccidentDetails(accidentId);
            });
        }
    });
});