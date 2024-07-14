<div>
    <input type="text" class="form-control" id="search" wire:model.live="search">
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
</div>
