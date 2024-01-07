<x-app-layout>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <p class="h5">お問い合わせ詳細</p>
                <div class="d-flex justify-center align-items-center"><p>ステータス</p>
                <form method="POST" action="{{ route('inquiry.update', $inquiry) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <select name="status" class="form-control status-select"
                            data-id="{{ $inquiry->id }}">
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}"
                                    {{ $inquiry->status == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                </div>
            </div>
            <div>
                <div class="card-body text-center">
                    お名前　{{ $inquiry->name }}<br />
                    メールアドレス　{{ $inquiry->email }}<br />
                    問い合わせ内容　<br />
                    {{ $inquiry->inquiry_content }}

                    <textarea id="copyText" hidden> 
                        お名前　{{ $inquiry->name }}
                        メールアドレス　{{ $inquiry->email }}
                        問い合わせ内容　
                         {{ $inquiry->inquiry_content }}
                    </textarea>
                    <br />
                    <button class="btn btn-info" onclick="copyToClipboard()">テキストを全文コピー</button>
                </div>
            </div>
            <a href="https://mail.google.com/mail/u" class="text-center text-info text-decoration-underline"
                target="_blank">gmailで返信する</a>
                <br/>
                <div class="text-center">
                <a class="btn btn-danger" href="{{route('inquiry.index')}}">一覧に戻る</a>
                </div>
                <br/>
        </div>
    </div>
    <script>
        function copyToClipboard() {
            // 画面上の情報を取得
            var name = "{{ $inquiry->name }}";
            var email = "{{ $inquiry->email }}";
            var inquiry_content = "{{ $inquiry->inquiry_content }}";

            // コピー対象のテキストを作成
            var textToCopy = "お名前：" + name + "\n" +
                "メールアドレス：" + email + "\n" +
                "問い合わせ内容：" + inquiry_content;

            // テキストエリアを動的に作成して値をセット
            var textArea = document.createElement("textarea");
            textArea.value = textToCopy;
            document.body.appendChild(textArea);

            // テキストエリアの値を選択し、コピー
            textArea.select();
            document.execCommand('copy');

            // テキストエリアを削除
            document.body.removeChild(textArea);

            // コピーが完了したらユーザーに通知（任意）
            alert("コピーが成功しました！");
        }

        $(document).ready(function() {
            $('.status-select').change(function() {
                var status = $(this).val();
                var inquiryId = $(this).data('id');

                $.ajax({
                    url: "{{ route('inquiry.update', ':inquiryId') }}".replace(':inquiryId',
                        inquiryId),
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'PATCH',
                        'status': status
                    },
                    success: function(response) {
                        console.log('更新しました。');
                    },
                    error: function(error) {
                        console.log('エラー');
                    }
                });
            });
        });
        
    </script>
</x-app-layout>
