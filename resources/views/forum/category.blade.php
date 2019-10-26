@extends('layouts.app')

@section('content')
    @auth
        <a href="{{ route('forum_create_topic', ['cat' => $cat]) }}"><i class="fas fa-plus-square"></i></a>
    @endauth
    <table class='table table-dark table-hover'>
        <thead>
            <tr>
                <th></th>
                <th>Topic Name</th>
                <th>Topic creation</th>
                <th>Number of messages</th>
                @if ($topics->first()->user_id == Auth::user()->id || Auth::user()->isAdministrator() || Auth::user()->isModerator())
                    <th>Lock</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
                <tr>
                    @foreach($notifs as $notif)
                        @if($notif == $topic->id)
                            <td><i class="far fa-comments notif"></i></td>
                        @else
                            <td><i class="far fa-comments"></i></td>
                        @endif
                    @endforeach
                    @empty($notifs)
                            <td><i class="far fa-comments"></i></td>
                    @endempty
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
