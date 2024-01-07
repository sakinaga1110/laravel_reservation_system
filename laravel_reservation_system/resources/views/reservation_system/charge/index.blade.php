<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header text-center h5">
                料金設定
            </div>
            <div class="card-body">
                <div class="text-center d-flex justify-content-center">
                    <div class="container pt-5">
                        <div style="width: 50%;margin: auto">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events/charge',
                eventClick: function(info) {
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
