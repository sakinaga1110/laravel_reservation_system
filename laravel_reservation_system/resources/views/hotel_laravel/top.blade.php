@extends('layouts.user_app') <!-- レイアウトを拡張 -->
@section('title')
    HOTEL　LARAVEL　TOP
@endsection
<style>
    .vh-75 {
        height: 75vh;
        /* 画面の高さの75%に設定 */
    }
</style>

@section('content')
    <div class="container vh-75 p-0">
        <x-flash></x-flash>
        <div class="carousel slide carousel-fade h-75" data-bs-ride="carousel" id="crs1">
            <div class="carousel-indicators justify-content-center">
                <button data-bs-target="#crs1" data-bs-slide-to="0" class="active"></button>
                <button data-bs-target="#crs1" data-bs-slide-to="1"></button>
                <button data-bs-target="#crs1" data-bs-slide-to="2"></button>
                <button data-bs-target="#crs1" data-bs-slide-to="3"></button>
            </div>

            <div class="carousel-inner h-100 w-100">
                <div class="carousel-item active"><img src="../image/image1.jpg" class="d-block img-fluid">
                    <div class="carousel-caption h-75">
                        <h3>LARAVEL</h3><br />~PHP フレームワーク~
                    </div>
                </div>
                <div class="carousel-item "><img src="../image/image2.jpg" class="d-block img-fluid">
                    <div class="carousel-caption h-75">
                        <h3>LARAVEL</h3><br />~PHP フレームワーク~
                    </div>
                </div>
                <div class="carousel-item "><img src="../image/image3.jpg" class="d-block img-fluid">
                    <div class="carousel-caption h-75">
                        <h3>LARAVEL</h3><br />~PHP フレームワーク~
                    </div>
                </div>
                <div class="carousel-item "><img src="../image/image4.jpg" class="d-block img-fluid">
                    <div class="carousel-caption h-75">
                        <h3>LARAVEL</h3><br />~PHP フレームワーク~
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" data-bs-target="#crs1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">前へ</span>
            </button>
            <button class="carousel-control-next" data-bs-target="#crs1" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">次へ</span>
            </button>
        </div>
        <div class="text-center text-muted fw-bold"><br />このサイトはLaravelを使用した予約サイトと予約システムの作成方法を学ぶために作成されたものであり、
            このホテルは実在しません。<br />カルーセルの画像はこのサイトの作者によって過去に撮影された風景です。
        </div>
    </div>
@endsection
