<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('admin_dashboard_assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">New Gaming News</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('index') }}">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

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
                <div class="parent-icon"><i class='bx bx-menu'></i></div>
                <div class="menu-title">Categories</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.categories.index') }}"><i class="bx bx-right-arrow-alt"></i>All Categories</a></li>
                <li> <a href="{{ route('admin.categories.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Category</a></li>                          
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-menu'></i></div>
                <div class="menu-title">Platforms</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.platforms.index') }}"><i class="bx bx-right-arrow-alt"></i>All Platforms</a></li>
                <li> <a href="{{ route('admin.platforms.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Platform</a></li>                          
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-menu'></i></div>
                <div class="menu-title">Others</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.others.index') }}"><i class="bx bx-right-arrow-alt"></i>All others</a></li>
                <li> <a href="{{ route('admin.others.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Other</a></li>                          
            </ul>
        </li>

        <li>
            <a href="{{ route('admin.tags.index') }}">
                <div class="parent-icon"><i class="bx bx-purchase-tag"></i></div>
                <div class="menu-title">Tags</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-comment-dots'></i></div>
                <div class="menu-title">Comments</div>
            </a>

            <ul>
                <li> <a href="{{ route('admin.comments.index') }}"><i class="bx bx-right-arrow-alt"></i>All Comments</a></li>
                <li> <a href="{{ route('admin.comments.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Comment</a></li>
            </ul>
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

        <hr>        
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
            <a href="{{ route('admin.contacts') }}">
                <div class="parent-icon"><i class='bx bx-mail-send'></i></div>
                <div class="menu-title">Contacts</div>
            </a>
        </li>

        <hr>
        <li>
            <a href="{{ route('admin.setting.edit') }}">
                <div class="parent-icon"><i class='bx bx-info-square'></i></div>
                <div class="menu-title">Setting</div>
            </a>
        </li>

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