<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item ">
            <a class="nav-link @if (request()->routeIs('role.management')) active @endif" aria-current="page"
                href="{{ route('role.management') }}">Role Management</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('permissions.index')) active @endif"
                href="{{ route('permissions.index') }}">Permissions</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>

</div>
