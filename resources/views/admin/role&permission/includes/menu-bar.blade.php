<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('roles.index')) active @endif" href="{{ route('roles.index') }}">Role
                Management</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('users.index')) active @endif"
                href="{{ route('users.index') }}">Users</a>
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
