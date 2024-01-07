<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <div class="text-center h4"> 予約枠詳細・編集・削除</div>
                <div class="d-flex justify-content-end text-right">
                    <a href="{{ route('reservation_slot.index') }}" class=" btn btn-primary">予約枠管理画面に戻る</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-center">
                    <p>部屋タイプ:
                        {{ $room->room_type }}<br>
                        日付：
                        {{ $reservation_slot->date }}<br>
                        現在の枠数: {{ $reservation_slot->count }}</p>

                    <form method="POST" action="{{ route('reservation_slot.update', $reservation_slot) }}">
                        @csrf
                        @method('PATCH')
                        <br> <br>
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('１枠減らしますか？')">枠数を減らす</button>
                    </form>
                </div>

                <a href="{{ route('reservation_slot.destroy', $reservation_slot) }}"
                    class="btn btn-danger d-flex justify-center my-5"
                    onclick="return confirm('本当に削除しますか？')">予約枠を全て削除する</a>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
