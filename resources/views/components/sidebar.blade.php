<!-- Sidebar desplegable -->
<aside id="sidebar"
  class="bg-[#2D3E50] p-6 h-[45vw] flex flex-col justify-between w-1/5 transition-all duration-300 ease-in-out">

  <!-- Botón Toggle -->
  <div class="flex justify-between mb-6 items-center p-2 border-b-2 border-white">
    <h1 class="text-white text-2xl sidebar-text">VallParadís</h1>
    <button id="sidebar-toggle"
      class="p-2 rounded-md hover:bg-[#ff7300] transition text-white"
      aria-label="Colapsar menú">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>
  </div>

  <!-- Lista de enlaces -->
  <ul class="flex-1 flex flex-col items-start space-y-3">
    <li class="group rounded-lg transition-all duration-300 w-full" title="panell de control">
      <a href="{{route('principal')}}"
        class="flex items-center gap-3 p-3 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 w-full">
        <svg class="w-8 h-8 text-white">
          <use xlink:href="#dashboard_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg">Panell de Control</span>
      </a>
    </li>
    
    <li class="group rounded-lg transition-all duration-300 w-full" title="gestió de centres">
      <a href="{{ route('center.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 w-full">
        <svg class="w-8 h-8 text-white">
          <use xlink:href="#center_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg">Gestió Centre</span>
      </a>
    </li>

    <li class="group rounded-lg transition-all duration-300 w-full" title="gestió de professionals">
      <a href="{{ route('professional.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 w-full">
        <svg class="w-8 h-8 text-white">
          <use xlink:href="#professional_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg">Gestió Professionals</span>
      </a>
    </li>

    <li class="group rounded-lg transition-all duration-300 w-full" title="gestió de projectes i comisisions">
      <a href="{{ route('project_comission.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 w-full">
        <svg class="w-10 h-10 text-white">
          <use xlink:href="#project_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg">Gestió Projectes i comissions</span>
      </a>
    </li>

    <li class="group rounded-lg transition-all duration-300 w-full" title="gestió de cursos">
      <a href="{{ route('course.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 w-full">
        <svg class="w-10 h-10 text-white">
          <use xlink:href="#courses_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg">Gestió de Cursos</span>
      </a>
    </li>
  </ul>

  <!-- Botón de logout -->
  <a href="{{ route('logout') }}"
    class="sidebar-logout flex justify-center items-center w-[15vw] h-[3vw] bg-white text-[#ff7300] px-3 py-1 rounded-full text-lg font-semibold transition-all duration-300 hover:bg-[#ff7300] hover:text-white mx-auto">
    Tancar sessió
  </a>
</aside>

<!-- JS -->
<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('sidebar-toggle');
  const textElements = document.querySelectorAll('.sidebar-text');
  const logoutButton = document.querySelector('.sidebar-logout');

  let isCollapsed = false;

  toggleBtn.addEventListener('click', () => {
    isCollapsed = !isCollapsed;

    if (isCollapsed) {
      // reducir ancho y ocultar textos
      sidebar.classList.remove('w-1/5');
      sidebar.classList.add('w-[5vw]', 'items-center');
      textElements.forEach(el => 
        el.classList.add('hidden')
      );
      logoutButton.classList.add('hidden');
    } else {
      // restaurar tamaño original
      sidebar.classList.remove('w-[5vw]', 'items-center');
      sidebar.classList.add('w-1/5');
      textElements.forEach(el => 
        el.classList.remove('hidden')
      );
      logoutButton.classList.remove('hidden');
    }
  });
</script>
