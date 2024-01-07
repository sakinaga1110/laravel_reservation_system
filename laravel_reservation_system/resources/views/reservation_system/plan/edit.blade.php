<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-center">
                    <p class="text-center h5">宿泊プラン編集</p>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('plan.index') }}" class="btn btn-info ">戻る</a>
                </div>
            </div>

            <div class="card-body">
                <div class="text-center d-flex justify-content-center">
                    <form action="{{ route('plan.update', ['plan' => $plan]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <p class="form-label">プラン名</p>
                        <input type="text" name="title" value="{{ old('title', $plan->title) }}" required>

                        <p class="form-label">プラン詳細</p>
                        <textarea name="detail" class="form-control" required>{{ old('detail', $plan->detail) }}</textarea>
                        <p class="form-label">プランイメージ</p>
                        @foreach ($images as $image)
                            <div class="image-upload">
                               <p> {{ $image->image }}</p>
                               <input type="hidden" name="old-image[]" value={{$image->image}}>
                                <img src="{{ asset('/storage/images/' . $image->image) }}" width="300" height="300"
                                    style="display: block;">
                                <button type="button" class="btn btn-outline-primary delete-old-image">写真を削除</button>
                            </div>
                        @endforeach
                        <div class="image-upload">
                            <input type="file" name="image[]" class="form-control"
                                accept=".jpg, .jpeg, .png, .img, .svg">
                            <button type="button" class="btn btn-outline-secondary add-image">写真を追加</button>
                        </div>
                        <button type="submit" class="btn btn-outline-danger">登録</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".add-image").click(function() {
                console.log("ボタンがクリックされました");

                // 新しい画像アップロードフィールドを生成
                var imageInput =
                    '<br/><div class="image-field">' +
                    '<input type="file" name="image[]" class="form-control" accept=".jpg, .jpeg, .png, .img, .svg" required>' +
                    '<button type="button" class="btn btn-outline-primary delete-image">写真を削除</button>' +
                    '</div>';

                // 新しい画像アップロードフィールドを追加
                $(imageInput).insertBefore($(this));
                // 新しいボタンに対してクリックイベントを設定
                $(".delete-image").click(function() {
                    $(this).closest(".image-field").remove(); // 対応する画像アップロードフィールドを削除
                });
            });
            $(".delete-old-image").click(function(){
                console.log("削除ボタンクリック");

                $(this).closest(".image-upload").remove();
            })
        });

    </script>
</x-app-layout>
