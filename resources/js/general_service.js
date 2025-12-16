document.addEventListener('DOMContentLoaded', () => { 
    const services = document.querySelectorAll(".service-info");
    const editBtn = document.querySelectorAll(".edit-service");
    const body = document.getElementById("bd");
    const view_div = document.getElementById("view-service");
    let edit_general_service = document.getElementById('edit_general_service');  
    const close_btn = document.getElementById("close_view_general_service");
    const close_add = document.getElementById("close_edit_general_service");  
    
    
    services.forEach(service => {

        service.addEventListener('click', () => { 
            let manager = service.dataset.manager;
            let contact = service.dataset.contact;
            let staff = service.dataset.staff;
            let schedule = service.dataset.schedule;

            document.getElementById("view_manager").textContent = manager;
            document.getElementById("view_contact").textContent = contact;
            document.getElementById("view_staff").textContent = staff;
            document.getElementById("view_schedule").textContent = schedule;

            view_div.classList.remove('hidden');
            view_div.classList.add('flex', 'z-50');
            //body.classList.add('blur-lg');
        });

    });
    editBtn.forEach(btn => {
        btn.addEventListener('click', () => { 
            const id = btn.dataset.id;
            let manager = btn.dataset.manager;
            let contact = btn.dataset.contact;
            let staff = btn.dataset.staff;
            let schedule = btn.dataset.schedule;

            const form = document.getElementById('edit_service_form');
            form.action = `/general_service/${id}`;

            document.querySelector('input[name="manager"]').value = manager;
            document.querySelector('input[name="contact"]').value = contact;

            document.querySelector('textarea[name="staff"]').value = staff;
            document.querySelector('textarea[name="schedule"]').value = schedule;

            edit_general_service.classList.remove('hidden');
            //body.classList.remove('blur-lg');
            edit_general_service.classList.add('flex', 'z-50');
        });
    
    });
    

    close_btn.addEventListener("click", () => { 
        view_div.classList.add("hidden"); 
    });
    close_add.addEventListener("click", () => { 
        edit_general_service.classList.add("hidden"); 
    });
    
});