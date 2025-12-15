@props(['filter'])

<table class="table">
    <thead>
    <tr>
        <th scope="col" class="text-label-1 text-body">Date</th>
        <th scope="col" class="text-label-1 text-body">Course</th>
        @if(auth()->user()->role === 'user' || auth()->user()->role === 'leader')
            <th scope="col" class="text-label-1 text-body">Trainer</th>
            @if($filter === 'all' || $filter === 'upcoming')
                <th scope="col" class="text-label-1 text-body">Place</th>
            @endif
        @endif
        @if(auth()->user()->role === 'admin')
            <th scope="col" class="text-label-1 text-body">Ordered by</th>

            @if($filter === 'upcoming' || $filter === 'all')
                <th scope="col" class="text-label-1 text-body">Pre reminder</th>
            @endif

            @if(in_array($filter, ['completed', 'expired', 'all']))
                <th scope="col" class="text-label-1 text-body">Reminder 18m</th>
                <th scope="col" class="text-label-1 text-body">Reminder 22m</th>
            @endif
        @endif

        @if($filter === 'all')
            <th scope="col" class="text-label-1 text-body">Status</th>
        @endif
        <th scope="col" class="text-label-1 text-body">Actions</th>

    </tr>
    </thead>
    <tbody>
    {{ $slot }}
    </tbody>
</table>
