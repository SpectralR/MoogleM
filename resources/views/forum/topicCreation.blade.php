@extends('layouts.app')

@section('content')
    @if(isset($message))
        <form action="{{ route('insert_update', ['topic' => $topic, 'message' => $message]) }}" method="post">
            @csrf
            <textarea name="message" cols="30" rows="10" class="wysiwyg"> {{ $message->message }}</textarea>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    @else
        @auth
            {!! form($form) !!}
        @endauth
    @endif
@endsection
