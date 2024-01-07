<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <div class="text-center h4"> 予約枠の新規作成</div>
                <div class="d-flex justify-end">
                    <a href="{{ route('reservation_slot.index') }}" class="btn btn-primary ">予約枠管理画面に戻る</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reservation_slot.store') }}">
                    @csrf
                    <div class="mt-3 d-flex justify-center align-items-center">
                        <p>部屋タイプ</p>
                        <select name="room_id" id="roomSelect" required>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mt-3 d-flex justify-center align-items-center">
                        <p>プラン</p>
                        <select name="plan_id" required>
                            @foreach ($plans as $plan)
                                <option value="{{$plan->id}}">{{ $plan->title }}</option>
                            @endforeach
                        </select>
                    </div> --}}
            </div>
            <div class="mt-3 d-flex justify-center align-items-center">
                <p>日付の範囲を選択</p>
            </div>
            <div class="mt-3 d-flex justify-center align-items-center">
                <label for="start_date">開始日:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="mt-3 d-flex justify-center align-items-center">
                <p>終了日:</p>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="mt-3 d-flex justify-center align-items-center">
                <p>枠数:</p>
                <select name="count" id="countSelect">
                    <!-- 枠数の選択肢はJavaScriptで動的に生成するので、ここでは何も表示しません -->
                </select>
            </div>
            {{-- <div class="mt-3 d-flex justify-center align-items-center">
                <p>料金設定:</p>
                <input type="number" name="charge" required>
            </div> --}}
            <div class="mt-3 d-flex justify-center align-items-center">
                <button type="submit" class="btn btn-outline-danger">作成</button>
            </div>
            </form>

        </div>
    </div>
    </div>


    <script>
        $(document).ready(function() {
            // 部屋タイプのセレクトボックス
            var $roomSelect = $("#roomSelect");
            // 枠数のセレクトボックス
            var $countSelect = $("#countSelect");


            // 初回の部屋タイプ選択で枠数を生成
            $roomSelect.on("change", function() {
                // 開始日と終了日の値をクリア
                $("#start_date").val("");
                $("#end_date").val("");
                // 選択された部屋タイプのnumber_of_roomsを取得
                var selectedRoomId = $(this).val();
                var selectedRoom = {!! $rooms->toJson() !!}.find(function(room) {
                    return room.id == selectedRoomId;
                });

                // 枠数の選択肢をクリア
                $countSelect.empty();

                //開始日と終了日の値をクリア



                // 枠数の選択肢を生成
                for (var i = 0; i <= selectedRoom.number_of_rooms; i++) {
                    var option = $("<option>").val(i).text(i);
                    $countSelect.append(option);
                }
            });
            // 初回の部屋タイプ選択で枠数を生成
            $roomSelect.trigger("change");

            // 開始日と終了日が変更されたときにAjaxリクエストを実行
            $("#start_date, #end_date").on("change", function() {
                var startDate = $("#start_date").val();
                var endDate = $("#end_date").val();
                var selectedRoomId = $roomSelect.val(); // 部屋タイプの選択値を取得

                // 開始日と終了日が両方とも選択された場合にAjaxリクエストを実行
                if (startDate && endDate) {
                    // 開始日が終了日より前でないことを確認
                    if (new Date(startDate) > new Date(endDate)) {
                        alert("開始日は終了日より前の日付を選択してください");
                        $("#start_date").val(""); // 開始日をクリア
                        return;
                    }
                    $.ajax({
                        url: "{{ route('reservation_slot.getAvailability') }}",
                        type: "POST",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            room_id: selectedRoomId,
                            start_date: startDate,
                            end_date: endDate,
                        },
                        success: function(data) {
                            // 既存の予約枠の合計枠数を計算
                            var existingCount = data.available_count;
                            console.log(data);
                            // 枠数の選択肢をクリア
                            $countSelect.empty();

                            // 枠数の選択肢を生成
                            for (var i = 0; i <= existingCount; i++) {
                                var option = $("<option>").val(i).text(i);
                                $countSelect.append(option);
                            }
                        },
                        error: function() {
                            console.error("Failed to fetch availability data.");
                        }
                    });
                }
            });
        });
    </script>

</x-app-layout>
