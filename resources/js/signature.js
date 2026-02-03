document.addEventListener('DOMContentLoaded', () => {
    // Elementos del DOM
    const canvas = document.getElementById('signature');
    const ctx = canvas.getContext('2d');
    const clearBtn = document.getElementById('clear');
    const signatureInput = document.getElementById('signature_input');
    const statusElement = document.getElementById('signature-status');
    const guideElement = document.getElementById('signature-guide');
    
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    
    function getCanvasCoordinates(event) {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvas.width / rect.width;
        const scaleY = canvas.height / rect.height;
        
        if (event.type.includes('touch')) {
            const touch = event.touches[0];
            return {
                x: (touch.clientX - rect.left) * scaleX,
                y: (touch.clientY - rect.top) * scaleY
            };
        } else {
            return {
                x: (event.offsetX || event.clientX - rect.left) * scaleX,
                y: (event.offsetY || event.clientY - rect.top) * scaleY
            };
        }
    }
    //Configuració per defecte lineas
    function initCanvas() {
        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#1f2937';
        ctx.fillStyle = '#ffffff';
        
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        ctx.setLineDash([5, 3]);
        ctx.lineWidth = 1;
        ctx.strokeStyle = '#e5e7eb';
        ctx.beginPath();
        ctx.moveTo(0, canvas.height / 2);
        ctx.lineTo(canvas.width, canvas.height / 2);
        ctx.stroke();
        
        ctx.setLineDash([]);
        ctx.lineWidth = 2.5;
        ctx.strokeStyle = '#1f2937';
        
        updateStatus(false);
        
        if (guideElement) {
            guideElement.style.opacity = '1';
        }
    }
    
    function updateStatus(hasSignature) {
        if (!statusElement) return;
        
        const dot = statusElement.querySelector('.w-2') || statusElement.firstChild;
        const text = statusElement.querySelector('span') || statusElement.lastChild;
        
        if (hasSignature) {
            if (dot) {
                dot.className = 'w-2 h-2 bg-green-500 rounded-full mr-2';
                dot.classList.remove('animate-pulse');
            }
            if (text) {
                text.textContent = 'Firma vàlida';
                text.className = 'text-sm font-medium text-gray-700';
            }
            statusElement.className = 'flex items-center px-3 py-2 bg-green-50 rounded-lg border border-green-200 min-w-[140px]';
            
            if (guideElement) {
                guideElement.style.opacity = '0';
                guideElement.style.transition = 'opacity 0.3s ease';
            }
        } else {
            if (dot) {
                dot.className = 'w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse';
            }
            if (text) {
                text.textContent = 'Firma pendent';
                text.className = 'text-sm font-medium text-gray-700';
            }
            statusElement.className = 'flex items-center px-3 py-2 bg-gray-50 rounded-lg border border-gray-200 min-w-[140px]';
            
            if (guideElement) {
                guideElement.style.opacity = '1';
                guideElement.style.transition = 'opacity 0.3s ease';
            }
        }
    }
    
    function saveSignature() {
        if (signatureInput) {
            signatureInput.value = canvas.toDataURL('image/png');
            updateStatus(true);
        }
    }
    
    // Limpiar canvas
    function clearCanvas() {
        isDrawing = false;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        ctx.setLineDash([5, 3]);
        ctx.lineWidth = 1;
        ctx.strokeStyle = '#e5e7eb';
        ctx.beginPath();
        ctx.moveTo(0, canvas.height / 2);
        ctx.lineTo(canvas.width, canvas.height / 2);
        ctx.stroke();
        
        ctx.setLineDash([]);
        ctx.lineWidth = 2.5;
        ctx.strokeStyle = '#1f2937';
        
        if (signatureInput) {
            signatureInput.value = '';
        }
        
        updateStatus(false);
    }
    
    function startDrawing(e) {
        e.preventDefault();
        isDrawing = true;
        
        const { x, y } = getCanvasCoordinates(e);
        lastX = x;
        lastY = y;
        
        ctx.beginPath();
        ctx.moveTo(x, y);
        
        if (guideElement) {
            guideElement.style.opacity = '0';
        }
    }
    
    function draw(e) {
        e.preventDefault();
        if (!isDrawing) return;
        
        const { x, y } = getCanvasCoordinates(e);
        
        ctx.lineTo(x, y);
        ctx.stroke();
        lastX = x;
        lastY = y;
    }
    
    function stopDrawing(e) {
        e.preventDefault();
        if (isDrawing) {
            isDrawing = false;
            saveSignature();
        }
    }
    
    function setupMouseEvents() {
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);
    }
    
    
    if (clearBtn) {
        clearBtn.addEventListener('click', (e) => {
            e.preventDefault();
            clearCanvas();
        });
    }
    
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', (e) => {
            if (!signatureInput || !signatureInput.value) {
                e.preventDefault();
                
                statusElement.className = 'flex items-center px-3 py-2 bg-red-50 rounded-lg border border-red-200 min-w-[140px]';
                const dot = statusElement.querySelector('.w-2');
                const text = statusElement.querySelector('span');
                
                if (dot) {
                    dot.className = 'w-2 h-2 bg-red-600 rounded-full mr-2';
                }
                if (text) {
                    text.textContent = 'Firma obligatòria!';
                    text.className = 'text-sm font-medium text-red-700';
                }
                
                // Scroll al canvas
                canvas.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Animación de alerta
                canvas.classList.add('border-red-400', 'shake');
                setTimeout(() => {
                    canvas.classList.remove('border-red-400', 'shake');
                }, 1000);
                
                return false;
            }
        });
    }
    
    initCanvas();
    setupMouseEvents();
    setupTouchEvents();
    
    window.addEventListener('resize', () => {
        const tempCanvas = document.createElement('canvas');
        const tempCtx = tempCanvas.getContext('2d');
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;
        tempCtx.drawImage(canvas, 0, 0);
        
        initCanvas();
        ctx.drawImage(tempCanvas, 0, 0);
        
        if (signatureInput.value) {
            updateStatus(true);
        }
    });
});