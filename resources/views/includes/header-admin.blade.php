<header class="top-nav">
    <nav>
        <ul>
            <li {{Request::is('admin') ? 'class=active' : ''}}><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li {{Request::is('admin/blog/post*') ? 'class=active' : ''}}><a href="{{route('all.post')}}">Posts</a></li>
            <li {{Request::is('admin/blog/category*') || Request::is('admin/blog/categories*') ? 'class=active' : ''}}><a href="{{route('all.categories')}}"> Categories</a></li>
            <li {{Request::is('admin/contact/*') ? 'class=active' : ''}}><a href="{{route('get.contact.message')}}">Messages</a></li>

            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
</header>