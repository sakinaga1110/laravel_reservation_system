<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header text-center h5">
                宿泊プラン詳細
                <div class="d-flex justify-content-end">
                    <a href="{{ route('plan.index') }}" class="btn btn-info ">戻る</a>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="text-center mt-4">
                        <p class="bg-secondary bg-opacity-25 h5">プラン名</p>
                        <p>{{ $plan->title }}</p>
                    </div>

                    <div class="text-center mt-4">
                        <p class="bg-secondary bg-opacity-25 h5">プラン詳細</p>
                        <p>{{ $plan->detail }}</p>
                    </div>

                    <div class="text-center mt-4">
                        <h5>プランイメージ</h5>
                        <div class="d-flex align-items-center justify-center">
                            @foreach ($images as $image)
                                <img src="{{ asset('/storage/images/' . $image->image) }}" width="200" height="200"
                                    class="mx-1" style="display: block;" alt="プランイメージ">
                            @endforeach
                        </div>
                        <br>
                        <div class="d-flex align-items-center justify-center">
                            <a href="{{ route('plan.edit', $plan) }}"><button class="btn btn-primary">編集</button></a>
                            <form method="POST" action="{{ route('plan.destroy', $plan) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mx-2" onclick="return confirm('本当に削除しますか？')"><input type="submit" value="削除"></button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
