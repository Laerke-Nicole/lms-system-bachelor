{{--    filtering btns with active and inactive state --}}
<div class="d-flex gap-2 mb-3">
    <button class="{{ $filter === 'all' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('all')">All</button>
    <button class="{{ $filter === 'pending' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('pending')">Pending</button>
    <button class="{{ $filter === 'upcoming' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('upcoming')">Upcoming</button>
    <button class="{{ $filter === 'completed' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('completed')">Completed</button>
    <button class="{{ $filter === 'expired' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('expired')">Expiring</button>
</div>
