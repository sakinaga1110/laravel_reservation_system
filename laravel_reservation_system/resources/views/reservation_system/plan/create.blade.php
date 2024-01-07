<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header text-center h5">
                宿泊プラン登録
            </div>
            <div class="card-body">
                <div class="text-center d-flex justify-content-center">
                    <form action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="form-label">プラン名</label>
                        <input type="text" name="title" class="form-control" required>
                        <label class="form-label">プラン詳細</label>
                        <textarea name="detail" class="form-control" required></textarea>
                        <label class="form-label">プランイメージ</label>
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
        $(document).ready(function () {
            $(".add-image").click(function () {
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
                $(".delete-image").click(function () {
                    $(this).closest(".image-field").remove(); // 対応する画像アップロードフィールドを削除
                });
            });
        });
    </script>
    
</x-app-layout>
