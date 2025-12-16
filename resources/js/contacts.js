window.addEventListener('load', function() {
    const search_input = document.getElementById('search_input');
    const purpose_filter = document.getElementById('purpose_type');
    const type_filter = document.getElementById('purpose_type');
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
                    <div class="contact-info bg-white w-full px-5 mb-3 shadow flex justify-between items-center h-[10vh] rounded-xl">
                        <h3 class="w-3/12 text-sm">No hi ha cap contacte que coincideixi amb els resultats</h3>
                    </div>`;
            }

            //
            let html = "";
            for (let i in data.data) {
                html += `
                        <div class="contact-info bg-white w-full px-5 mb-3 shadow flex justify-between items-center h-[5vw] rounded-xl">
                            <div class="flex items-center w-1/6">
                                <svg class="w-10 h-10 txt-orange mr-3">
                                    <use xlink:href="#professional_icon"></use>
                                </svg>
                                <h2 class="font-bold text-sm ">${data.data[i].name}</h2>
                            </div>
                            <h3 class="w-3/12 text-sm"><strong>Organització: </strong>${data.data[i].organization ?? ''}</h3>
                            <h3 class="w-[30%] text-sm"><strong>Correu electrònic: </strong><a href="mailto:${data.data[i].email_address ?? ''}" class="underline">${data.data[i].email_address ?? ''} </a></h3>
                            <h3 class="w-1/6 text-sm"><strong>Telefòn: </strong>${data.data[i].phone_numer ?? ''}</h3>
                        </div>`;
            }
            search_results.innerHTML = html;
        });
    })
});