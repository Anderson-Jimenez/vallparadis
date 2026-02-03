window.addEventListener('load', function() {
    const search_input = document.getElementById('search_rrhh');
    const status_filter = document.getElementById('status_filter');
    const issues_container = document.getElementById("issues_container");    

    let debounce_timer;

    search_input.addEventListener("keyup", function(e) {
        clearTimeout(debounce_timer);
        
        // Només fer la cerca si s'ha premut una tecla que modifica el text
        if (e.key.length === 1 || e.key === 'Backspace' || e.key === 'Delete') {
            debounce_timer = setTimeout(() => {
                search();
            }, 300);
        }
    });

    // Filtre per estat
    if (status_filter) {
        status_filter.addEventListener("change", search);
    }

    function search() {
        const search_data = {
            text: search_input.value,
            status: status_filter ? status_filter.value : 'tots'
        };
        
        fetch(`/search-hr-issues`, {
            method: 'POST',
            body: JSON.stringify(search_data),
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content
            }
        })
        .then(response => response.json())
        .then(data => {
            update_issues_list(data);
        })
        .catch(error => {
            console.error('Error en la búsqueda:', error);
        });
    }

    function update_issues_list(data) {
        let html = "";
        
        if (search_input.value.trim() !== "" && data.data.length === 0) {
            html = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4">
                        <use xlink:href="#search_icon"></use>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">No s'han trobat resultats</h3>
                    <p class="text-gray-600">Prova amb altres paraules clau o filtres</p>
                </div>`;
        } else if (data.data.length === 0) {
            html = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4">
                        <use xlink:href="#folder_icon"></use>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">No hay temas pendientes</h3>
                    <p class="text-gray-600 mb-6">Comienza creando un nuevo tema pendiente</p>
                    <a href="/hr_pending_issue/create" 
                       class="inline-flex items-center text-white bg-[#ff7300] hover:bg-orange-700 rounded-lg px-5 py-3 font-medium">
                        + Crear primer tema
                    </a>
                </div>`;
        } else {
            for (let i in data.data) {
                const issue = data.data[i];
                
                // Formatejar la data
                const opened_date = new Date(issue.opened_at);
                const formatted_date = opened_date.toLocaleDateString('ca-ES', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });

                // Badge d'estat
                let status_badge = '';
                if (issue.status == 'urgent') {
                    status_badge = `
                        <span class="px-3 py-2 bg-red-100 text-red-800 rounded-2xl text-sm font-medium flex items-center h-max">
                            Urgent
                        </span>`;
                } else if (issue.status == 'in_process') {
                    status_badge = `
                        <span class="px-3 py-2 bg-blue-100 text-blue-800 rounded-2xl text-sm font-medium flex items-center h-max">
                            En process
                        </span>`;
                } else if (issue.status == 'completed') {
                    status_badge = `
                        <span class="px-3 py-2 bg-gray-100 text-gray-800 rounded-2xl text-sm font-medium flex items-center h-max">
                            Finalitzat
                        </span>`;
                } else {
                    status_badge = `
                        <span class="px-3 py-2 bg-orange-100 text-orange-800 rounded-2xl text-sm font-medium flex items-center h-max">
                            Pendent
                        </span>`;
                }

                html += `
                <div class="bg-white rounded-xl shadow-md border border-gray-300 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Estado -->
                    <div class="px-6 pt-4 flex justify-between border border-[#f0f0f0] bg-gray-50">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">
                                ${issue.context}
                            </h3>
                            <div class="flex items-center text-gray-600 text-sm">
                                <span class="font-medium">Data Obertura:</span>
                                <span class="ml-2">${formatted_date}</span>
                            </div>
                        </div>
                        
                        ${status_badge}
                    </div>
            
                    <div class="p-6">
                        <!-- Professionals implicats -->
                        <div class="flex items-center mb-4 space-x-6 justify-start gap-20">
                            <div>
                                <span class="font-medium text-gray-700">Registrat per</span>
                                <div class="flex mt-1 items-center">
                                    <svg class="w-6 h-6 text-gray-500 mr-2">
                                        <use xlink:href="#professional_icon"></use>
                                    </svg>
                                    <span class="text-gray-500 text-sm flex items-center">
                                        ${issue.registered_by_professional ? issue.registered_by_professional.name : 'No especificat'}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Professional Afectat</span>
                                <div class="flex items-center mt-1">
                                    <svg class="w-5 h-5 text-gray-500 mr-2">
                                        <use xlink:href="#professional_icon"></use>
                                    </svg>
                                    <span class="text-gray-500 text-sm flex items-center">
                                        ${issue.affected_professional ? issue.affected_professional.name : 'No especificat'}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Derivat a</span>
                                <div class="flex mt-1 items-center">
                                    <svg class="w-6 h-6 text-gray-500 mr-2">
                                        <use xlink:href="#professional_icon"></use>
                                    </svg>
                                    <span class="text-gray-500 text-sm flex items-center">
                                        ${issue.derived_to_professional ? issue.derived_to_professional.name : 'No derivat'}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Descripción -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Descripció</h4>
                            <p class="text-gray-600 line-clamp-2">
                                ${issue.description}
                            </p>
                        </div>
                        <hr class="text-gray-300">
                        <!-- Documentos -->
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2">
                                    <use xlink:href="#attached_icon"></use>
                                </svg>
                                <span class="text-gray-600 text-sm flex items-center">
                                    ${issue.documents ? issue.documents.length : 0} document(s) adjunt(s)
                                </span>
                            </div>
                            
                            <!-- Accions -->
                            <div class="flex space-x-3">
                                <a href="/hr_pending_issues/${issue.id}/followups" 
                                   class="text-[#ff7300] hover:text-orange-700 font-medium text-sm px-4 py-2 rounded-lg border border-[#ff7300] hover:bg-orange-50 transition-colors duration-200">
                                   Veure/Afegir seguiments
                                </a>
                                <a href="/hr_pending_issue/${issue.id}" 
                                   class="text-[#ff7300] hover:text-orange-700 font-medium text-sm px-4 py-2 rounded-lg border border-[#ff7300] hover:bg-orange-50 transition-colors duration-200">
                                   Veure detalls
                                </a>
                                <a href="/hr_pending_issue/${issue.id}/edit" 
                                   class="text-gray-700 hover:text-gray-900 font-medium text-sm px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
            }
        }
        
        issues_container.innerHTML = html;
    }
});