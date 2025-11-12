document.addEventListener('DOMContentLoaded', () => {
  
  const professionals = document.querySelectorAll('.professional');
  const info_div = document.getElementById('professional-info');
  const prof_info_container = document.getElementById('prof-info-container');
  let uniform = document.getElementById('give-uniform');
  let professionals_div = document.querySelectorAll('.professional-info');
  let activo = false;
  

  let principal_content = document.getElementById('principal-content');

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
        info_div.classList.remove('hidden', 'translate-y-5');
        info_div.classList.add('flex', 'translate-y-0');

        const info_name = document.getElementById('info-name');
        const info_email = document.getElementById('info-email');
        const info_phone = document.getElementById('info-phone');
        const info_status = document.getElementById('info-status');

        info_name.textContent = name + ' ' + surnames;
        info_email.textContent = 'Correu electrònic: ' + email;
        info_phone.textContent = 'Número de telefon: ' + phone;
        info_status.textContent = 'Estat Actual: ' + status;

        uniform.href = "/professional/"+ professional_id+"/send_uniform";

        prof_info_container.classList.remove('items-center');
        prof_info_container.classList.add('items-left');
        professionals_div.forEach(div => {
          div.classList.remove('w-full');
          div.classList.add('w-4/6');
        });     
      }
      else{
        prof_info_container.classList.remove('items-left');
        prof_info_container.classList.add('items-center');
        professionals_div.forEach(div => {
          div.classList.remove('w-3/6');
          div.classList.add('w-full');
        });
        info_div.classList.add('hidden', 'translate-y-5');
        info_div.classList.remove('flex', 'translate-y-0');

      }
      activo = !activo;
    });
  });

});