<div class="container py-3">

    <!-- Button trigger modal -->
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create
        </button>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
    </div>

    <div class="col-6 mb-3">
        <label>search:</label>
        <input type="text" class="form-control" wire:model.live="search">
        {{-- <bottun class="btn btn-info" wire:click="resetData">Reset</bottun> --}}
        {{-- <bottun class="btn btn-info" wire:click="$refresh">Refresh</bottun> --}}
        {{-- <bottun class="btn btn-info" wire:click="$set('search','')">Reset</bottun> --}}

    </div>

    <table class="table table-bordered table-striped">
        <tr>
            <th wire:click="$toggle('sortId')">id</th>
            <th class="cruse-pointer" wire:click="$toggle('sortName')">name</th>
            <th wire:click="$toggle('sortPrice')">price</th>
            <th>setting</th>
        </tr>


        @foreach ($courses as $key => $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->price }}</td>
                <td>
                    <select class="form-control" wire:change="changeStatus($event.target.value, $event.target.dataset.id)"
                        data-id="{{ $course->id }}">
                        <option value="1" {{$course->status ? 'selected' : ''}}>enable</option>
                        <option value="0" {{$course->status ? '' : 'selected'}}>disable</option>
                    </select>
                </td>
                <td>
                    <button wire:click="delete({{ $course }})" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary" wire:click="show({{ $course->id }})">Show</button>
                </td>
            </tr>
        @endforeach
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="showModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @if($singleCourse != null)
                        <div class="modal-body">
                            {{ $singleCourse->id }}<br>
                            {{ $singleCourse->name }}<br>
                            {{ $singleCourse->price }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </table>
</div>