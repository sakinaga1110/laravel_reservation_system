@extends('layouts.user_app')
@section('title')
    HOTEL　LARAVEL　問い合わせ
@endsection
@section('content')
    <div class="container">
        <h4 class="text-center">お問い合わせ</h4>
        <h6 class="text-center">※17時以降のお問い合わせに関しては、翌営業日以降の回答とさせていただきます。<br />
            お急ぎでしたら、下記の電話番号にて賜ります。<br />
            HOTEL_LARAVEL（フロント）　〇〇〇ー△△△△ー□□□□</h6>
        <br />
        <div class="card p-5 bg-success bg-opacity-25">
            <div class="row justify-content-center text-center">
                <div class="col-md-3 pt-3">
                    お名前<input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 pt-3">
                    メールアドレス<input type="mail" name="mail" class="form-control" required>
                </div>
                <div class="col-md-12 pt-5">
                    <p>お問い合わせの内容</p>
                    <textarea name="inquiry_content" class="w-100 form-control" style="height: 50vh;" required></textarea>
                </div>
                <div class="col-md-12 pt-3">
                    <button type="button" class="btn btn-danger modal_btn" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal">
                        送信
                    </button>
                </div>
            </div>
        </div>
        <!-- モーダル -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">内容の確認</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                    </div>
                    <div class="modal-body">


                        <!-- ここに確認内容を表示 -->
                        <p>お名前: </p>
                        <p>メールアドレス: </p>
                        <p>お問い合わせ内容: </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">入力に戻る</button>
                        <form method="POST" action="{{ route('inquiries_complete') }}">
                            @csrf
                            <input type="hidden" name="name" id="name_hidden">
                            <input type="hidden" name="mail" id="mail_hidden">
                            <input type="hidden" name="inquiry_content" id="inquiry_content_hidden">
                            <button type="submit" class="btn btn-danger">送信</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        // フォーム送信ボタンクリック時の処理
        document.querySelector('.modal_btn').addEventListener('click', function() {
            // フォームの入力内容を取得
            var name = document.querySelector('input[name="name"]').value;
            var email = document.querySelector('input[name="mail"]').value;
            var  inquiry_content= document.querySelector('textarea[name="inquiry_content"]').value;

            // 隠しフィールドのvalue属性を動的に設定
            document.querySelector('#name_hidden').value = name;
            document.querySelector('#mail_hidden').value = email;
            document.querySelector('#inquiry_content_hidden').value = inquiry_content;

            // 確認モーダル内の要素に設定
            var modal = document.querySelector('#confirmationModal');
            modal.querySelector('.modal-body').innerHTML = `
                <p>お名前: ${name}</p>
                <p>メールアドレス: ${email}</p>
                <p>お問い合わせ内容: ${inquiry_content}</p>
            <p>こちらの内容でお間違いありませんか？<br/>※メールアドレスが正しくない場合、お問い合わせにお答えできません。もう一度ご確認ください。<p>`;
        });
    </script>
@endsection
