<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('adminDashboard.index') }}">
                <span class="logo-name">Avisos Mendoza</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('adminDashboard.index') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown {{ Route::current()->getName() == 'adminPush.writeNotify' ? 'active' : '' }}">
                <a href="{{ route('adminPush.writeNotify') }}" class="nav-link"><i
                        data-feather="message-circle"></i><span>Notificaciones</span></a>
            </li>
        </ul>
    </aside>
</div>
