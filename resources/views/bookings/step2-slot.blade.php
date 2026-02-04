@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('bookings.slot') }}

    <h3 class="mb-4">When do you want to book for?</h3>

    <x-blocks.message />

    <div class="row booking-section">
        <div class="col-12 col-lg-8 booking-section-small">
            <div id="booking-calendar" class="bg-white rounded-3 shadow-sm p-3"></div>

            <form id="dayForm" method="POST" action="{{ route('trainings.bookings.slot.store') }}" class="d-none">
                @csrf
                <input type="hidden" name="training_day" id="training_day">
            </form>
        </div>

        @if($course->requirements->isNotEmpty())
            <div class="col-12 col-lg-4">
                <div class="booking-sidebar booking-requirements">
                    <h3>Requirements and rules</h3>
                    @foreach($course->requirements as $requirement)
                        @if($requirement->title)
                            <h4 class="booking-requirements__title">{{ $requirement->title }}</h4>
                        @endif
                        @if($requirement->content)
                            <p class="booking-requirements__content">{{ $requirement->content }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        /* Taken days - red background, disabled cursor */
        .fc .day-taken {
            background: #dc3545 !important;
            opacity: .25;
        }
        .fc .fc-daygrid-day.fc-day-taken .fc-daygrid-day-frame {
            cursor: not-allowed;
        }

        /* Past days - grey out, disabled cursor */
        .fc .fc-day-past .fc-daygrid-day-frame {
            background: #f5f5f5;
            cursor: not-allowed;
        }

        /* Available days - pointer cursor, grey hover */
        .fc .fc-daygrid-day:not(.fc-day-past):not(.fc-day-taken) .fc-daygrid-day-frame {
            cursor: pointer;
            transition: background-color 0.15s ease;
        }
        .fc .fc-daygrid-day:not(.fc-day-past):not(.fc-day-taken):hover .fc-daygrid-day-frame {
            background-color: rgba(108, 117, 125, 0.15);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.getElementById('booking-calendar');
            const form = document.getElementById('dayForm');
            const input = document.getElementById('training_day');

            const calendar = new FullCalendar.Calendar(el, {
                initialView: 'dayGridMonth',
                firstDay: 1,
                height: 'auto',
                validRange: { start: new Date().toISOString().slice(0,10) },

                events: "{{ route('trainings.bookings.slot.availability') }}",

                // Mark day cells as taken when background events render
                eventDidMount: function(info) {
                    if (info.event.display === 'background' && info.event.classNames.includes('day-taken')) {
                        const dateStr = info.event.startStr.slice(0, 10);
                        const dayCell = el.querySelector(`[data-date="${dateStr}"]`);
                        if (dayCell) {
                            dayCell.classList.add('fc-day-taken');
                        }
                    }
                },

                dateClick: function(info) {
                    const day = info.dateStr;

                    // block taken days
                    if (info.dayEl.classList.contains('fc-day-taken')) return;

                    input.value = day;
                    form.submit();
                }
            });

            calendar.render();
        });
    </script>
@endpush

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="2" />
@endpush
