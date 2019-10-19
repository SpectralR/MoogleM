@extends('layouts.app')

@section('content')
    @auth
        <a href="{{ route('forum_create_topic', ['cat' => $cat]) }}"><i class="fas fa-plus-square"></i></a>   
    @endauth
    <table class='table table-dark table-hover'>
        <thead>
            <tr>
                <th></th>
                <th>topic creation</th>
                <th>number of messages</th>
                @if (Auth::user()->isAdministrator() || Auth::user()->isModerator())
                    <th>Lock</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
                {{-- @php
                    dd( $topic);    
                @endphp --}}
                <tr>
                    <td><a href="{{ route('forum_messages', ['mes' => $topic->id]) }}">{{ $topic->title }}</a></td>
                    <td>{{ date('d-m-Y', strtotime($topic->created_at)) }}</td>
                    <td>{{ $topic->messages->count() }}</td>
                    @if ($topic->user_id == Auth::user()->id || Auth::user()->isAdministrator() || Auth::user()->isModerator())
                        @if ($topic->locked == true)
                            <td><a href="{{ route('unlock_topic', ['topic' => $topic->id]) }}"><i class='fas fa-lock'></i></a></td>
                        @else
                            <td><a href="{{ route('lock_topic', ['topic' => $topic->id]) }}"><i class='fas fa-lock-open'></i></a></td>
                        @endif
                    @endif
                </tr>  
            @endforeach            
        </tbody>
    </table>
@endsection