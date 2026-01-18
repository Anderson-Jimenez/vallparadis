<!-- Sidebar desplegable -->
<aside id="sidebar" class="sidebar-gradient p-6 flex flex-col min-h-screen justify-between w-1/5 transition-all duration-300 ease-in-out">

  <!-- Botón Toggle -->
  <div class="flex justify-between mb-6 items-center p-2 border-b-2 border-white">
    <h1 class="text-white text-2xl sidebar-text font-bold">VallParadís</h1>
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
  <ul class="flex-1 flex flex-col items-start space-y-3 h-max-content">
    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="panell de control">
      <a href="{{route('dashboard')}}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-8 h-8 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#dashboard_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg group-hover:text-[#ff7300] font-semibold">
          Panell de Control
        </span>
      </a>
    </li>
    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de centres">
      <a href="{{ route('center.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-8 h-8 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#center_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Gestió Centre</span>
      </a>
    </li>

    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de professionals">
      <a href="{{ route('professional.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-8 h-8 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#professional_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Gestió Professionals</span>
      </a>
    </li>

    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de projectes i comisisions">
      <a href="{{ route('project_comission.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-10 h-10 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#project_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Gestió Projectes i comissions</span>
      </a>
    </li>

    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de cursos">
      <a href="{{ route('course.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-8 h-8 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#courses_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Gestió de Cursos</span>
      </a>
    </li>

    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de serveis generals">
      <a href="{{ route('general_service.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-10 h-10 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#services_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Gestió de Serveis Generals</span>
      </a>
    </li>
    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de serveis complementaris">
      <a href="{{ route('supplementary_service.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-12 h-12 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#services_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Gestió de Serveis Complementaris</span>
      </a>
    </li>
    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de contactes externs">
      <a href="{{ route('external_contacts.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-8 h-8 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#contacts_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Contactes Externs</span>
      </a>
    </li>
    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de documents interns">
      <a href="{{ route('documents_center.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-10 h-10 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#docs_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Documents</span>
      </a>
    </li>
    <li class="group rounded-lg transition-all duration-300 w-full hover:bg-white" title="gestió de manteniment">
      <a href="{{ route('maintenance.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg w-full transition-all duration-300">
        <svg class="w-10 h-10 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#maintenance_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-lg  group-hover:text-[#ff7300] font-semibold">Manteniment</span>
      </a>
    </li>
  </ul>
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
