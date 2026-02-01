document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const course_items = document.querySelectorAll('.course-item');
    const detail_section = document.getElementById('course-detail');
    const no_course_selected = document.getElementById('no-course-selected');
    const csrf_token = document.querySelector('meta[name="csrf-token"]')?.content || '';
    
    // Función para renderizar el detalle del curso
    function render_course_detail(course_item) {
        const detail_content = document.getElementById('detail-content');
        
        if (!detail_content) {
            console.error('No se encontró el elemento detail-content');
            return;
        }
        
        // Obtener datos del curso según tus campos disponibles
        const course_id = course_item.dataset.id;
        const course_name = course_item.dataset.name;
        const course_code = course_item.dataset.code || 'Sense codi';
        const course_hours = course_item.dataset.hours || 0;
        const course_type = course_item.dataset.type || 'No especificat';
        const course_mode = course_item.dataset.mode || 'No especificat';
        const course_status = course_item.dataset.status || 'active';
        const course_center_id = course_item.dataset.centerId;
        const course_center_name = course_item.dataset.centerName || 'Centre no assignat';
        
        // Determinar el texto y color según el estado
        let status_text, status_class, status_icon, status_bg, status_hover;
        if (course_status === 'active') {
            status_text = 'Actiu';
            status_class = 'text-[#16A34A]';
            status_icon = 'check_icon';
            status_bg = 'bg-[#DCFCE7]';
            status_hover = 'hover:bg-[#BBF7D0]';
        } else {
            status_text = 'Inactiu';
            status_class = 'text-[#DC2626]';
            status_icon = 'x_icon';
            status_bg = 'bg-[#FEE2E2]';
            status_hover = 'hover:bg-[#FECACA]';
        }
        
        // Generar el HTML del detalle usando solo los campos disponibles
        detail_content.innerHTML = `
            <div class="flex w-full justify-around">
                <div class="p-6 my-10 bg-white shadow-md rounded-xl w-11/12 flex flex-col gap-3 border border-gray-300">
                    <div class="flex items-center justify-between p-1">
                        <div class="flex items-center">
                            <svg class="w-20 h-20 mr-5 sidebar-gradient text-white rounded-lg p-3">
                                <use xlink:href="#courses_icon"></use>
                            </svg>
                            <div>
                                <h2 class="text-2xl font-bold text-black">${course_name}</h2>
                                <p class="text-gray-600 text-base mt-1">${course_code}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="/course/${course_id}/edit" 
                               class="flex items-center rounded-lg px-6 py-3 text-white sidebar-gradient hover:opacity-90 transition-all duration-300 shadow-md">
                                <svg class="w-5 h-5 inline-block mr-2">
                                    <use xlink:href="#edit_icon"></use>
                                </svg>
                                Editar
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex gap-8 p-4">
                        <div class="flex flex-col gap-6 w-1/2">
                            <h2 class="font-semibold text-gray-700 border-b-2 border-gray-200 text-2xl pb-3">
                                Informació del Curs
                            </h2>
                            
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <svg class="w-13 h-13 text-gray-500 bg-gray-100 rounded-lg p-3 mr-4 shrink-0">
                                        <use xlink:href="#courses_icon"></use>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-gray-700 text-base">Nom del curs</h3>
                                        <p class="text-base font-semibold text-gray-900 mt-1">${course_name}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <svg class="w-13 h-13 text-gray-500 bg-gray-100 rounded-lg p-3 mr-4 shrink-0">
                                        <use xlink:href="#forcem_icon"></use>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-gray-700 text-base">Codi FORCEM</h3>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">${course_code}</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-13 h-13 text-gray-500 bg-gray-100 rounded-lg p-3 mr-4 shrink-0">
                                        <use xlink:href="#clock_icon"></use>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-gray-700 text-base">Hores totals</h3>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">${course_hours} hores</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-6  w-1/2">
                            <h2 class="font-semibold text-gray-700 border-b-2 border-gray-200 text-2xl pb-3">
                                Tipus i Modalitat
                            </h2>
                            
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <svg class="w-13 h-13 text-gray-500 bg-gray-100 rounded-lg p-3 mr-4 shrink-0">
                                        <use xlink:href="#course_type_icon"></use>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-gray-700 text-base">Tipus de curs</h3>
                                        <p class="text-base font-semibold text-gray-900 mt-1">${course_type}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <svg class="w-13 h-13 text-gray-500 bg-gray-100 rounded-lg p-3 mr-4 shrink-0">
                                        <use xlink:href="#online_icon"></use>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-gray-700 text-base">Modalitat</h3>
                                        <p class="text-base font-semibold text-gray-900 mt-1">${course_mode}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-4">
                                <form action="/course/${course_id}" method="POST" class="inline delete-form">
                                    <input type="hidden" name="_token" value="${csrf_token}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" 
                                            class="flex items-center bg-red-600 text-white rounded-lg px-5 py-3 hover:bg-red-700 transition-all duration-300 shadow-md"
                                            onclick="return confirm('Estàs segur que vols eliminar aquest curs?')">
                                        <svg class="w-5 h-5 inline-block mr-2">
                                            <use xlink:href="#course_delete_icon"></use>
                                        </svg>
                                        Eliminar Curs
                                    </button>
                                </form>
                                <form action="/course/${course_id}/activate" method="GET" class="inline">
                                    <input type="hidden" name="_token" value="${csrf_token}">
                                    <button type="submit" 
                                            class="flex items-center ${status_bg} ${status_class} rounded-lg px-5 py-3 ${status_hover} transition-all duration-300 shadow-md">
                                        <svg class="w-5 h-5 inline-block mr-2">
                                            <use xlink:href="#${status_icon}"></use>
                                        </svg>
                                        ${status_text}
                                    </button>
                                </form>
                            </div>
                            <div>
                                <a href="/course/${course_id}/assign_professional" 
                                    class="flex items-center rounded-lg w-55 px-4 py-2 text-white bg-[#ff7300] hover:opacity-90 transition-all duration-300 shadow-md">
                                    <svg class="w-5 h-5 inline-block mr-2">
                                        <use xlink:href="#add_prof_icon"></use>
                                    </svg>
                                    Assignar Professional
                                </a>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Mostrar el contenido y ocultar el mensaje de selección
        detail_content.classList.remove('hidden');
        no_course_selected.classList.add('hidden');
    }
    
    // Manejar clics en los items de curso
    course_items.forEach(item => {
        item.addEventListener('click', (event) => {
            // Prevenir que el clic en los enlaces/forms dentro del item active la selección
            if (event.target.closest('a') || event.target.closest('form') || event.target.closest('button')) {
                return;
            }
            
            // Quitar selección de todos los items
            course_items.forEach(i => {
                i.classList.remove('bg-orange-100', 'border-orange-600');
            });
            
            // Resaltar el item seleccionado
            item.classList.add('bg-orange-100', 'border-orange-600');
            
            // Renderizar el detalle del curso
            render_course_detail(item);
        });
    });
    
    // Prevenir la propagación de eventos en los botones/forms dentro de los items
    course_items.forEach(item => {
        const interactiveElements = item.querySelectorAll('a, form, button');
        interactiveElements.forEach(element => {
            element.addEventListener('click', (event) => {
                event.stopPropagation();
            });
        });
    });
    
    // Si hay cursos, seleccionar el primero automáticamente
    if (course_items.length > 0) {
        course_items[0].click();
    }
    
    // Confirmación para eliminación de cursos
    const delete_forms = document.querySelectorAll('.delete-form');
    delete_forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Estàs segur que vols eliminar aquest curs?')) {
                e.preventDefault();
            }
        });
    });
});