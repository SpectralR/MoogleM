@extends('layouts.app')

@section('content')
    <div class='d-flex flex-column align-items-center'>
    @isset($chars)
        @foreach ($chars as $char)
            <section class='char-card'>
                <img src="{{ $char->Character->Portrait }}" alt="character pic" class='char-pic'>
                <p>{{ $char->Character->Name }}</p>
            </section>
        @endforeach
    @endisset
    </div>
@endsection