<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav w-100 d-flex justify-content-between">
        <li class="nav-item">
            <a class="nav-link ml-3" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item">

            <form action="{{ route('logout') }}" method="post">
                <span class="p-2" >You are logged in as {{ auth()->user()->name }}</span>
                @csrf
                <input type="submit" value="Logout" class="btn btn-primary mr-3">
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
