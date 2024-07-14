<div>
    @if ($isHome)
        <div class="section-header">
            <h1>User Management</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">User List</h2>
            <p class="section-lead">In this section you can manage system user data such as adding, changing and deleting.</p>
            <div class="card">
                <div class="card-body">
                    <button wire:click.prevent="newuser()" class="btn btn-primary">Create</button>
                    <br>
                    <br>
                    @livewire('user-table')
                </div>
            </div>
        </div>
    @endif

    @if($isCreate)
    <div class="section-header">
        <h1>Create User</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Create User</h2>
        <p class="section-lead">In this section you can create new user to access the system.</p>
        <div class="card">
            <div class="card-body">
                @livewire('user-form')
            </div>
        </div>
    </div>
    @endif
</div>
