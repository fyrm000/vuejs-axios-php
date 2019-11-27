<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top mb-5">
    <!-- Brand -->
    <a class="navbar-brand" href="/cmm">CMM</a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Menu 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menu 2</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                SubMenus
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Sub 1</a>
                <a class="dropdown-item" href="#">Sub 2</a>
                <a class="dropdown-item" href="#">Sub 3</a>
            </div>
        </li>
        <li>
            <button type="button" class="btn btn-primary mt-1" @click="openModal('create')">
                <i class='fas fa-plus'></i>
                Crear Tarjeta
            </button>
        </li>
    </ul>
</nav>
<br>