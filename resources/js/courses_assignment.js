document.addEventListener('DOMContentLoaded', () => {
    const professionals = document.querySelectorAll('.professional');
    const input_course = document.querySelectorAll('input');
    let course_id = input_course[0].value;
    console.log(course_id);
    
    const meta = document.querySelector('meta[name="csrf-token"]');
    const token = meta ? meta.getAttribute('content') : '';

    const drop_zona = document.getElementById("drop_zona");
    const drop_estat = document.getElementById("drop_estat");
    
    function gestionarDragStart(professional, professional_id){
        professional.dataTransfer.setData("text", professional_id);
    }
            
    function gestionarDragDrop(professional){
        professional.preventDefault();
        if (professional.type == "dragover"){
            drop_estat.innerHTML = "Esteu arrossegant sobre la zona de diexar caure!";
        }
        else{
            drop_estat.innerHTML  = professional.dataTransfer.getData("text");
            fetch('/assign_professional_to_course', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ professional_id: professional_id , course_id: course_id})
            });
        }
    }
    

    professionals.forEach(professional => {   
        const input_professional = professional.querySelectorAll('input');
        let professional_id = input_professional[0].value;
        console.log(professional_id);
        professional.addEventListener("dragstart", (professional) =>{
            gestionarDragStart(professional, professional_id);
        });
    });
    
    drop_zona.addEventListener("dragover", gestionarDragDrop);
    drop_zona.addEventListener("drop", gestionarDragDrop);
});