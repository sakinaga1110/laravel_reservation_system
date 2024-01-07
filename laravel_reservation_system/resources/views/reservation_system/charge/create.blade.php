<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header text-center h5">
                料金設定
                
                <div class=" d-flex justify-end">
                    
                    <a href="{{route('charge.edit',$reservation_slot)}}" class="btn btn-outline-primary">編集</a>
                    <form method="POST" action="{{route('charge.destroy',$reservation_slot)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger mx-2"
                            type="submit">{{ $room_id[$reservation_slot->room_id] }}タイプの{{ $reservation_slot->date }}の料金設定を全て破棄</button>
                    </form>
                    <a class="btn btn-primary mx-2" href="{{ route('charge.index') }}">戻る</a>
                </div>
            </div>
            <div class="card-body">
                @if ($plans->isEmpty())
                    <div class="h4 text-center bg-info text-white">この日のこの部屋タイプのプランの料金設定は全て設定されています。</div>
            </div>
        @else
            <div class="text-center d-flex justify-content-center">
                <form action="{{ route('charge.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <table>
                        <tr>
                            <th>部屋タイプ</th>
                            <th>日付</th>
                            <th>プラン名</th>
                            <th>料金</th>
                            <th></th>
                        </tr>

                        <tr>
                            <td> {{ $room_id[$reservation_slot->room_id] }}
                                <input type="hidden" name="room_id" value="{{ $reservation_slot->room_id }}">
                            </td>
                            <td>{{ $reservation_slot->date }}
                                <input type="hidden" name="date" value="{{ $reservation_slot->date }}">
                            </td>
                            <td>
                                <select name="plan_id">
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="charge" min="0" max="1000000"></td>
                            <td><button type="submit" class="btn btn-outline-danger">登録</button></td>
                        </tr>
                    </table>
                </form>
                @endif
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
