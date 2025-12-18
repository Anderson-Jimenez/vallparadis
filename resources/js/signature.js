const canvas = document.getElementById('signature');
const line = canvas.getContext('2d');
const clear_btn = document.getElementById('clear');
const input = document.getElementById('signature_input');

let is_drawing = false;

line.lineWidth = 2;
line.lineCap = 'round';


canvas.addEventListener('mousedown', (e) => {
    is_drawing = true;
    line.beginPath();
    line.moveTo(e.offsetX, e.offsetY);
});

canvas.addEventListener('mousemove', (e) => {
    if (!is_drawing){return;}
    line.lineTo(e.offsetX, e.offsetY);
    line.stroke();
});

canvas.addEventListener('mouseup', () => {
    is_drawing = false;

    //guardar dibuix com a imatge
    input.value = canvas.toDataURL();
});

//limpiar canvas
clear_btn.addEventListener('click', () => {
    line.clearRect(0, 0, canvas.width, canvas.height);
    input.value = '';
});