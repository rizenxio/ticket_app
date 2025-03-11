<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('events.index') }}"
                        
                            aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i
                                class="fa fa-fw fa-user-circle"></i>Event</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" aria-expanded="false"
                            data-target="#submenu-2" aria-controls="submenu-2"><i
                                class="fa fa-fw fa-rocket"></i>UI Elements</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
