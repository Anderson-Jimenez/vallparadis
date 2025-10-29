document.addEventListener('DOMContentLoaded', () => {
  
  
  const professionals = document.querySelectorAll('.professional');
  const info_div = document.getElementById('professional-info');
  let uniform = document.getElementById('give-uniform');
  let professionals_div = document.querySelectorAll('.professional-info');
  let activo = false;



  professionals.forEach(professional => {
    
    professional.addEventListener('click', () => {
      // Tomamos los datos del div clicado
      
      const input = professional.querySelectorAll('input');
      let professional_id = input[0].value;
      let name = input[1].value;
      let surnames = input[2].value;
      let phone = input[3].value;
      let email = input[4].value;
      let address = input[5].value;
      let status = input[6].value;
      

      if(!activo){
        // para eliminar la classe hidden del div y que sea visible
        info_div.classList.remove('hidden');

        const info_name = document.getElementById('info-name');
        const info_email = document.getElementById('info-email');
        const info_phone = document.getElementById('info-phone');
        const info_status = document.getElementById('info-status');

        info_name.textContent = name + ' ' + surnames;
        info_email.textContent = 'Correu electrònic: ' + email;
        info_phone.textContent = 'Número de telefon: ' + phone;
        info_status.textContent = 'Estat Actual: ' + status;
        uniform.href = "/professional/"+ professional_id+"/send_uniform";
        professionals_div.forEach(div => {
          div.classList.remove('w-4/5');
          div.classList.add('w-3/6');
        });
      
      }
      else{
        professionals_div.forEach(div => {
          div.classList.remove('w-3/6');
          div.classList.add('w-4/5');
        });
        info_div.classList.add('hidden');
      }
      activo = !activo;
    });
  });

});



/*          canviar fons al boto de activacio            
let activate_desactivate_btn = document.getElementById('activate_desactivate_btn');

activate_desactivate_btn.addEventListener('click',toggleClass);


function toggleClass(objecte){
    if (objecte.classList.contains('active')){
        objecte.classList.remove('active');
        objecte.classList.add('innactive bg-[#fffff] rounded-3xl p-5 border border-[#FF7400]');
    }
    else{  
        objecte.classList.remove('innactive');
        objecte.classList.add('active bg-[#fffff] rounded-3xl p-5 border border-[#FF7400]');
    }
}

*/
