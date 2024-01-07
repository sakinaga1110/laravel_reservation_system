@extends('layouts.user_app')
@section('title')
    HOTEL　LARAVEL　アクセス
@endsection

@section('content')
<p class="text-danger px-5">※再度ご案内いたします。このサイトのホテルは実在しません。このページではサイト作成者の地元である壱岐市へのアクセスをご案内します。</p>
    <div class="container bg-warning bg-opacity-25 p-5">
        <div class="row justify-content-spacebetween">
        <div class="col-md-6">
            <h4>空路</h4>
            <ul class="list-unstyled">
                <li> 長崎空港～壱岐空港
                    所要時間： 約30分</li>
                <br />
            </ul>
            <h4>航路</h4>
            <ul class="list-unstyled">
                <li>博多港～芦辺港（ジェットフォイル）
                    所要時間： 約1時間5分</li>
                <li>厳原港～芦辺港（ジェットフォイル）
                    所要時間： 約1時間5分</li>
                <li>博多港～郷ノ浦港（ジェットフォイル）
                    所要時間： 約1時間10分</li>
                <br />
                <li>
                    唐津東港～印通寺港（フェリー）
                    所要時間： 約1時間45分</li>
                <li>博多港～芦辺港（フェリー）
                    所要時間： 約2時間10分</li>
                <li>厳原港～郷ノ浦港（フェリー）
                    所要時間： 約2時間10分</li>
                <li>厳原港～芦辺港（フェリー）
                    所要時間： 約2時間15分</li>
                <li>博多港～郷ノ浦港（フェリー）
                    所要時間： 約2時間20分</li>
            </ul>
        </div>
        <div class="col-md-6">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d106112.69322401827!2d129.68880804248198!3d33.785938742059514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x356a13d5f6f4e215%3A0x4eb91da9d8acec3c!2z6ZW35bSO55yM5aOx5bKQ5biC!5e0!3m2!1sja!2sjp!4v1695484613843!5m2!1sja!2sjp"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
