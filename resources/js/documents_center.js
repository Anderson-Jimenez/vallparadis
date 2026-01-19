document.addEventListener('DOMContentLoaded', function() {
    const file_input = document.getElementById('dropzone-file');
    const file_list = document.getElementById('file-list');
    const selected_files_div = document.getElementById('selected-files');
    
    // Array per enmagatzemar els fitxers seleccionats
    let selected_files = [];
    
    // Mostrar els arxius de la llista
    function show_files() {
        file_list.innerHTML = '';
        
        if (selected_files.length > 0) {
            selected_files_div.classList.remove('hidden');
            
            for (let i = 0; i < selected_files.length; i++) {
                const file = selected_files[i];
                
                const list_item = document.createElement('li');
                list_item.className = 'flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg mb-2';
                
                list_item.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-[#ff7300] mr-2">
                            <use xlink:href="#document_icon"></use>
                        </svg>
                        <span class="truncate text-gray-800">${file.name}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 font-medium mr-4">${(file.size / (1024 * 1024)).toFixed(2)} MB</span>
                        <button type="button" class="btn-eliminar text-red-500 hover:text-red-700" onclick="delete_file(${i})">
                            ✕
                        </button>
                    </div>
                `;
                
                file_list.appendChild(list_item);
            }
        } else {
            selected_files_div.classList.add('hidden');
            file_input.value = ''; // Netejar l'input de fitxers
        }
    }
    
    // Funció per eliminar un arxiu de la llista
    window.delete_file = function(index) {
        selected_files.splice(index, 1);
        show_files();
    };
    
    // Quan es seleccionen fitxers
    file_input.addEventListener('change', function() {
        for (let i = 0; i < this.files.length; i++) {
            selected_files.push(this.files[i]);
        }
        show_files();
    });
    
    // Validació abans d'enviar el formulari
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
        const maxSize = 10 * 1024 * 1024;
        
        if (selected_files.length === 0) {
            e.preventDefault();
            alert('Si us plau, selecciona almenys un arxiu.');
        }
        
        let flag = false;
        let i = 0;
        
        while (i < selected_files.length && !flag) {
            const file = selected_files[i];
            
            if (file.size > maxSize) {
                e.preventDefault();
                alert(`L'arxiu "${file.name}" supera el límit de 10MB.`);
                flag = true;
            }
            
            i++;
        }
        
    });
});