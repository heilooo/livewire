<div class="container py-3">
    <div class="row  rounded border">
        <div class="col">
            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label class="form-label">Name: </label>
                    <input type="text" class="form-control" wire:model="name">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Price: </label>
                    <input type="text" class="form-control" wire:model="price">
                    @error('price')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Confirm identity</button>
            </form>
        </div>
    </div>

</div>