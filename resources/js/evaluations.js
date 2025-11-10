document.addEventListener('DOMContentLoaded', () => { 
    const evaluations = document.querySelectorAll('.evaluation-info'); 
    const view_div = document.getElementById('view-evaluations'); 
    const close_btn = document.getElementById('close_view_evaluations');


    // Mostrar los detalles de una evaluación al hacer clic
    evaluations.forEach(evaluation => { 
        evaluation.addEventListener('click', () => { 
            view_div.classList.remove('hidden');
            view_div.classList.add('flex', 'z-50');
        }); 
    }); 

    // Cerrar vista de detalles
    if (close_btn) {
        close_btn.addEventListener('click', () => { 
            view_div.classList.add('hidden'); 
        });
    }
});
