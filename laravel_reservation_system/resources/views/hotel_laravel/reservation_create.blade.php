@extends('layouts.user_app')
@section('title')
    HOTEL　LARAVEL　予約作成
@endsection
@section('content')
    <div class="container-fluid bg-info bg-opacity-25 text-center">
        <br />
        <div class="container px-5">
            <h4>ご宿泊 予約作成</h4>
            <div class="card">
                <div class="card-header" name="plan_name">{{ $plan->title }}</div>
                <div class="card-body" name="plan_content">{{ $plan->detail }}
                    <div style="width: 50%;margin: auto">
                        <div id='calendar'></div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <form method="POST" action="{{ route('hotel_laravel.reservation_complete') }}" id="form">
                            @csrf
                            @method('POST')
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <label>{{ $reservation_slot->date }}日から、<input type="number" name="lodging_days"
                                    value="{{ old('lodging_days') }}" min="1" max="" required>泊</label>
                            <input type="hidden" name="room_id" value="{{ $reservation_slot->room_id }}">
                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                            <input type="hidden" name="date" value="{{ $reservation_slot->date }}">

                            <br><br>
                            {{-- 合計金額の表示領域 --}}
                            <label>
                                <div id="result"></div>
                            </label>
                            <br><br>

                            <label>姓(かな入力)</label><input type="text" name="kana_last_name"
                                value="{{ old('kana_last_name') }}" required>
                            <br><br>
                            <label>名(かな入力)</label><input type="text" name="kana_first_name"
                                value="{{ old('kana_first_name') }}" required>
                            <br><br>
                            <label>電話番号</label><input type="tel" name="phone_num" value="{{ old('phone_num') }}"
                                required>
                            <br><br>
                            <label>メールアドレス</label><input type="email" name="email" value="{{ old('email') }}"
                                required>
                            <br><br>
                            <label>郵便番号</label><input type="text" name="post_code" value="{{ old('post_code') }}">
                            <br><br>
                            <label>都道府県</label>
                            <select name="prefecture" required>
                                <option value="">都道府県</option>
                                <option value="北海道">北海道</option>
                                <option value="青森県">青森県</option>
                                <option value="岩手県">岩手県</option>
                                <option value="宮城県">宮城県</option>
                                <option value="秋田県">秋田県</option>
                                <option value="山形県">山形県</option>
                                <option value="福島県">福島県</option>
                                <option value="茨城県">茨城県</option>
                                <option value="栃木県">栃木県</option>
                                <option value="群馬県">群馬県</option>
                                <option value="埼玉県">埼玉県</option>
                                <option value="千葉県">千葉県</option>
                                <option value="東京都">東京都</option>
                                <option value="神奈川県">神奈川県</option>
                                <option value="新潟県">新潟県</option>
                                <option value="富山県">富山県</option>
                                <option value="石川県">石川県</option>
                                <option value="福井県">福井県</option>
                                <option value="山梨県">山梨県</option>
                                <option value="長野県">長野県</option>
                                <option value="岐阜県">岐阜県</option>
                                <option value="静岡県">静岡県</option>
                                <option value="愛知県">愛知県</option>
                                <option value="三重県">三重県</option>
                                <option value="滋賀県">滋賀県</option>
                                <option value="京都府">京都府</option>
                                <option value="大阪府">大阪府</option>
                                <option value="兵庫県">兵庫県</option>
                                <option value="奈良県">奈良県</option>
                                <option value="和歌山県">和歌山県</option>
                                <option value="鳥取県">鳥取県</option>
                                <option value="島根県">島根県</option>
                                <option value="岡山県">岡山県</option>
                                <option value="広島県">広島県</option>
                                <option value="山口県">山口県</option>
                                <option value="徳島県">徳島県</option>
                                <option value="香川県">香川県</option>
                                <option value="愛媛県">愛媛県</option>
                                <option value="高知県">高知県</option>
                                <option value="福岡県">福岡県</option>
                                <option value="佐賀県">佐賀県</option>
                                <option value="長崎県">長崎県</option>
                                <option value="熊本県">熊本県</option>
                                <option value="大分県">大分県</option>
                                <option value="宮崎県">宮崎県</option>
                                <option value="鹿児島県">鹿児島県</option>
                                <option value="沖縄県">沖縄県</option>
                            </select>
                            <br><br>
                            <label>市町村</label><input type="text" name="city" value="{{ old('city') }}">
                            <br><br>
                            <label>番地・建物名</label><input type="text" name="building" value="{{ old('building') }}">
                            <br><br>

                            <label>ご要望 <br><small>※最善を尽くしますが、ご要望にお応えできない場合もございます。ご了承ください。</small></label>
                            <br>
                            <div class="d-flex align-items-center">
                                <textarea name="message" rows="4" cols="50">{{ old('message') }}</textarea>
                            </div>
                            <br><br>
                            <button class="btn btn-info" id="submitButton" onclick="submitForm()" type="submit">予約する</button>
                        </form>
                    </div>
                </div>
            </div>
            <br />
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('events.reservation_calender', ['plan' => $plan]) }}',
                eventClick: function(info) {
                    // イベントのクリックを無効化
                    info.jsEvent.preventDefault();
                }
            });
            calendar.render();
        });




        document.querySelector('input[name="lodging_days"]').addEventListener('change', function() {
            const lodgingDays = this.value;
            const room_id = @json($reservation_slot->room_id);
            const plan_id = @json($plan->id);
            const date = @json($reservation_slot->date);
            const requestData = {
                _token: '{{ csrf_token() }}',
                lodgingDays: lodgingDays,
                room_id: room_id,
                plan_id: plan_id,
                date: date,
            };

            // Ajaxリクエストを送信
            fetch('/get-matching-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // レスポンスから合計料金を取得
                    const total = data.total;

                    // 結果をHTML要素に表示する
                    const resultDiv = document.getElementById('result');
                    resultDiv.innerHTML = `合計料金: ${total} 円`;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function submitForm() {
    // ボタンを取得
    var button = document.getElementById('submitButton');
    
    // ボタンを無効化
    button.disabled = true;

    // フォームの送信
    document.getElementById('form').submit();
    // ここではデモのためにsetTimeoutを使っています
    setTimeout(function() {
        // 処理が完了したらボタンを再度有効化
        button.disabled = false;
    }, 3000); // 3秒後にボタンを再び有効化
}

    </script>
@endsection
