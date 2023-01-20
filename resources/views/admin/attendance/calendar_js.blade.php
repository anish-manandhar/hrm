<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            height: 650,
            initialDate: "{{ \Carbon\Carbon::now()->format('Y-m-d') }}",
            editable: true,
            selectable: true,
            businessHours: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [
                    @forelse($data as $date)
                {
                    title: 'Present - {{ $date['present_employee'] }} | Absent - {{ $date['absent_employee'] }}',
                    url: "{{ route('attendance.show', $date['date']) }}",
                    backgroundColor: '#2269f5',
                    start: '{{ $date['date'] }}'
                },
                @empty
                @endforelse
            ]
        });

        calendar.render();
    });

</script>
