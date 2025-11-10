document.addEventListener('DOMContentLoaded', () => { 
    let add_monitoring_btn = document.getElementById('add_monitoring_btn'); 
    let add_monitoring = document.getElementById('add_monitoring'); 
    const monitorings = document.querySelectorAll(".monitoring-info"); 
    const view_div = document.getElementById("view-monitoring"); 
    const close_btn = document.getElementById("close_view_monitoring");
    const close_add = document.getElementById("close_add_monitoring");  
    
    function changeVisibility(){ 
        add_monitoring.classList.remove('hidden'); 
        add_monitoring.classList.add('flex'); 
        add_monitoring.classList.add('z-50'); 
    } 
    add_monitoring_btn.addEventListener('click',changeVisibility); 
        
    monitorings.forEach(monitoring => { 
        monitoring.addEventListener('click', () => { 
            const input = monitoring.querySelectorAll('input'); 
            let professional_name = input[0].value; 
            let monitoring_type = input[1].value; 
            let date = input[2].value; 
            let issue = input[3].value; 
            let comments = input[4].value; 

            document.getElementById("view_monitoring_type").textContent = monitoring_type;
            document.getElementById("view_monitoring_date").textContent = date;
            document.getElementById("view_monitoring_issue").textContent = issue;
            document.getElementById("view_monitoring_comments").textContent = comments;
            document.getElementById("view_professional_name").textContent = professional_name;
            document.getElementById("view_monitoring_by").textContent = "{{ Auth::user()->name }}";

            view_div.classList.remove('hidden');
            view_div.classList.add('flex', 'z-50');
        }); 

    }); 
    close_btn.addEventListener("click", () => { 
        view_div.classList.add("hidden"); 
    });
    close_add.addEventListener("click", () => { 
        add_monitoring.classList.add("hidden"); 
    });
});