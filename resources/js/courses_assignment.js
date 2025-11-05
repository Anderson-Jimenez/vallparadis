document.addEventListener('DOMContentLoaded', () => {
    const professionals = document.querySelectorAll('.professional');
    const drop_zona = document.getElementById("drop_zona");
    const drop_estat = document.getElementById("drop_estat");
    function gestionarDragStart(e){
        e.dataTransfer.setData("text", "HEu deixat caure quelcom!");
    }
            
    function gestionarDragDrop(e){
        e.preventDefault();
        if (e.type == "dragover"){
            drop_estat.innerHTML = "Esteu arrossegant sobre la zona de diexar caure!";
        }
        else{
            drop_estat.innerHTML  = e.dataTransfer.getData("text");
        }
    }
    

    professionals.forEach(professional => {   
        professional.addEventListener("dragstart", gestionarDragStart);
    });
    drop_zona.addEventListener("dragover", gestionarDragDrop);
    drop_zona.addEventListener("drop", gestionarDragDrop);
});