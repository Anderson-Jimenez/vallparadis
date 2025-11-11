document.addEventListener('DOMContentLoaded', () => { 
    const evaluations = document.querySelectorAll('.evaluation-info'); 
    const view_div = document.getElementById('view-evaluations'); 
    const close_btn = document.getElementById('close_view_evaluations');
    
    //control·lar valors dels input radius per fer una "nota"
    const radios = document.querySelectorAll('input[type="radio"]');
    const total_field = document.getElementById('total_score');
    const score_display = document.getElementById('score_display');


    // Mostrar los detalles de una evaluación al hacer clic
    evaluations.forEach(evaluation => { 
        evaluation.addEventListener('click', () => { 
            view_div.classList.remove('hidden');
            view_div.classList.add('flex', 'z-50');
        }); 
    }); 

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            let total = 0;

            for (let i = 1; i <= 20; i++) {
                const selected = document.querySelector(`input[name="q${i}"]:checked`);
                if (selected) {
                    total += parseInt(selected.value);
                }
            }

            
            const score_10 = Math.round((total / 80) * 10);;
            total_field.value = score_10;
            score_display.textContent = score_10;
        });
    });

    // Cerrar vista de detalles
    if (close_btn) {
        close_btn.addEventListener('click', () => { 
            view_div.classList.add('hidden'); 
        });
    }
});
