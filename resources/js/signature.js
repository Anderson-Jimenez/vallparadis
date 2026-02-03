document.addEventListener('DOMContentLoaded', () => {
    // Elementos del DOM
    const canvas = document.getElementById('signature');
    const ctx = canvas.getContext('2d');
    const clearBtn = document.getElementById('clear');
    const signatureInput = document.getElementById('signature_input');
    const statusElement = document.getElementById('signature-status');
    const guideElement = document.getElementById('signature-guide');
    
    // Variables de estado
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    
    // Obtener coordenadas corregidas (teniendo en cuenta scaling)
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
    
    // Configuración inicial del canvas
    function initCanvas() {
        // Configurar estilo del trazo más suave
        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#1f2937'; // Color gris oscuro más profesional
        ctx.fillStyle = '#ffffff';
        
        // Limpiar y preparar canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Dibujar línea punteada sutil en el centro
        ctx.setLineDash([5, 3]);
        ctx.lineWidth = 1;
        ctx.strokeStyle = '#e5e7eb';
        ctx.beginPath();
        ctx.moveTo(0, canvas.height / 2);
        ctx.lineTo(canvas.width, canvas.height / 2);
        ctx.stroke();
        
        // Restaurar configuración
        ctx.setLineDash([]);
        ctx.lineWidth = 2.5;
        ctx.strokeStyle = '#1f2937';
        
        // Actualizar estado
        updateStatus(false);
        
        // Mostrar guía
        if (guideElement) {
            guideElement.style.opacity = '1';
        }
    }
    
    // Actualizar estado visual
    function updateStatus(hasSignature) {
        if (!statusElement) return;
        
        const dot = statusElement.querySelector('.w-2') || statusElement.firstChild;
        const text = statusElement.querySelector('span') || statusElement.lastChild;
        
        if (hasSignature) {
            // Estado: Firma válida
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
            // Estado: Esperando firma
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
    
    // Guardar firma en input oculto
    function saveSignature() {
        if (signatureInput) {
            // Guardar como PNG de alta calidad
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
        
        // Redibujar línea punteada
        ctx.setLineDash([5, 3]);
        ctx.lineWidth = 1;
        ctx.strokeStyle = '#e5e7eb';
        ctx.beginPath();
        ctx.moveTo(0, canvas.height / 2);
        ctx.lineTo(canvas.width, canvas.height / 2);
        ctx.stroke();
        
        // Restaurar configuración
        ctx.setLineDash([]);
        ctx.lineWidth = 2.5;
        ctx.strokeStyle = '#1f2937';
        
        if (signatureInput) {
            signatureInput.value = '';
        }
        
        updateStatus(false);
    }
    
    // Iniciar dibujo
    function startDrawing(e) {
        e.preventDefault();
        isDrawing = true;
        
        const { x, y } = getCanvasCoordinates(e);
        lastX = x;
        lastY = y;
        
        ctx.beginPath();
        ctx.moveTo(x, y);
        
        // Ocultar guía inmediatamente
        if (guideElement) {
            guideElement.style.opacity = '0';
        }
    }
    
    // Dibujar
    function draw(e) {
        e.preventDefault();
        if (!isDrawing) return;
        
        const { x, y } = getCanvasCoordinates(e);
        
        ctx.lineTo(x, y);
        ctx.stroke();
        lastX = x;
        lastY = y;
    }
    
    // Detener dibujo
    function stopDrawing(e) {
        e.preventDefault();
        if (isDrawing) {
            isDrawing = false;
            saveSignature();
        }
    }
    
    // Eventos para ratón
    function setupMouseEvents() {
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);
    }
    
    // Eventos para pantalla táctil
    function setupTouchEvents() {
        canvas.addEventListener('touchstart', startDrawing);
        canvas.addEventListener('touchmove', draw);
        canvas.addEventListener('touchend', stopDrawing);
        
        // Prevenir scroll en el canvas
        canvas.addEventListener('touchmove', (e) => {
            if (isDrawing) {
                e.preventDefault();
            }
        }, { passive: false });
    }
    
    // Botón para limpiar
    if (clearBtn) {
        clearBtn.addEventListener('click', (e) => {
            e.preventDefault();
            clearCanvas();
        });
    }
    
    // Validación del formulario
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', (e) => {
            if (!signatureInput || !signatureInput.value) {
                e.preventDefault();
                
                // Mostrar error visual
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
    
    // Inicializar
    initCanvas();
    setupMouseEvents();
    setupTouchEvents();
    
    // Redibujar en resize (para mantener calidad)
    window.addEventListener('resize', () => {
        // Guardar contenido actual
        const tempCanvas = document.createElement('canvas');
        const tempCtx = tempCanvas.getContext('2d');
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;
        tempCtx.drawImage(canvas, 0, 0);
        
        // Redibujar
        initCanvas();
        ctx.drawImage(tempCanvas, 0, 0);
        
        if (signatureInput.value) {
            updateStatus(true);
        }
    });
});