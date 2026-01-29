window.addEventListener('load', function() {
    const search_input = document.getElementById('search_input');
    const type_filter = document.getElementById('type_filter');
    const origin_filter = document.getElementById('origin_filter');
    const results_tbody = document.getElementById("search_results");    

    let debounce_timer;

    search_input.addEventListener("keyup", function(e) {
        clearTimeout(debounce_timer);
        
        // Nomes fer la cerca si s'ha premut una tecla que modifica el text
        if (e.key.length === 1 || e.key === 'Backspace' || e.key === 'Delete') {
            debounce_timer = setTimeout(() => {
                search();
            }, 300);
        }
    });

    // Combinar el cercador amb els filtres
    if (type_filter) {
        type_filter.addEventListener("change", search);
    }
    
    if (origin_filter) {
        origin_filter.addEventListener("change", search);
    }

    function search() {
        const searchData = {
            text: search_input.value,
            type: type_filter ? type_filter.value : '',
            origin_type: origin_filter ? origin_filter.value : ''
        };
        
        fetch(`/search-contacts`, {
            method: 'POST',
            body: JSON.stringify(searchData),
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content
            }
        })
        .then(response => response.json())
        .then(data => {
            update_table_body(data);
        })
        .catch(error => {
            console.error('Error en la búsqueda:', error);
        });
    }

    function update_table_body(data) {
        let html = "";
        
        if (search_input.value.trim() !== "" && data.data.length === 0) {
            html = `
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center">
                        <div class="text-center py-8">
                            <p class="text-gray-500">No s'han trobat contactes amb els criteris de cerca.</p>
                        </div>
                    </td>
                </tr>`;
        } else {
            for (let i in data.data) {
                const contact = data.data[i];
                
                html += `
                <tr class="hover:bg-orange-50 transition-all duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="shrink-0 h-10 w-10 bg-orange-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#ff7300]">
                                    <use xlink:href="#professional_icon"></use>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">${contact.name}</div>
                                <div class="text-sm text-gray-500">${contact.email_address}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                            ${contact.type == 'assistencials' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'}">
                            ${contact.type == 'assistencials' ? 'ASSISTENCIAL' : 'SERVEI GENERAL'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">
                        ${contact.purpose_type || 'No especificat'}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-1">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                ${contact.origin_type == 'company' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800'}">
                                ${contact.origin_type == 'company' ? 'EMPRESA' : 'DEPARTAMENT'}
                            </span>
                            <span class="text-sm text-gray-700">${contact.organization}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        ${contact.manager || 'No especificat'}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="space-y-1">
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-green-600">
                                    <use xlink:href="#phone_icon"></use>
                                </svg>
                                <a href="tel:${contact.phone_numer}" 
                                   class="hover:text-green-800 hover:underline transition-colors">
                                    ${contact.phone_numer || ''}
                                </a>
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-blue-600">
                                    <use xlink:href="#email_icon"></use>
                                </svg>
                                <a href="mailto:${contact.email_address}" 
                                   class="hover:text-blue-800 hover:underline transition-colors truncate max-w-xs">
                                    ${contact.email_address}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-700 max-w-xs">
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                ${contact.observations || 'Sense observacions'}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="/external_contacts/${contact.id}/edit" 
                               class="bg-blue-50 text-blue-600 hover:bg-blue-100 p-2 rounded-lg hover:text-blue-800 transition-all duration-300 shadow-sm hover:shadow">
                                <svg class="w-5 h-5">
                                    <use xlink:href="#edit_icon"></use>
                                </svg>
                            </a>
                            <form action="/external_contacts/${contact.id}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Estàs segur que vols eliminar aquest contacte?')">
                                <input type="hidden" name="_token" value="${document.head.querySelector('[name~=csrf-token][content]').content}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" 
                                        class="bg-red-50 text-red-600 hover:bg-red-100 p-2 rounded-lg hover:text-red-800 transition-all duration-300 shadow-sm hover:shadow">
                                    <svg class="w-5 h-5">
                                        <use xlink:href="#delete_icon"></use>
                                    </svg>
                                </button>
                            </form>
                            <a href="#" 
                               class="bg-gray-50 text-gray-600 hover:bg-gray-100 p-2 rounded-lg hover:text-gray-800 transition-all duration-300 shadow-sm hover:shadow">
                                <svg class="w-5 h-5">
                                    <use xlink:href="#view_icon"></use>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>`;
            }
        }
        
        results_tbody.innerHTML = html;
    }
});