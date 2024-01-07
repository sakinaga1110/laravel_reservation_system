@extends('layouts.user_app')
@section('title')
    HOTEL　LARAVEL　宿泊プラン
@endsection
@section('content')
    <div class="container-fluid bg-info bg-opacity-25 text-center">
        <br />
        <div class="container px-5">
            <h4>ご宿泊　宿泊プラン　一覧</h4>
            @foreach ($plans as $plan)
                <div class="card">
                    <div class="card-header" name="plan_name">{{ $plan->title }}</div>
                    <div class="card-body" name="plan_content">{{ $plan->detail }}
                        <div class="d-flex align-items-center justify-content-center">
                            @foreach ($plan->images as $image)
                                <img src="{{ asset('storage/images/' . $image->image) }}" alt="Plan Image" width="200"
                                    height="200" style="display: block;">
                            @endforeach
                        </div>
                        <a class="btn btn-info" href="{{route('hotel_laravel.room_calender',['plan'=>$plan])}}" data-toggle="tooltip" title="このプランの空室状況を確認します">
                            このプランの空室状況を見る
                        </a>
                    </div>
                </div>
                <br />
            @endforeach
        </div>
    </div>
@endsection
