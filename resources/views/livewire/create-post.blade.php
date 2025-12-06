<section>
    <form wire:submit.prevent="handelSubmit">
        <div class="mb-3">
            <label class="form-label">Title: </label>
            <input type="text" class="form-control" wire:model.live="title">
        </div>
        <div class="mb-3">
            <label class="form-label">Description: </label>
            <input type="text" class="form-control" wire:model="description">
        </div>
        <button type="submit" class="btn btn-primary">Confirm identity</button>
        <input type="text" wire:keydown.shift.enter="doSumeThing($event.target.value)" />
    </form>
</section>