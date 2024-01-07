<x-app-layout>
    <style>
        th {
            white-space: nowrap;
        }

        table {
            table-layout: fixed;
        }
    </style>
    <div class="container-fluid pt-5">
        <div class="row justify-center px-5">
            <br />
            <table class="table">
                <thead>
                    <tr class="border">
                        <th class="py-2 bg-dark opacity-50 text-white text-center">お問い合わせ内容</th>
                        <th class="py-2 bg-dark opacity-50 text-white text-center">
                            ステータス
                            <form method="GET" action="{{ route('inquiry.index') }}">
                                @csrf
                                <select name="status_filter" class="form-control status_filter" onchange="this.form.submit()">
                                    <option value="all" {{ (session('status_filter') == 'all' || session('status_filter') == null) ? 'selected' : '' }}>すべて</option>
                                    <option value="not_started" {{ (session('status_filter') == 'not_started') ? 'selected' : '' }}>未対応</option>
                                    <option value="in_progress" {{ (session('status_filter') == 'in_progress') ? 'selected' : '' }}>対応中</option>
                                    <option value="completed" {{ (session('status_filter') == 'completed') ? 'selected' : '' }}>対応済</option>
                                </select>
                            </form>
                        </th>
                        <th class="py-2 bg-dark opacity-50 text-white text-center">問い合わせ日時</th>
                        <th class="bg-dark opacity-50 text-white text-center py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inquiries as $inquiry)
                        <tr class="border">
                            <td class="text-center">
                                <a href="{{ route('inquiry.show', $inquiry) }}">
                                    {{ \Illuminate\Support\Str::limit($inquiry->inquiry_content, 30) }}
                                </a>
                            </td>
                            <td class="text-center">
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
                            </td>
                            <td class="text-center">{{ $inquiry->created_at }}</td>
                            <td class="text-center">
                                <a class="btn btn-info" href="{{ route('inquiry.show', $inquiry) }}">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-content-center">
                {{ $inquiries->appends(['status_filter' => session('status_filter')])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <script>
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
        $(document).ready(function() {
            $('.status-select').change(function() {
                reloadInquiries();
            });
        });
    </script>
</x-app-layout>
