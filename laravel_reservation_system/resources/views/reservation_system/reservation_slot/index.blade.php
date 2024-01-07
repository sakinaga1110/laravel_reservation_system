<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <div class="text-center h5">予約枠一覧</div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('reservation_slot.create') }}">新規登録</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div style="width: 50%;margin: auto">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/events',
            eventClick: function (info) {
            // イベントをクリックしたときの処理を記述
            // info.event.url にリンク先のURLが格納されていることを前提としています
            if (info.event.url) {
                window.location.href = info.event.url; // リンクに遷移
            }
        },
        });
        calendar.render();
    });
</script>
</x-app-layout>
