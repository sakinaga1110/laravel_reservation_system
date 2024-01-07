<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header text-center h5">
                予約一覧
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('reservation.create') }}">新規登録</a>
                </div>
            </div>
            <div class="card-body">
                予約一覧<br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>電話番号</th>
                            <th>メールアドレス</th>
                            <th>チェックイン</th>
                            <th>チェックアウト</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->kana_last_name . ' ' . $reservation->kana_first_name }}様
                                </td>
                                <td>{{ $reservation->phone_num }}</td>
                                <td>{{ $reservation->email }}</td>
                                <td>
                                    {{ $reservation->chargeParent->charges->date}}
                                </td>
                                <td>
                            
                                </td>
                                <td>
                                    <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-primary">詳細</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

