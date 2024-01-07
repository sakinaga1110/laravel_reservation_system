<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header text-center h5 ">
                <div class="d-flex">
                    <div class="flex-grow-1">予約詳細</div>
                    <div class="justify-content-end">
                        <a class="btn btn-primary text-end" href="{{ route('reservation.index') }}">一覧に戻る</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{ $reservation->kana_last_name . ' ' . $reservation->kana_first_name }}様<br>
                {{ $reservation->phone_num }}<br>
                {{ $reservation->email }}<br>
                {{ $reservation->post_code }}<br>
                {{ $reservation->prefecture.$reservation->city.$reservation->building }}<br>
                @if($reservation->message!==null)
                {{ $reservation->message }}
                @endif
                @foreach ($charges as $charge )
                {{ $charge->date }}<br>
                @endforeach
                お支払い合計{{ $total_charge }}円
                <form method="POST" action={{ route('reservation.update',$reservation) }}>
                    @csrf
                    @method('PUT')
                    <textarea class="form-control" name="memo" >{{ old('memo',$reservation->memo) }} 
                    </textarea>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary bg-primary">メモを保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
