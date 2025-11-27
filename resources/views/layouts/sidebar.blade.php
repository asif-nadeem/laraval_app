<nav id="sidebarMenu" class="d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (Route::has('admin.dashboard'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-home"></i>
                        Dashboard
                    </a>
                </li>
            @endif
            @if (Route::has('categories.index'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="fa fa-list"></i>
                        Categories
                    </a>
                </li>
            @endif
                @if (Route::has('posts.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('posts') ? 'active' : '' }}" href="{{ route('posts.index') }}">
                            <i class="fa fa-list"></i>
                            Posts
                        </a>
                    </li>
                @endif
            @if (Route::has('settings'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('settings') ? 'active' : '' }}" href="#">
                        <i class="fa fa-gear"></i>
                        Settings
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
