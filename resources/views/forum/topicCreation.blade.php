@extends('layouts.app')

@section('content')
    @auth
        {!! form($form) !!}          
    @endauth
@endsection