<x-app-layout>
    <div class="container pt-5">
        <div class="card">
            <div class="card-header text-center h5">
                宿泊プラン一覧
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('plan.create') }}">新規登録</a>
                </div>
            </div>
            <div class="card-body">
                宿泊プラン一覧
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>プラン名</th>
                            <th>詳細</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td class="text-break" style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $plan->title }}
                                </td>
                                <td class="text-break" style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $plan->detail }}
                                </td>
                                
                                <td>
                                    <a href="{{route('plan.show',$plan)}}"><button class="btn btn-primary">詳細</button></a>
                                </td>
                                <td>
                                    <a href="{{route('plan.edit',$plan)}}"><button class="btn btn-danger">編集</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
