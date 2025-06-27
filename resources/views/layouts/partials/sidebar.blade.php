{{-- <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">John Doe</p>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="dashboard.html"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">UI Elements</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon bi bi-circle-fill"></i> Bootstrap Elements</a></li>
            <li><a class="treeview-item" href="https://icons.getbootstrap.com/" target="_blank" rel="noopener"><i class="icon bi bi-circle-fill"></i> Font Icons</a></li>
            <li><a class="treeview-item" href="ui-cards.html"><i class="icon bi bi-circle-fill"></i> Cards</a></li>
            <li><a class="treeview-item" href="widgets.html"><i class="icon bi bi-circle-fill"></i> Widgets</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="form-components.html"><i class="icon bi bi-circle-fill"></i> Form Components</a></li>
            <li><a class="treeview-item" href="form-samples.html"><i class="icon bi bi-circle-fill"></i> Form Samples</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Tables</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="table-basic.html"><i class="icon bi bi-circle-fill"></i> Basic Tables</a></li>
            <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Data Tables</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-file-earmark"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="blank-page.html"><i class="icon bi bi-circle-fill"></i> Blank Page</a></li>
            <li><a class="treeview-item" href="page-login.html"><i class="icon bi bi-circle-fill"></i> Login Page</a></li>
            <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon bi bi-circle-fill"></i> Lockscreen Page</a></li>
            <li><a class="treeview-item" href="page-user.html"><i class="icon bi bi-circle-fill"></i> User Page</a></li>
            <li><a class="treeview-item" href="page-invoice.html"><i class="icon bi bi-circle-fill"></i> Invoice Page</a></li>
            <li><a class="treeview-item" href="page-mailbox.html"><i class="icon bi bi-circle-fill"></i> Mailbox</a></li>
            <li><a class="treeview-item" href="page-error.html"><i class="icon bi bi-circle-fill"></i> Error Page</a></li>
          </ul>
        </li>
        <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon bi bi-code-square"></i><span class="app-menu__label">Docs</span></a></li>
      </ul>
    </aside> --}}
<div class="relative">
    <!-- Sidebar -->
    <aside
        :class="sidebarOpen ? 'w-64' : 'w-16'"
        class="h-screen bg-white dark:bg-gray-800 shadow-md fixed top-0 left-0 z-40 flex flex-col transition-all duration-300"
        x-data="{ viewCitizensOpen: false }"
    >
        <div class="flex items-center justify-center h-20 border-b">
            <x-application-logo class="mx-auto" />
        </div>
        <nav class="flex-1 px-2 py-6 space-y-2">
            <!-- Register Citizen -->
            <a href="{{ route('citizen.create') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">
                <i class="bi bi-person-plus mr-2"></i>
                <span x-show="sidebarOpen" class="whitespace-nowrap">Register Citizen</span>
            </a>
            <!-- View Citizens with submenu -->
            <button @click="viewCitizensOpen = !viewCitizensOpen"
                class="flex items-center w-full px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 focus:outline-none">
                <i class="bi bi-people mr-2"></i>
                <span x-show="sidebarOpen" class="whitespace-nowrap">View Citizens</span>
                <svg x-show="sidebarOpen" :class="viewCitizensOpen ? 'rotate-90' : ''" class="ml-auto h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="viewCitizensOpen && sidebarOpen" class="pl-10 space-y-1">
                <a href="{{ route('citizen.searchForm') }}" class="block px-2 py-1 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm">
                    By Search Criteria
                </a>
                <a href="{{ route('citizen.all') }}" class="block px-2 py-1 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm">
                    All Citizens
                </a>
            </div>
            <!-- Dashboard Home -->
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">
                <i class="bi bi-house mr-2"></i>
                <span x-show="sidebarOpen" class="whitespace-nowrap">Dashboard Home</span>
            </a>
        </nav>
    </aside>

    <!-- Hamburger Toggle Button -->
    <button
        @click="sidebarOpen = !sidebarOpen"
        class="fixed top-6 z-50 transition-all duration-300 bg-white dark:bg-gray-800 border rounded-full shadow p-2 focus:outline-none"
        :style="sidebarOpen ? 'left: 256px;' : 'left: 64px;'"
        x-data
    >
        <!-- Hamburger Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            class="w-6 h-6 text-gray-700 dark:text-gray-200">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>