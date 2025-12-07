<div class="container py-3">

    <!-- Button trigger modal -->
    <div class="d-flex justify-content-end">
        <button wire:click="resetAll()" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Create
        </button>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        {{ $singleCourse ? 'Edit Post' : "Create Post" }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitForm">
                        <div class="mb-3">
                            <label class="form-label">Name: </label>
                            <input type="text" class="form-control" wire:model.change="name"
                                value="{{ $singleCourse ? $singleCourse->name : '' }}">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price: </label>
                            <input type="text" class="form-control" wire:model.change="price"
                                value="{{ $singleCourse ? $singleCourse->price : '' }}">
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
                    <button wire:click="delete({{ $course->id }})" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary" wire:click="show({{ $course->id }})">Show</button>
                    <button wire:click="edit({{ $course->id }})" class="btn btn-warning">Edit</button>
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


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>



</div>
