@extends('user.layout')
@section('content')
<style>
    .dropdown-menu6 .price-active{
        color: #ff4e00;
    }
</style>
<!-- banner -->
<div class="banner_inner">
    <div class="services-breadcrumb">
        <div class="inner_breadcrumb">
            <ul class="short">
                <li>
                    <a href="{{route('user.index')}}">Trang Chủ</a>
                    <i>|</i>
                </li>
                <li>Khuyến Mãi</li>
            </ul>
        </div>
    </div>
</div>
<section>
    <div class="text-center" style="height: 500px; padding-top:200px; font-size:200%">
        @if($errors->has('error'))
        <p class="login-box-msg">
            <strong>{{ $errors->first('error') }}</strong>
        </p>
        @endif
    </div>
</section>
@stop
		