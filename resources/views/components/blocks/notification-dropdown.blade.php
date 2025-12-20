<ul class="list-unstyled d-flex mb-0">
    <div class="position-relative">
{{--        little circle indicating if theres an unread notification--}}
        @if(auth()->user()->unreadNotifications()->exists())
            <div class="notification-alert"></div>
        @endif

        <x-blocks.dropdown dropdownTitle="" icon="bi bi-bell" class="fs-4 d-flex align-items-center dropdown">
            @forelse(auth()->user()->unreadNotifications as $notification)
                <li class="dropdown-item">
                    {{--                new training--}}
                    @include('components/elements/notifications/notification-new-training')

                    {{--                training updated--}}
                    @include('components/elements/notifications/notification-training-updated')

                    {{--                new certificate--}}
                    @include('components/elements/notifications/notification-new-certificate')

    {{--                reminder 18 months--}}
                    @include('components/elements/notifications/notification-new-reminder-18m')

    {{--                reminder before training--}}
                    @include('components/elements/notifications/notification-new-reminder-before')
                </li>
                <hr class="dropdown-divider">
            @empty
                <li class="dropdown-item">You have no notifications.</li>
            @endforelse

        </x-blocks.dropdown>
    </div>
</ul>
