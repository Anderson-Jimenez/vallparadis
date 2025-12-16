document.addEventListener('DOMContentLoaded', () => { 
    const services = document.querySelectorAll(".supp-service-info");
    const body = document.getElementById("bd");
    const editBtn = document.querySelectorAll(".edit-supp-service");
    const view_div = document.getElementById("view-supp-service");
    let edit_supp_service = document.getElementById('edit_supp_service');  
    const close_btn = document.getElementById("close_view_supp_service");
    const close_add = document.getElementById("close_edit_supp_service");  
    
    
    services.forEach(service => {

        service.addEventListener('click', () => { 
            let type = service.dataset.type;
            let start_date = service.dataset.start_date;
            let manager = service.dataset.manager;
            let email_address = service.dataset.email_address;
            let phone_number = service.dataset.phone_number;
            let comments = service.dataset.comments;
            
            document.getElementById("view_type").textContent = type;
            document.getElementById("view_start_date").textContent = start_date;
            document.getElementById("view_manager").textContent = manager;
            document.getElementById("view_email_address").textContent = email_address;
            document.getElementById("view_phone_number").textContent = phone_number;
            document.getElementById("view_comments").textContent = comments;

            view_div.classList.remove('hidden');
            view_div.classList.add('flex', 'z-50');
            body.classList.add('blur-lg');
        });

    });
    editBtn.forEach(btn => {
        btn.addEventListener('click', () => { 
            const id = btn.dataset.id;
            let type = btn.dataset.type;
            let start_date = btn.dataset.start_date;
            let manager = btn.dataset.manager;
            let email_address = btn.dataset.email_address;
            let phone_number = btn.dataset.phone_number;
            let comments = btn.dataset.comments;

            const form = document.getElementById('edit_supp_service_form');
            form.action = `/supplementary_service/${id}`;

            document.querySelector('#edit_supp_service input[name="type"]').value = type;
            document.querySelector('#edit_supp_service input[name="start_date"]').value = start_date;
            document.querySelector('#edit_supp_service input[name="manager"]').value = manager;
            document.querySelector('#edit_supp_service input[name="email_address"]').value = email_address;
            document.querySelector('#edit_supp_service input[name="phone_number"]').value = phone_number;
            document.querySelector('#edit_supp_service textarea[name="comments"]').value = comments;

            edit_supp_service.classList.remove('hidden');
            edit_supp_service.classList.add('flex', 'z-50');
            
        });
    
    });
    

    close_btn.addEventListener("click", () => { 
        view_div.classList.add("hidden"); 
    });
    close_add.addEventListener("click", () => { 
        edit_supp_service.classList.add("hidden"); 
    });
    
});