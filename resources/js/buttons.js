document.addEventListener('DOMContentLoaded', () => {
  const professionals = document.querySelectorAll('.professional');

  professionals.forEach(elemento => {
    pro.addEventListener('click', () => {
      const id = elemento.id;
      console.log('Profesional seleccionado:', id);

      // Ocultar todas las secciones info
      document.querySelectorAll('[id^="info-"]').forEach(info => {
        info.classList.add('hidden');
      });

      // Mostrar solo la correspondiente
      const info = document.getElementById('info-' + id);
      if (info) {
        info.classList.remove('hidden');
      }
    });
  });
});