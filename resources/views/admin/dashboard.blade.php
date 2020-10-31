@extends('layouts.master')

@section('content')

<router-view :authuser="{{ Auth::user() }}"></router-view>

<vue-progress-bar></vue-progress-bar>

@endsection

