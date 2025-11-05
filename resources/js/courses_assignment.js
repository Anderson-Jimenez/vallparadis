document.addEventListener('DOMContentLoaded', () => {
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
    var drag_caixa = document.querySelector("[draggable]");
    var drop_zona = document.getElementById("drop_zona");
    var drop_estat = document.getElementById("drop_estat");
    drag_caixa.addEventListener("dragstart", gestionarDragStart);
    drop_zona.addEventListener("dragover", gestionarDragDrop);
    drop_zona.addEventListener("drop", gestionarDragDrop);
});