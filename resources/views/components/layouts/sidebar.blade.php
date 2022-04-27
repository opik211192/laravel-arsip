<div>
    @can('create arsip')
    <div class="mb-5">
        <small class="d-block text-secondary mb-2 text-uppercase"><b>Arsip</b></small>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action ">
                Create Arsip
            </a>
            <a href="#" class="list-group-item list-group-item-action">Data Table Arsip</a>
        </div>
    </div>
    @endcan

    {{-- @can('create berita')
    <div class="mb-5">
        <small class="d-block text-secondary mb-2 text-uppercase"><b>Berita</b></small>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action ">
                Create Berita
            </a>
            <a href="#" class="list-group-item list-group-item-action">Data Table Berita</a>
        </div>
    </div>
    @endcan --}}

    @can('show users')
    <div class="mb-5">
        <small class="d-block text-secondary mb-2 text-uppercase"><b>Users</b></small>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action ">
                Create User
            </a>
            <a href="#" class="list-group-item list-group-item-action">Data Table User</a>
        </div>
    </div>
    @endcan

    @can('assign permission')
    <div class="mb-5">
        <small class="d-block text-secondary mb-2 text-uppercase"><b>Role & Permission</b></small>
        <div class="list-group">
            <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action ">Roles</a>
            <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action ">Permission</a>
            <a href="{{ route('assign.create') }}" class="list-group-item list-group-item-action">Assign Permission</a>
            <a href="{{ route('assign.user.create') }}" class="list-group-item list-group-item-action">Permission to Users</a>

        </div>
    </div>
    @endcan

    <div class="mb-5">
        <small class="d-block text-secondary mb-2 text-uppercase">Logout</small>
        <div class="list-group">
            <a class="list-group-item list-group-item-action" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>