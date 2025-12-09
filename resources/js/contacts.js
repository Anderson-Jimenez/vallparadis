document.addEventListener('DOMContentLoaded', function() {
    const search_input = document.getElementById('searchInput');
    const purpose_filter = document.getElementById('purposeFilter');
    const origin_filter = document.getElementById('originFilter');
    const search_results = document.getElementById('searchResults');
    const loading_spinner = document.getElementById('loadingSpinner');
    
    // Variable per controlar el timeout
    let timeout_id;
    
    search_input.addEventListener('input', function() {
        clearTimeout(timeout_id);
        
        const text = search_input.value;
        
        const purpose = purpose_filter.value;
        const origin = origin_filter.value;
        
        // 4. Si el texto tiene al menos 2 caracteres...
        if (text.length >= 2) {
            // 5. Mostramos el spinner de carga
            loading_spinner.classList.remove('hidden');
            
            // 6. Esperamos 300ms antes de hacer la petición
            // (para no hacer una petición por cada tecla)
            timeout_id = setTimeout(() => {
                // 7. HACEMOS LA PETICIÓN FETCH
                buscarContactos(text, purpose, origin);
            }, 300);
        } else if (text.length === 0) {
            // 8. Si no hay texto, limpiamos los resultados
            search_results.innerHTML = '<p class="text-gray-500">Escriu per cercar contactes...</p>';
        }
    });
    
    // También cuando cambien los filtros
    purpose_filter.addEventListener('change', function() {
        buscarSiHayTexto();
    });
    
    origin_filter.addEventListener('change', function() {
        buscarSiHayTexto();
    });
    
    // Función auxiliar
    function buscarSiHayTexto() {
        const texto = search_input.value.trim();
        if (texto.length >= 2) {
            buscarContactos(texto, purpose_filter.value, origin_filter.value);
        }
    }
    
    // LA FUNCIÓN IMPORTANTE: Hacer la petición fetch
    function buscarContactos(texto, purpose, origin) {
        // 1. Construimos la URL con los parámetros
        let url = '{{ route("buscar.contactos") }}?q=' + encodeURIComponent(texto);
        
        if (purpose) {
            url += '&purpose=' + encodeURIComponent(purpose);
        }
        
        if (origin) {
            url += '&origin=' + encodeURIComponent(origin);
        }
        
        console.log("Haciendo petición a:", url);
        
        // 2. HACEMOS LA PETICIÓN FETCH
        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            // 3. Verificamos que la respuesta sea OK
            if (!response.ok) {
                throw new Error('Error en la respuesta');
            }
            // 4. Convertimos la respuesta a JSON
            return response.json();
        })
        .then(datos => {
            // 5. Ocultamos el spinner
            loading_spinner.classList.add('hidden');
            
            // 6. Mostramos los resultados
            mostrarResultados(datos);
        })
        .catch(error => {
            // 7. Si hay error, lo mostramos
            loading_spinner.classList.add('hidden');
            console.error('Error:', error);
            search_results.innerHTML = '<p class="text-red-500">Error en la cerca</p>';
        });
    }
    
    // Función para mostrar los resultados
    function mostrarResultados(contactos) {
        if (contactos.length === 0) {
            search_results.innerHTML = '<p class="text-gray-500">No s\'han trobat resultats</p>';
            return;
        }
        
        let html = '';
        
        contactos.forEach(contacto => {
            html += `
                <div class="contact-item bg-white w-full p-4 mb-3 rounded shadow">
                    <div class="grid grid-cols-4 gap-4">
                        <p><strong>Nom:</strong> ${contacto.name}</p>
                        <p><strong>Motiu/Servei:</strong> ${contacto.purpose_type}</p>
                        <p><strong>Origen:</strong> ${contacto.origin_type}</p>
                        <p><strong>Organització:</strong> ${contacto.organization}</p>
                    </div>
                </div>
            `;
        });
        
        // Agregar contador
        html += `<div class="mt-4 text-sm text-gray-600">
                    Trobats: ${contactos.length} contactes
                    </div>`;
        
        search_results.innerHTML = html;
    }
});