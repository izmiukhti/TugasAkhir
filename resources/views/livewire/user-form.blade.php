<div>
    <form action="#">
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
        <button class="btn btn-info">Back</button>
        <button class="submit btn btn-success">Save</button>
    </form>
</div>
