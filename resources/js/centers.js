document.querySelectorAll('.center-item').forEach(item => {
    item.addEventListener('click', () => {
        //per treure la selecció del centre anteriorment clicat
        document.querySelectorAll('.center-item').forEach(i => {
            i.classList.remove('bg-orange-100', 'border-orange-600');
        });
        //es resalta el centre seleccionat
        item.classList.add('bg-orange-100', 'border-orange-600');
        
        const detail_section = document.getElementById('center-detail');
        detail_section.classList.remove('hidden');
        // Afegir el token CSRF per a les peticions POST ja que no es pot posar el @csrf a un formulari generat per JS
        const csrf_token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        // Ocultar el missatge de "No center selected"
        document.getElementById('no-center-selected').classList.add('hidden');
        
        let detail_content = document.getElementById('detail-content');
        
        if (!detail_content) {
            detail_content = document.createElement('div');
            detail_content.id = 'detail-content';
            document.getElementById('center-detail').appendChild(detail_content);
        }
        
        detail_content.innerHTML = `
            <div class="flex w-full justify-around">
                <div class="p-6 my-10 bg-white shadow-md rounded-xl w-11/12 flex flex-col gap-3 border border-gray-300">
                    <div class="flex items-center justify-between p-3">
                        <div class="flex items-center">
                            <svg class="w-20 h-20 mr-5 sidebar-gradient text-white rounded-lg p-3">
                                <use xlink:href="#building_icon"></use>
                            </svg>
                            <h2 class="text-4xl font-bold text-black">Centre de ${item.dataset.location}</h2>
                        </div>
                        <div class="flex items-center gap-5">
                            ${item.dataset.status === 'active' ? `
                                <form action="/center/${item.dataset.id}/activate" method="GET">
                                    <input type="hidden" name="_token" value="${csrf_token}">
                                    <button class="bg-[#DCFCE7] text-[#16A34A] rounded-lg p-2 shadow-md hover:bg-[#BBF7D0] transition cursor-pointer flex items-center">
                                        <svg class="w-7 h-7 text-[#16A34A] inline-block mr-2">
                                            <use xlink:href="#check_icon"></use>
                                        </svg>
                                        Actiu
                                    </button>
                                </form>
                            ` : `
                                <form action="/center/${item.dataset.id}/activate" method="GET">
                                    <input type="hidden" name="_token" value="${csrf_token}">
                                    <button class="bg-[#FEE2E2] text-[#DC2626] rounded-2xl px-5 py-3 shadow-md hover:bg-[#FECACA] transition cursor-pointer flex items-center">
                                        <svg class="w-7 h-7 text-[#DC2626] inline-block mr-2">
                                            <use xlink:href="#x_icon"></use>
                                        </svg>
                                        Inactiu
                                    </button>
                                </form>
                            `}
                            <a href="/center/${item.dataset.id}/edit" class="flex items-center rounded-lg px-7 py-3 text-white sidebar-gradient hover:opacity-80 transition-all duration-300">
                                <svg class="w-5 h-5 inline-block mr-2">
                                    <use xlink:href="#edit_icon"></use>
                                </svg>
                                Editar
                            </a> 
                        </div>
                    </div>
                    <div class="flex items-center gap-6 p-3">
                        <div class="flex flex-col gap-6 w-1/2">
                            <h2 class="font-semibold text-gray-700 border-b-2 border-gray-200 text-2xl pb-3">Informació Bàsica</h2>
                            <div class="flex items-center">
                                <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                    <use xlink:href="#center_icon"></use>
                                </svg>
                                <div>
                                    <h2 class="font-semibold text-gray-700">Nom del centre</h2>
                                    <h3 class="text-xl font-semibold">${item.dataset.name}</h3>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                    <use xlink:href="#location_icon"></use>
                                </svg>
                                <div>
                                    <h2 class="font-semibold text-gray-700">Ubicació</h2>
                                    <h3 class="text-xl font-semibold">${item.dataset.location}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 w-1/2">
                            <h2 class="font-semibold text-gray-800 border-b-2 border-gray-200 text-2xl pb-3">Informació de Contacte</h2>
                            <div class="flex items-center">
                                <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                    <use xlink:href="#phone_icon"></use>
                                </svg>
                                <div>
                                    <h2 class="font-semibold text-gray-700">Telèfon de Contacte</h2>
                                    <h3 class="text-xl font-semibold">+34 ${item.dataset.phone}</h3>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                    <use xlink:href="#location_icon"></use>
                                </svg>
                                <div>
                                    <h2 class="font-semibold text-gray-700">Adreça Electrònica</h2>
                                    <h3 class="text-xl font-semibold">${item.dataset.email}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Mostrar el contenido
        detail_content.classList.remove('hidden');
    });
});