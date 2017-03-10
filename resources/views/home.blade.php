@extends('layouts.app')

@section('content')
<alert></alert>
<confirm></confirm>
<preloader></preloader>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
             <router-view></router-view>
        </div>
    </div>
</div>
@endsection
