<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-center">
                    <p class="text-center h5">料金再設定</p>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('charge.index') }}" class="btn btn-info ">戻る</a>
                </div>
            </div>

            <div class="card-body">
                <div class="text-center d-flex justify-content-center">
                    <div class="text-center d-flex justify-content-center">
                        <form action="{{ route('charge.updateBulk') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="text-center d-flex justify-content-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>部屋タイプ</th>
                                                <th>日付</th>
                                                <th>プラン名</th>
                                                <th>料金</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($charges as $charge)
                                                <tr>
                                                    <td> {{ $charge->room_id }}
                                                        <input type="hidden" name="room_id"
                                                            value="{{ $charge->room_id }}">
                                                    </td>
                                                    <td> {{ $charge->date }} <input type="hidden" name="date"
                                                            value="{{ $charge->date }}"></td>
                                                    <td>
                                                        {{ $charge->plan->title }}
                                                        <input type=hidden name=plan_ids[]
                                                            value="{{ $charge->plan_id }}">
                                                    </td>
                                                    <td> <input type="number" name="charges[]" min="0"
                                                            max="1000000" value="{{ $charge->charge }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br />
                                </div>
                                <button type="submit" class="btn btn-outline-danger">更新</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
