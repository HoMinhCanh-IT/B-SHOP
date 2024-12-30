@extends('user.layout')
@section('content')
<style>
 img{
    max-width: 50%;
 }
</style>
<div class="container" style="padding: 100px 30px 30px 30px; ">
    <div class="row">
        <h1 style="text-align: center">{{ $Tieu_De }}</h1>
    </div>
    <div class="row">
        <div class="col-12" style="width: 100%;">
            {!! $Noi_Dung !!}
        </div>
    </div>
</div>
@stop