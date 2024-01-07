@extends('layouts.user_app')
@section('title')
    HOTEL　LARAVEL　空室状況
@endsection
@section('content')
    <div class="container-fluid bg-info bg-opacity-25 text-center">
        <br />
        <div class="container px-5">
            <h4>空室　一覧</h4>
            
                <div class="card">
                   
                    <div class="card-header" name="plan_name">{{ $plan->title }}</div>
                    <div class="card-body" name="plan_content">{{ $plan->detail }}
                        <div style="width: 50%;margin: auto">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
                <br />
           
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{route('events.room_calender',['plan'=>$plan])}}',
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
@endsection