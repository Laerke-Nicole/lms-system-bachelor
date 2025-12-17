@props(['filter'])

<div class="table-responsive">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col" class="text-label-1 text-body">Date</th>
            <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Course</th>
            @if(auth()->user()->role === 'user' || auth()->user()->role === 'leader')
                <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Trainer</th>
                @if($filter === 'all' || $filter === 'upcoming')
                    <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Place</th>
                @endif
            @endif
            @if(auth()->user()->role === 'admin')
                <th scope="col" class="text-label-1 text-body d-none d-md-table-cell">Ordered by</th>

                @if($filter === 'upcoming' || $filter === 'all')
                    <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Pre reminder</th>
                @endif

                @if(in_array($filter, ['completed', 'expired', 'all']))
                    <th scope="col" class="text-label-1 text-body d-none d-xl-table-cell">Reminder 18m</th>
                    <th scope="col" class="text-label-1 text-body d-none d-xl-table-cell">Reminder 22m</th>
                @endif
            @endif

            @if($filter === 'all')
                <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Status</th>
            @endif
            <th scope="col" class="text-label-1 text-body">Actions</th>

        </tr>
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>
</div>
