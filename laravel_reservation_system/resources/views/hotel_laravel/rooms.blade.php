@extends('layouts.user_app')
@section('title')
    HOTEL　LARAVEL　客室
@endsection
@section('content')
    <div class="container shadow rounded" style="background:#BFA;">
        <br />
        <div class="text-center text-secondary display-6">客室紹介</div>
        <div class="row justify-content-evenly p-5">
            <div class="col-6 card  text-center my-3">
                <br />
                <h3>シングル</h3>
                <p>・利用可能人数　１名<br />
                <h4>客室設備</h4><br />インターネット（wi-fi）、
                ドライヤー、冷蔵庫、湯沸しポット、ティーセット、電話、テレビ、クローゼット、加湿空気清浄機<br /><br />
                <h4>アメニティ</h4>
                シャンプー、コンディショナー ボディーソープ 歯ブラシセット、タオル・バスタオル、ナイトウェア、スリッパ </p>          
            </div>
            <div class="col-6 my-3">
                <img class="rounded shadow img-fluid" src="../image/single.png" alt="シングルタイプの部屋（洋室）">
                <br />
            </div>
            <br />
            <div class="col-6 my-3">
                <img class="rounded shadow img-fluid" src="../image/twin.png" alt="ツインタイプの部屋（洋室）">
                <br />
            </div>
            <div class="col-6 card text-center my-3">
                <br />
                <h3>ツイン</h3>
                <p>・利用可能人数　2名</p><br />
                <h4>客室設備</h4><br />インターネット（wi-fi）、
                ドライヤー、冷蔵庫、湯沸しポット、ティーセット、電話、テレビ、クローゼット、加湿空気清浄機<br /><br />
                <h4>アメニティ</h4>
                シャンプー、コンディショナー ボディーソープ 歯ブラシセット、タオル・バスタオル、ナイトウェア、スリッパ </p>          
            </div>
            <br />
            <div class="col-6 card text-center my-3">
                <br />
                <h3>ダブル</h3>
                <p>・利用可能人数　2名</p><br />
                <h4>客室設備</h4><br />インターネット（wi-fi）、
                ドライヤー、冷蔵庫、湯沸しポット、ティーセット、電話、テレビ、クローゼット、加湿空気清浄機<br /><br />
                <h4>アメニティ</h4>
                シャンプー、コンディショナー ボディーソープ 歯ブラシセット、タオル・バスタオル、ナイトウェア、スリッパ </p>            
            </div>
            <div class="col-6 my-3">
                <img class="rounded shadow img-fluid" src="../image/double.png" alt="ダブルタイプの部屋（洋室）">
                <br />
            </div>
            <br />
            <div class="col-6 my-3">
                <img class="rounded shadow img-fluid" src="../image/japanese_style.png" alt="和室（ご家族向け）">
                <br />
            </div>
            <div class="col-6 card text-center my-3">
                <br />
                <h3>和室</h3>
                <p>・利用可能人数　1~4名</p><br />
                <h4>客室設備</h4>インターネット（wi-fi）、
                ドライヤー、冷蔵庫、湯沸しポット、ティーセット、電話、テレビ、クローゼット、加湿空気清浄機<br /><br />
                <h4>アメニティ</h4>
                シャンプー、コンディショナー ボディーソープ 歯ブラシセット、タオル・バスタオル、ナイトウェア、スリッパ </p>
            </div>
        </div>
        <br /><br />
    </div>
@endsection
