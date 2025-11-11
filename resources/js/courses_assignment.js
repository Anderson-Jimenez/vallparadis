document.addEventListener('DOMContentLoaded', () => {

    const professionals = document.querySelectorAll('.professional');
    const assigned_zone = document.getElementById("assigned_zone");
    const professionals_list = document.getElementById("professionals_list");
    const saveBtn = document.getElementById("save_assignments");
    const course_id = document.getElementById('course_id').value;
    
    const meta = document.querySelector('meta[name="csrf-token"]');
    const token = meta ? meta.getAttribute('content') : '';

    let dragged_id = null;

    // Cuando cogemos un profesional de la lista
    function gestionar_dragStart(event, professional_id){
        dragged_id = professional_id;
        event.dataTransfer.setData("professional_id", professional_id);
    }

    // Permitir soltar
    function allowDrop(event){
        event.preventDefault();
    }

    // Soltar en zona asignada
    function dropInAssigned(event) {
        event.preventDefault();

        const professional_id = event.dataTransfer.getData("professional_id");
        const exists = assigned_zone.querySelector(`[data-id="${professional_id}"]`);

        if (!exists) {
            const original = document.getElementById(professional_id);
            const clone = original.cloneNode(true);
            clone.dataset.id = professional_id;

            clone.addEventListener("dragstart", (event) => {
                event.dataTransfer.setData("professional_id", professional_id);
            });

            assigned_zone.appendChild(clone);
        }
    }

    // Soltar de vuelta en la lista (eliminar clon)
    function dropBackToList(event){
        event.preventDefault();

        const professional_id = event.dataTransfer.getData("professional_id");

        
        const element = assigned_zone.querySelector(`[data-id="${professional_id}"]`);
        if (element) {
            element.remove();
        }
    }

    // Activar drag para cada profesional 
    professionals.forEach(professional => {
        const input_professional = professional.querySelector("input");
        const professional_id = input_professional.value;

        professional.addEventListener("dragstart", (event) =>{
            gestionar_dragStart(event, professional_id);
        });
    });

    // Eventos de arrastre hacia zonas
    assigned_zone.addEventListener("dragover", allowDrop);
    assigned_zone.addEventListener("drop", dropInAssigned);

    professionals_list.addEventListener("dragover", allowDrop);
    professionals_list.addEventListener("drop", dropBackToList);

    // Guardar asignaciones
    saveBtn.addEventListener("click", () => {
        const assignedIds = [...assigned_zone.querySelectorAll("[data-id]")].map(el => el.dataset.id);

        fetch('/assign_professional_to_course', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                course_id: course_id,
                professionals: assignedIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'ok') {
                
                window.location.href = data.redirect;
            }
        })
        .catch(() => {
            alert("Error al guardar la asignación.");
        });
    });

});

/* 
document.addEventListener('DOMContentLoaded', () => {
    const professionals = document.querySelectorAll('.professional');
    let course_id = document.getElementById('course_id').value;
    console.log(course_id);
    
    const meta = document.querySelector('meta[name="csrf-token"]');
    const token = meta ? meta.getAttribute('content') : '';

    const drop_zona = document.getElementById("drop_zona");
    const drop_estat = document.getElementById("drop_estat");
    
    function gestionarDragStart(event, professional_id){
        event.dataTransfer.setData("professional_id", professional_id);
    }
            
    function gestionarDragDrop(event){
        event.preventDefault();
        if (event.type == "dragover"){
            drop_estat.innerHTML = "Esteu arrossegant sobre la zona de diexar caure!";
        }
        else{
            const professional_id = event.dataTransfer.getData("professional_id");
            drop_estat.innerHTML = `Assignat Professional ID: ${professional_id}`;
            fetch('/assign_professional_to_course', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    professional_id: professional_id,
                    course_id: course_id
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Error del servidor');
                return response.json();
            })
            .catch(error => {
                console.error('Error fetch:', error);
                drop_estat.innerHTML = '<p class="text-red-600">Error en la consulta</p>';
            });

        }
    }
    

    professionals.forEach(professional => {   
        const input_professional = professional.querySelectorAll('input');
        let professional_id = input_professional[0].value;
        console.log(professional_id);
        professional.addEventListener("dragstart", (event) =>{
            gestionarDragStart(event, professional_id);
        });
    });
    
    drop_zona.addEventListener("dragover", gestionarDragDrop);
    drop_zona.addEventListener("drop", gestionarDragDrop);
});
*/