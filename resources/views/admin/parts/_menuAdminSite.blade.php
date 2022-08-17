<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('adminDashboard.index') }}">
                <span class="logo-name">Avisos Mendoza</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li>
                <a href="{{ route('adminDashboard.index') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="{{ route('adminService.list') }}" class="nav-link"><i
                        data-feather="archive"></i><span>Servicios</span></a>
            </li>
            <li>
                <a href="{{ route('adminNotification.listNotification') }}" class="nav-link"><i
                        data-feather="bookmark"></i><span>Notificationes</span></a>
            </li>
            <li>
                <a href="{{ route('AdminMessage.list') }}" class="nav-link"><i
                        data-feather="message-square"></i><span>Mensajes</span></a>
            </li>
        </ul>
    </aside>
</div>
