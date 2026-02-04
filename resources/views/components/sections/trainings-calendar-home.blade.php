<div class="mb-5">
    <div id="admin-trainings-calendar" class="bg-white rounded-3 shadow-sm p-3"></div>

    <div class="mt-3 d-flex gap-4">
        <div class="d-flex align-items-center">
            <div style="width: 16px; height: 16px; background: #6c757d;" class="rounded me-2"></div>
            <span class="text-muted small">Pending</span>
        </div>
        <div class="d-flex align-items-center">
            <div style="width: 16px; height: 16px; background: #0d6efd;" class="rounded me-2"></div>
            <span class="text-muted small">Active</span>
        </div>
    </div>
</div>

@push('styles')
    <style>
        #admin-trainings-calendar {
            min-height: 500px;
        }
        #admin-trainings-calendar .fc-event {
            cursor: pointer;
            padding: 2px 4px;
        }
        #admin-trainings-calendar .fc-event-title {
            font-weight: 500;
        }
        #admin-trainings-calendar .fc-event-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 4px;
        }
        #admin-trainings-calendar .fc-event-company {
            font-size: 0.7em;
            opacity: 0.85;
            margin-left: 12px;
        }
        #admin-trainings-calendar .fc-toolbar-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        #admin-trainings-calendar .fc-button-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('admin-trainings-calendar');
            if (!calendarEl) return;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                firstDay: 1,
                height: 'auto',
                displayEventTime: false,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },

                events: "{{ route('calendar.trainings') }}",

                eventContent: function(arg) {
                    const company = arg.event.extendedProps.company;
                    const color = arg.event.backgroundColor;
                    return {
                        html: `<div class="fc-event-main-content">
                            <div class="fc-event-title"><span class="fc-event-dot" style="background:${color}"></span>${arg.event.title}</div>
                            ${company ? `<div class="fc-event-company">${company}</div>` : ''}
                        </div>`
                    };
                },

                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault();
                    }
                }
            });

            calendar.render();
        });
    </script>
@endpush
