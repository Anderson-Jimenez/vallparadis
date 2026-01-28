<aside id="sidebar" class="sidebar-gradient flex flex-col h-min-screen w-75 p-5 transition-all duration-300 ease-in-out">
  
  <div class="flex items-center justify-between mb-4 p-2 border-b border-white/30">
    <h1 class="sidebar-text text-white text-2xl font-bold truncate">
      VallParadís
    </h1>
    <button id="sidebar-toggle" class="p-2 rounded-md hover:bg-[#ff7300] transition text-white" aria-label="Colapsar menú">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>
  </div>
  <ul class="flex-1 flex flex-col space-y-2 overflow-y-auto pr-2">
    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('dashboard') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#dashboard_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Panell de Control
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('center.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#center_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Gestió Centre
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('professional.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#professional_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Gestió Professionals
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('project_comission.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#project_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Gestió Projectes i Comissions
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('course.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#courses_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Gestió de Cursos
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('general_service.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#services_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Serveis Generals
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('supplementary_service.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#services_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Serveis Complementaris
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('external_contacts.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#contacts_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Contactes Externs
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('documents_center.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#docs_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Documents
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('maintenance.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#maintenance_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Manteniment
        </span>
      </a>
    </li>

    <li class="group w-full rounded-lg hover:bg-white transition">
      <a href="{{ route('hr_pending_issue.index') }}"
         class="flex items-center gap-3 p-3 w-full">
        <svg class="w-6 h-6 text-white group-hover:text-[#ff7300]">
          <use xlink:href="#rrhh_icon"></use>
        </svg>
        <span class="sidebar-text text-white text-sm font-semibold group-hover:text-[#ff7300]">
          Temes Pendents
        </span>
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
