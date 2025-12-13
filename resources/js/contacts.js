window.addEventListener('load', function() {
    const search_input = document.getElementById('search_input');
    const purpose_filter = document.getElementById('purpose_type');
    const results_div = document.getElementById("search_results");

    
    search_input.addEventListener("keyup",(e)=>{
        fetch(`/search-contacts`,{
            method:'post',
            body:JSON.stringify({text : search_input.value}),
            headers:{
                "Content-Type":"application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token":document.head.querySelector("[name~=csrf-token][content]").content
            }
        })
        .then(response=>{
            return response.json()
        })
        .then(data => {

            // Si el camp NO és buit i no hi ha resultats → mostrar missatge
            if (search_input.value.trim() !== "" && data.data.length === 0) {
                search_results.innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-gray-500">No s'han trobat contactes.</p>
                    </div>
                `;
            }

            //
            let html = "";
            for (let i in data.data) {
                html += `
                    <div class="contact-info bg-white w-full p-4 mb-3 rounded shadow">
                        <div class="flex justify-between">
                            <p><strong>Nom:</strong> ${data.data[i].name}</p>
                            <p><strong>Motiu/Servei:</strong> ${data.data[i].purpose_type ?? ''}</p>
                            <p><strong>Origen:</strong> ${data.data[i].origin_type ?? ''}</p>
                            <p><strong>Organització:</strong> ${data.data[i].organization ?? ''}</p>
                        </div>
                    </div>
                `;
            }

            search_results.innerHTML = html;
        });
    })
});