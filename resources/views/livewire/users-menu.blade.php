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
                    <div class="row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="search" placeholder="Search User" wire:model.live.debounce.250ms="search">
                        </div>
                        <div class="col-4 text-right">
                            <button wire:click.prevent="newuser()" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                    <br>
                    @if (session()->has('success'))
                        <br>
                        <div class="alert alert-success alert-dismissible show fade">
                            Dor
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <br>
                    @endif
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <div class="buttons">
                                        <a href="#" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                                        <a href="#" class="btn btn-icon btn-warning"><i class="fas fa-exclamation-triangle"></i></a>
                                        <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>                    
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
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
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" wire:model="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" wire:model="email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button wire:click.prevent="back()" class="btn btn-info">Back</button>
                <button wire:click.prevent="save()" class="submit btn btn-success">Save</button>
            </div>
        </div>
    </div>
    @endif
</div>
