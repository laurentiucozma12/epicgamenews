<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header admin-sidebar-header">
        <div>
            <a class="admin-logo-container" href="{{ route('home') }}" target="_blank">
                <img class="logo-new-game-news" src="{{ asset('storage/logo/logo-epic-game-news-25x25.png') }}">                
                <h4 class="title-route">EGN</h4>
            </a>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.index') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Home</div>
            </a>            
        </li>

        <li>
            <a href="{{ route('admin.dashboard.index') }}">
                <div class="parent-icon"><i class='bx bx-line-chart'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>            
        </li>

        <hr>   
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-message-square-edit'></i></div>
                <div class="menu-title">Posts</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.posts.index') }}"><i class="bx bx-right-arrow-alt"></i>All Posts</a></li>
                <li> <a href="{{ route('admin.posts.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Posts</a></li>                          
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-game'></i></div>
                <div class="menu-title">Video Games</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.video_games.index') }}"><i class="bx bx-right-arrow-alt"></i>All Video Games</a></li>
                <li> <a href="{{ route('admin.video_games.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Video Games</a></li>                          
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i></div>
                <div class="menu-title">Categories</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.categories.index') }}"><i class="bx bx-right-arrow-alt"></i>All Categories</a></li>
                <li> <a href="{{ route('admin.categories.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Category</a></li>                          
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-mouse'></i></div>
                <div class="menu-title">Platforms</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.platforms.index') }}"><i class="bx bx-right-arrow-alt"></i>All Platforms</a></li>
                <li> <a href="{{ route('admin.platforms.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Platform</a></li>                          
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-movie'></i></div>
                <div class="menu-title">Others</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.others.index') }}"><i class="bx bx-right-arrow-alt"></i>All Others</a></li>
                <li> <a href="{{ route('admin.others.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Other</a></li>                          
            </ul>
        </li>

        <li>
            <a href="{{ route('admin.tags.index') }}">
                <div class="parent-icon"><i class="bx bx-purchase-tag"></i></div>
                <div class="menu-title">Tags</div>
            </a>
        </li>
        
        <hr>
        <li>
            <a href="{{ route('admin.about.edit') }}"> 
                <div class="parent-icon"><i class='bx bx-info-square'></i></div>
                <div class="menu-title">About</div>
            </a>
        </li>

        <hr>        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-key'></i></div>
                <div class="menu-title">Roles</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.roles.index') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a></li>
                <li> <a href="{{ route('admin.roles.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Role</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user'></i></div>
                <div class="menu-title">Users</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.users.index') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a></li>
                <li> <a href="{{ route('admin.users.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New User</a></li>
            </ul>
        </li>

        <hr>        
        <li>
            <a href="{{ route('admin.terminal.index') }}">
                <div class="parent-icon"><i class='bx bx-terminal'></i></div>
                <div class="menu-title">Terminal</div>
            </a>
        </li>

        @if ( auth()->user()->roles->isNotEmpty() 
        && auth()->user()->roles->contains('name', 'admin') 
        && !auth()->user()->roles->contains('name', 'user'))
            <hr>
            <li>
                <a href="{{ route('admin.contacts') }}">
                    <div class="parent-icon"><i class='bx bx-mail-send'></i></div>
                    <div class="menu-title">Contacts</div>
                </a>
            </li>
        @endif
        
        <hr>
        <li>
            <a href="{{ route('home') }}" target="_blank">
                <div class="parent-icon"><i class='bx bx-pointer'></i></div>
                <div class="menu-title">Visit Site</div>
            </a>
        </li>

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->