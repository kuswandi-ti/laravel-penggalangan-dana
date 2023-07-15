<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="ml-auto navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('frontend.home.index') }}" target="_blank" role="button">
                <i class="fas fa-globe"></i> View Website
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="document.querySelector('#form-logout').submit()" role="button">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form action="{{ route('logout') }}" method="post" id="form-logout">
                @csrf
            </form>
        </li>
    </ul>
</nav>
